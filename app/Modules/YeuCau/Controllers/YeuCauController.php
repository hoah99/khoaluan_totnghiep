<?php

namespace App\Modules\YeuCau\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\YeuCau\Models\YeuCau;
use App\Modules\DuAn\Models\DuAn;
use App\Modules\CanBo\Models\CanBo;

use DataTables;

class YeuCauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('YeuCau::yeucau');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $yeucau = new YeuCau();

        // $yeucau->NoiDung = $request->input('editor1');
        // $yeucau->TieuDe = $request->tieude;
        // $yeucau->HanNgay = $request->input('hanngay');
        // if($request->file()){
        // $yeucau->DinhKem = $request->file_upload->getClientOriginalName();
        // $request->file('file_upload')->store('uploads');
        // }
        // $yeucau->IDDuAn = $request->IDDuAn;
        // $yeucau->IDCanBo = $request->IDCanBo;
        // $yeucau->save();
        
        // return redirect()->route('yeucau.index');
        return view('YeuCau::yeucau');
        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            // $request->validate([
            //     'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            // ]);

            // lưu file tại storage\app\public\upload_files
            $request->file->store('upload_files', 'public');

            $yeucau = new YeuCau([
                "NoiDung" => $request->input('editor1'),
                "TieuDe" => $request->tieude,
                "DinhKem" => $request->file->getClientOriginalName(),
                "HanNgay" => $request->hanngay,
                "IDDuAn" => $request->IDDuAn,
                "IDCanBo" => $request->IDCanBo
            ]);
            $yeucau->save(); 
        }

        return redirect()->route('yeucau.index');
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
