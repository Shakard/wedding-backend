<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DocumentUploadedController;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use Notifiable;

    public function __construct(User $user)
    {
        $this->repository = $user;

        //$this->middleware(['can:users']);
    }

    public function index(Request $request)

    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()

    {

        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    public function create2()
    {
        return view('admin.pages.users.create');
    }

    public function store(Request $request)

    {

        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|same:confirm-password',

            'roles' => 'required'

        ]);



        $input = $request->all();

        $input['password'] = FacadesHash::make($input['password']);



        $user = User::create($input);

        $user->assignRole($request->input('roles'));



        return redirect()->route('users.index')

            ->with('success', 'User created successfully');
    }

    public function store2(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('avatar') && $request->avatar->isValid()) {
            $data['avatar'] = $request->avatar->store("users");
        }

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $this->repository->create($data);

        return back()->with('message', 'Usuário adicionado com sucesso.')->with('typealert', 'success');
    }

    public function show($id)

    {

        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    public function show2($id)
    {

        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', compact('user'));
    }

    public function edit($id)

    {

        $user = User::find($id);

        $roles = Role::pluck('name', 'name')->all();

        $userRole = $user->roles->pluck('name', 'name')->all();



        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function edit2($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)

    {

        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email,' . $id,

            'password' => 'same:confirm-password',

            'roles' => 'required'

        ]);



        $input = $request->all();

        if (!empty($input['password'])) {

            $input['password'] = FacadesHash::make($input['password']);
        } else {

            $input = Arr::except($input, array('password'));
        }



        $user = User::find($id);

        $user->update($input);

        FacadesDB::table('model_has_roles')->where('model_id', $id)->delete();



        $user->assignRole($request->input('roles'));



        return redirect()->route('users.index')

            ->with('success', 'User updated successfully');
    }

    public function postUpdate(Request $request, $id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();


        if ($request->hasFile('avatar') && $request->avatar->isValid()) {

            if (Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }

            $data['avatar'] = $request->avatar->store("users");
        }

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return back()->with('message', 'Atualizado com sucesso.')->with('typealert', 'success');
    }

    public function destroy($id)

    {

        User::find($id)->delete();

        return redirect()->route('users.index')

            ->with('success', 'User deleted successfully');
    }

    public function destroy2($id)
    {
        $u = User::find($id);
        if ($u->delete()) :
            return back()->with('message', 'Excluído com sucesso.')->with('typealert', 'danger');
        endif;
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $users = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                    $query->orWhere('email', $request->filter);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }

    /* --------------------------------
       ----------Api Methods-----------
       --------------------------------*/

    public function loggedUser()
    {
        $user = auth()->user();

        return response()->json([
            'data' => $user,
            'message' => 'success'
        ]);
    }

    public function getUsers()
    {
        $users = User::with('chair')->get();

        return response()->json(
            [
                'data' => $users,
                'message' => 'Success'
            ],
            200
        );
    }

    public function searchByParameters(Request $request)
    {
        $users = User::with('chair.table')->role('Guest')
            ->when($request->table, function ($query) use ($request) {
                $query->where('chair', $request->table);
            })
            ->when($request->chair, function ($query) use ($request) {
                $query->where('chair.id', $request->chair);
            })
            ->get();

        return response()->json(
            [
                'data' => $users,
                'message' => 'Success'
            ],
            200
        );
    }

    public function getGuests()
    {
        $users = User::with('chair.table')->role('Guest')
            ->get();

        return response()->json(
            [
                'data' => $users,
                'message' => 'Success'
            ],
            200
        );
    }

    public function storeUser(Request $request)

    {
        $notify = new DocumentUploadedController();
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 8);
        $hashed_random_password = FacadesHash::make($password);
        $user = new User();
        $user->name = $request->input('user.name');
        $user->email = $request->input('user.email');        
        $user->password = $hashed_random_password;
        $user->save();
        $user->assignRole('Guest');
        $userId = $user->id;
        $email = $user->email;
        $notify->sendNotificationPassword($userId, $email, $password);
    }


    public function update2(Request $request, User $user)
    {
        $user->name = $request->input('user.name');
        $user->email = $request->input('user.email');
        $user->save();
        $user->assignRole($request->input('roles'));

        return response()->json([
            'summary' => 'success',
            'code' => '201',
            'data' => $user
        ], 201);
    }

    public function destroy3($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'data' => $user,
            'msg' => [
                'summary' => 'Usuario eliminado',
                'detail' => 'El usuario fue eliminado exitósamente',
                'code' => '201'
            ]
        ], 201);
    }

    public function importUsers(Request $request)
    {
        $notify = new DocumentUploadedController();
        $users = $request->data;
        User::insert($users);
        $importedUsers =  count($users);
        $newUsers = User::orderBy('id', 'desc')->take($importedUsers)->get();
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        foreach ($newUsers as $user) {
            $password = substr($random, 0, 8);
            $hashed_random_password = FacadesHash::make($password);
            $user->password = $hashed_random_password;
            $user->update();
            $user->assignRole('Guest');
            $userId = $user->id;
            $email = $user->email;
            $notify->sendNotificationPassword($userId, $email, $password);
        }

        return response()->json([


            'summary' => 'success',
            'code' => '201',
            'data' => $users
        ], 201);
    }
}
