<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chair;
use App\Models\Table;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TableController extends Controller
{

    public function getTables()
    {
        $tables = Table::with('chairs.user')
            ->select('*', 'name as label', 'name as value')
            ->get();

        return response()->json(
            [
                'data' => $tables,
                'message' => 'Success'
            ],
            200
        );
    }

    public function getGroupedTablesChairs()
    {
        $data = Table::with('items:table_id,code as value,name as label')
            ->select('id', 'code as value', 'name as label')
            ->get();

        return response()->json($data);
    }

    public function storeTable(Request $request)
    {
        $data = new Table();
        $data->name = $request->input('table.name');
        $data->code = $request->input('table.code');
        $data->save();

        return response()->json([
            'summary' => 'success',
            'code' => '201',
            'data' => $data,
        ], 201);
    }

    public function storeTableByNumber(Request $request)
    {
        $numberOfRecords = Table::All();

        if (count($numberOfRecords) == 0) {
            for ($i = 0; $i < $request->input('number'); $i++) {
                $data = new Table();
                $code = 'SOLVIT' . count($numberOfRecords) + 1 . 'S';
                $name = 'Mesa ' . count($numberOfRecords) + 1;
                $data->code = $code;
                $data->name = $name;
                $data->save();
                $numberOfRecords = Table::All();
            }
        } else {
            $f = 1;
            $numberOfRecords = Table::All();
            for ($i = 0; $i < $request->input('number'); $i++) {
                foreach ($numberOfRecords as $value) {
                    if ($value->name == 'Mesa '.$f) {
                        $f = $f+1;
                    }else{
                        foreach ($numberOfRecords as $value) {
                        	if ($value->name == 'Mesa '.$f) {
                            	$f = $f+1;
                            }
                        }             
                    }                     
                }
                $data = new Table();
                $code = 'SOLVIT' . $f . 'S';
                $name = 'Mesa ' . $f;
                $data->code = $code;
                $data->name = $name;
                $data->save();
                $f = $f+1;   
            }
        }


        return response()->json([
            'summary' => 'success',
            'code' => '201',
        ], 201);
    }

    public function updateTable(Request $request, $id)
    {
        $table = Table::findOrFail($id);
        $table->name = $request->input('table.name');
        $table->code = $request->input('table.code');
        $table->update();

        return response()->json(['data' => $table, 'msg' => [
            'summary' => 'success',
            'detail' => 'Document updated successfully',
            'code' => '200'
        ]], 200);
    }

    public function destroy($id)
    {
        $table = Table::find($id);
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
}
