<?php


namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;


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

    public function storeFiles(Request $request)

    {


        $this->validate($request, [

                'filenames' => 'required',

                'filenames.*' => 'mimes:doc,pdf,docx,zip'

        ]);


        if($request->hasfile('filenames'))

         {

            foreach($request->file('filenames') as $file)

            {

                $name = time().'.'.$file->extension();

                $file->move(public_path().'/files/', $name);  

                $data[] = $name;  

            }

         }


         $file= new File();

         $file->filenames=json_encode($data);

         $file->save();


         return response()->json(
            [
                'data' => $file,
                'message' => 'Success'
            ],
            200
        );
    }

}