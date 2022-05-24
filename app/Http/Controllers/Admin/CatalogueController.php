<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;

class CatalogueController extends Controller
{
    public function getCanvasElementsTypes()
    {
        // $canvasElements = Catalogue::where('type', 'canvas_elements')
        //     // ->with('users')
        //     // ->withCount('users')
        //     // ->orderByRaw("CAST(name as UNSIGNED) ASC")
        //     ->get();

        $tables = Catalogue::orderBy('name')
            ->select('*', 'name as label', 'id as value')
            ->where('type', 'canvas_elements')
            ->get();
    

        return response()->json(
            [
                'data' => $tables,
                'message' => 'Success'
            ],
            200
        );
    }
}
