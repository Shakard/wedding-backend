<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chair;
use App\Models\Table;
use App\User;
use Illuminate\Http\Request;

class ChairController extends Controller
{

    public function getChairs()
    {

        $chairs = Chair::with('table')
        ->select('*','name as label','name as value')        
        ->get();

        return response()->json(
            [
                'data' => $chairs,
                'message' => 'Success'
            ],
            200
        );
    }

    public function getChairsByTable($id)
    {   
        $table = Table::find($id);
        $chairs = Chair::where('table_id', $table->id)->get();

        return response()->json(['data' => $chairs, 'msg' => [
            'summary' => 'success',
            'detail' => 'Le busqueda se realizo con exito',
            'code' => '200'
        ]], 200);        
        
    }

    public function getChairsUsers()
    {
        $chairs = Chair::select('users.name', 'users.email', 'chairs.name')->with('user')->get();

        return response()->json(
            [
                'data' => $chairs,
                'message' => 'Success'
            ],
            200
        );
    }

    public function storeChair(Request $request)
    {
        $table = Table::find($request->input('chair.table.id'));
        $user = User::find($request->input('chair.user.id'));
        $data = new Chair();
        $data->name = $request->input('chair.name');
        $data->code = $request->input('chair.code');

        $data->table()->associate($table);
        $data->user()->associate($user);
        $data->save();

        return response()->json([
            'summary' => 'success',
            'code' => '201',
            'data' => $data,
        ], 201);
    }

    public function updateChair(Request $request, Chair $chair)
    {
        $table = Table::find($request->input('chair.table.id'));
        $user = User::find($request->input('chair.user.id'));
        $chair->name = $request->input('chair.name');
        $chair->code = $request->input('chair.code');

        $chair->table()->associate($table);
        $chair->user()->associate($user);
        $chair->save();

        return response()->json([
            'summary' => 'success',
            'code' => '201',
            'data' => $chair
        ], 201);
    }

    public function addUser(Request $request, Chair $chair)
    {
        $user = User::find($request->input('chair.user.id'));
        $chair->user()->associate($user);
        $chair->save();

        return response()->json([
            'summary' => 'success',
            'code' => '201',
            'data' => $chair
        ], 201);
    }


    public function storeChairByNumber(Request $request)
    {

        for ($i = 1; $i <= $request->input('number'); $i++) {           
            $numberOfRecords = Chair::All();
            $table = Table::find($request->input('chair.table.id'));
            $chairsByTable = Chair::where('table_id', $table->id)->get();
            $data = new Chair();
            $name = 'Silla ' . count($chairsByTable)+1;
            $code = 'SOLVIT' . count($numberOfRecords)+1 . 'S';    
            $data->code = $code;
            $data->name = $name;

            $data->table()->associate($table);
            $data->save();
        }

        return response()->json([
            'summary' => 'success',
            'code' => '201',
        ], 201);
    }

    public function destroy($id)
    {
        $table = Table::find($id);
        $table->delete();

        return response()->json([
            'data' => $table,
            'msg' => [
                'summary' => 'Usuario eliminado',
                'detail' => 'El usuario fue eliminado exitósamente',
                'code' => '201'
            ]
        ], 201);
    }
}
