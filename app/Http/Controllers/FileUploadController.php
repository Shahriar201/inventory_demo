<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Jobs\FileUploadCSV;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.file-upload.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.file-upload.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file'=> 'required|mimes:xlsx,xls'
        ]);

        try {
            $input = [];
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move('uploads/file/', $fileName);
                $input['file'] = $fileName;
            }
            $file = File::create($input);

            $uploadCSVInput = [
                'file' => public_path().'/uploads/file/'.$file->file,
            ];

            FileUploadCSV::dispatch($uploadCSVInput);

            return redirect()->back()->with('success', 'File inserted successfully');
        } catch (\Exception $e) {
            Log::error($e);
            dd($e->getMessage());
            return \redirect()->back()->with('error', $e->getMessage());
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
