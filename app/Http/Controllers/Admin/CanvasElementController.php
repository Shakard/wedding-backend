<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CanvasElement;
use App\Models\Catalogue;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CanvasElementController extends Controller
{
    //=============================Me trae todos los elementos de typo mesa=================================
    public function getAllElements()
    {
        $elements = CanvasElement::where('id', '>', 0)
            ->with('users')
            ->withCount('users')
            ->orderByRaw("CAST(name as UNSIGNED) ASC")
            ->get();

        return response()->json(
            [
                'data' => $elements,
                'message' => 'Success'
            ],
            200
        );
    }

    public function getDiningTablesWithGuests()
    {
        $tables = CanvasElement::where('catalogue_id', 18)
            ->with('users')
            ->withCount('users')
            ->orderByRaw("CAST(name as UNSIGNED) ASC")
            ->get();

        return response()->json(
            [
                'data' => $tables,
                'message' => 'Success'
            ],
            200
        );
    }

    public function getCanvasElementsByType(Request $request)
    {
        $catalogue = $request->all();
        $canvasElements = CanvasElement::where('catalogue_id', $catalogue)
            ->with('users')
            ->withCount('users')
            ->orderByRaw("CAST(name as UNSIGNED) ASC")
            ->get();

        return response()->json(
            [
                'data' => $canvasElements,
                'message' => 'Success'
            ],
            200
        );
    }

    public function storeCanvasElement(Request $request)
    {
        $numberOfRecords = CanvasElement::where('catalogue_id', $request->input('canvas_element.catalogue_id'))->get();
        $data = new CanvasElement();
        $code = 'SOLVIT' . count($numberOfRecords) + 1 . $request->input('canvas_element.code');
        $name = $request->input('canvas_element.name') . ' ' . count($numberOfRecords) + 1;
        $catalogue = Catalogue::find($request->input('canvas_element.catalogue_id'));
        $data->code = $code;
        $data->name = $name;
        $data->chairs = $request->input('canvas_element.chairs');
        $data->image = $request->input('canvas_element.image');
        $data->pos_x = 5;
        $data->pos_y = 5;
        $data->width = 80;
        $data->height = 80;
        $data->catalogue()->associate($catalogue);
        $data->save();

        return response()->json([
            'summary' => 'success',
            'code' => '201',
            'data' => $catalogue,
        ], 201);
    }

    public function storeRoundTableByNumber(Request $request)
    {

        for ($i = 1; $i <= $request->input('number'); $i++) {
            $numberOfRecords = CanvasElement::where('catalogue_id', $request->input('canvas_element.catalogue_id'))->get();
            $data = new CanvasElement();
            $code = 'SOLVIT' . count($numberOfRecords) + 1 . $request->input('canvas_element.code');
            $name = $request->input('canvas_element.name') . ' ' . count($numberOfRecords) + 1;
            $catalogue = Catalogue::find($request->input('canvas_element.catalogue_id'));
            $data->code = $code;
            $data->name = $name;
            $data->chairs = $request->input('canvas_element.chairs');
            $data->image = $request->input('canvas_element.image');
            $data->pos_x = 50;
            $data->pos_y = 70;
            $data->width = 80;
            $data->height = 80;
            $data->catalogue()->associate($catalogue);
            $data->save();
        }

        return response()->json([
            'summary' => 'success',
            'code' => '201',
        ], 201);
    }

    public function storeCanvasElementByNumber(Request $request)
    {
        $numberOfRecords = CanvasElement::All();

        if (count($numberOfRecords) == 0) {
            for ($i = 0; $i < $request->input('number'); $i++) {
                $data = new CanvasElement();
                // $code = 'SOLVIT' . count($numberOfRecords) + 1 . 'S';
                $code = 'SOLVIT' . count($numberOfRecords) + 1 . 'S';
                $name = 'Mesa ' . count($numberOfRecords) + 1;
                $data->code = $code;
                $data->name = $name;
                $data->save();
                $numberOfRecords = CanvasElement::All();
            }
        } else {
            $f = 1;
            $numberOfRecords = CanvasElement::All();
            for ($i = 0; $i < $request->input('number'); $i++) {
                foreach ($numberOfRecords as $value) {
                    if ($value->name == 'Mesa ' . $f) {
                        $f = $f + 1;
                    } else {
                        foreach ($numberOfRecords as $value) {
                            if ($value->name == 'Mesa ' . $f) {
                                $f = $f + 1;
                            }
                        }
                    }
                }
                $data = new CanvasElement();
                $code = 'SOLVIT' . $f . 'S';
                $name = 'Mesa ' . $f;
                $data->code = $code;
                $data->name = $name;
                $data->save();
                $f = $f + 1;
            }
        }


        return response()->json([
            'summary' => 'success',
            'code' => '201',
        ], 201);
    }

    public function updatePosition(Request $request)
    {
        $request = $request->all();
        $element = CanvasElement::find($request['id']);
        $element->pos_x = ($request['pos_x'] + $element->pos_x);
        $element->pos_y = ($request['pos_y'] + $element->pos_y);       
        $element->update();

        return response()->json([
            'data' => $element,
            'msg' => [
                'summary' => 'Actualización exitosa',
                'detail' => 'La mesa fue actualizada exitósamente',
                'code' => '201'
            ]
        ], 201);
    }
 

    public function updateSize(Request $request)
    {
        $request = $request->all();
        $element = CanvasElement::find($request['id']);
        $element->width = ($request['width']);
        $element->height = ($request['height']);
        $element->update();

        return response()->json([
            'data' => $element,
            'msg' => [
                'summary' => 'Actualización exitosa',
                'detail' => 'Las dimensiones fueron actualizadas exitósamente',
                'code' => '201'
            ]
        ], 201);
    }

    public function resetPosition()
    {

        $elements = CanvasElement::All();

        foreach ($elements as $element) {
            $element->pos_x = null;
            $element->pos_y = null;
            $element->save();
        }

        return response()->json(
            [
                'data' => $elements,
                'message' => 'Success'
            ],
            200
        );
    }

    public function updateCanvasElements(Request $request)
    {
        $tables = $request->data; //pido toda la data del array y le asigno a la variable mesas               
        foreach ($tables as $table) { //por cada mesa del array
            $users = $table['users']; //selecciono a los invitados de la mesa en el array
            $table = CanvasElement::find($table['id']); //busco el objeto "mesa" por el id de la mesa del array
            foreach ($users as $user) { //por cada usuario
                $user = User::find($user['id']); //busco al objeto "usuario" por el id del usuario en el array     
                $user->canvasElement()->associate($table); //por medio de eloquent asigno el objeto "mesa" al objeto "usuario"
                $user->update(); //actualizo el objeto          
            }
        }

        return response()->json([
            'data' => $user,
            'summary' => 'success',
            'code' => '201',
        ], 201);
    }


    public function destroy($id)
    {
        $table = CanvasElement::find($id);
        $table->delete();

        return response()->json([
            'data' => $table,
            'msg' => [
                'summary' => 'Mesa eliminada',
                'detail' => 'La mesa fue eliminada exitósamente',
                'code' => '201'
            ]
        ], 201);
    }

    public function destroyAll()
    {
        $elements = CanvasElement::All();
        foreach ($elements as $element) {
            $element->delete();
        }

        return response()->json([
            'msg' => [
                'summary' => 'Elementos eliminados',
                'detail' => 'Los elementos fueron eliminados exitósamente',
                'code' => '201'
            ]
        ], 201);
    }

    public function getDinningTablesDropDown()
    {
        $tables = CanvasElement::where('catalogue_id', 18)
            ->distinct()->get(['name as label', 'name as value']);
            
        return response()->json(
            [
                'data' => $tables,
                'message' => 'Success'
            ],
            200
        );
    }
}
