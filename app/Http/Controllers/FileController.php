<?php


namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FileController extends Controller

{

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('create');
    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function getAllFiles() {
        $images = File::All();

        return response()->json(
            [
                'data' => $images,
                'message' => 'Success'
            ],
            200
        );
    } 

    public function downloadFile() {
        $filePath = public_path('CATALOGO 2022 TOCADOS VEU.pdf');
    	$headers = ['Content-Type: application/pdf'];
    	$fileName = time().'.pdf';

    	return response()->download($filePath, $fileName, $headers);
    } 

    public function storeFiles(Request $request)

    {       
        foreach ($request->file() as $image) {
            $imageName = Str::random(10) . time() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/images', $imageName);
            $file = new File();
            $file->filename = $imageName;
            $url = url('/') . '/assets/images/' . $imageName;
            $file->url = $url;
            $file->save();
        }

        return response()->json(
            [
                'data' => $imageName,
                'message' => 'Success'
            ],
            200
        );
    }
}
