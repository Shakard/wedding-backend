<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DocumentUploadedController;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{

    public function __construct(Libro $libro)
    {
        $this->repository = $libro;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = $this->repository->latest()->paginate();
        $librosLawyer = Libro::where('status', 'Aprobado')->latest()->paginate();
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];

        return view('admin.pages.libros.index', $data, compact('libros', 'librosLawyer'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $l = new libro();
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'l' => $l];
        return view('admin.pages.libros.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $notify = new DocumentUploadedController();
        $user = auth()->user()->id;
        $cats = Category::find($request->category);
        $data = new libro();
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('assets/files', $filename);
        $data->file = $filename;
        $data->description = $request->description;
        $bytes = 'ikjaf';
        $data->code = $bytes;
        $data->status = 'pendiente';
        $data->name = $request->name;
        $data->user()->associate($user);
        $data->category()->associate($cats);
        $data->save();
        $notify->sendDocumentUploadedNotification(16);

        return redirect()->route('libros.index')->with('message', 'Document Uploaded.')->with('typealert', 'success');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $l = Libro::findOrFail($id);
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'l' => $l];
        return view('admin.pages.libros.edit', $data);
    }

    public function postUpdate(Request $request, $id)
    {
        $notify = new DocumentUploadedController();
        $document = Libro::findOrFail($id);
        $cats = Category::find($request->category);
        $document->description = $request->description;
        $document->status = $request->status;
        $document->coment = $request->coment;
        $document->name = $request->name;
        $document->category()->associate($cats);
        $document->save();
        $user = $document->user->id;

        if ($document->status == 'Aprobado') {
            $notify->sendNotificationApproved($user);
        } elseif ($document->status == 'Rechazado') {
            $notify->sendNotificationDenied($user);
        }

        return redirect()->route('libros.index');
    }

    public function download(Request $request, $file)
    {

        return response()->download(public_path('assets/files/' . $file));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$libro = $this->repository->find($id)) {
            return redirect()->back();
        }
        unlink(public_path('assets/files/' . $libro->file));

        if ($libro->delete()) :
            return back()->with('message', 'Document deleted successfully.')->with('typealert', 'danger');
        endif;
    }

    public function search(Request $request)
    {

        $libros = Libro::when($request->description, function ($query) use ($request) {
            $query->where('description', 'LIKE', "%{$request->description}%");
        })
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(20);
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.pages.libros.index', $data, compact('libros'));
    }

    public function searchLawyer(Request $request)
    {
        $filters = $request->only('filter');

        $librosLawyer = $this->repository->where('status', 'Aprobado')
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                    $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate();
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.pages.libros.index', $data, compact('librosLawyer', 'filters'));
    }

    public function searchByStatus(Request $request)
    {
        $filters = $request->only('filter');

        $libros = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('status', $request->filter);
                }
            })
            ->latest()
            ->paginate();

        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.pages.libros.index', $data, compact('libros', 'filters'));
    }

    public function searchByCategory(Request $request)
    {
        $filters = $request->only('filter');
        $libros = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('category_id', $request->filter);
                }
            })
            ->latest()
            ->paginate();

        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.pages.libros.index', $data, compact('libros', 'filters'));
    }

    public function searchLawyerByCategory(Request $request)
    {
        $filters = $request->only('filter');
        $librosLawyer = $this->repository->where('status', 'Aprobado')
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('category_id', $request->filter);
                }
            })
            ->latest()
            ->paginate();

        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.pages.libros.index', $data, compact('librosLawyer', 'filters'));
    }


    /* --------------------------------
       ----------Api Methods-----------
       --------------------------------*/

    //Trae todos los documentos    
    public function getDocuments()
    {
        $documents = Libro::orderBy('created_at', 'desc')
            ->simplePaginate(4)
            ->all();

        return response()->json(['data' => $documents, 'msg' => [
            'summary' => 'success',
            'detail' => 'Le busqueda se realizo con exito',
            'code' => '200'
        ]], 200);
    }

    //Trae un documento según su id
    public function getDocumentById(Libro $document)

    {
        $document = Libro::find($document);

        return response()->json(['data' => $document, 'msg' => [
            'summary' => 'success',
            'detail' => '',
            'code' => '200'
        ]], 200);
    }

    //Crea un nuevo documento y notifica al administrador de su creación
    public function storeDocument(Request $request)
    {
        $notify = new DocumentUploadedController();
        $user = auth()->user()->id; //Trae el id del usuario logueado
        $cats = Category::find($request->category);
        $data = new libro();
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('assets/files', $filename);
        $data->file = $filename;
        $data->description = $request->description;
        $lastDocumentId = libro::orderBy('created_at', 'desc')->first();
        if (!$lastDocumentId)
            $number = 0;
        else
            $number = $lastDocumentId->id;
        $bytes = 'BSV' . now()->year . $number;
        $data->code = $bytes;
        $data->status = 'pendiente';
        $data->name = $request->name;
        $data->user()->associate($user);
        $data->category()->associate($cats);
        $data->save();
        $notify->sendDocumentUploadedNotification(16); //notifica al usuario administrador de la creacion del documento

        return response()->json([
            'summary' => 'success',
            'code' => '201',
            'data' => $data,
        ], 201);
    }


    public function updateDocument(Request $request, $id)
    {
        $notify = new DocumentUploadedController();
        $document = Libro::findOrFail($id);
        $cats = Category::find($request->category);
        $document->description = $request->description;
        $document->status = $request->status;
        $document->coment = $request->coment;
        $document->name = $request->name;
        $document->category()->associate($cats);
        $document->update();
        $user = $document->user->id;

        //Verifica si el documento ha sido aprobado o rechazado y notifica al usuario
        if ($document->status == 'Aprobado') {
            $notify->sendNotificationApproved($user);
        } elseif ($document->status == 'Rechazado') {
            $notify->sendNotificationDenied($user);
        }

        return response()->json(['data' => $document, 'msg' => [
            'summary' => 'success',
            'detail' => 'Document updated successfully',
            'code' => '200'
        ]], 200);
    }

    //Descarga el documento
    public function downloadDocument($file)
    {
        return response()->download(public_path('assets/files/' . $file));
    }

    //Elimina un documento
    public function destroyDocument($id)
    {
        if (!$libro = $this->repository->find($id)) {
            return redirect()->back();
        }
        unlink(public_path('assets/files/' . $libro->file));

        if ($libro->delete()) :
            return response()->json(['msg' => [
                'summary' => 'success',
                'detail' => 'Document deleted successfully',
                'code' => '200'
            ]], 200);
        endif;
    }

    //busca por descripción
    public function searchByDescription(Request $request)
    {
        $baseUrl = env('APP_URL');
        $libros = Libro::select(['*', DB::raw("CONCAT('$baseUrl/api/download/',libros.file) as download_route")])
            ->with('user','category')
            ->when($request->description, function ($query) use ($request) {
                $query->where('description', 'LIKE', "%{$request->description}%");
            })
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10);

        return response()->json([
            'summary' => 'success',
            'code' => '200',
            'data' => $libros
        ], 200);
    }
}