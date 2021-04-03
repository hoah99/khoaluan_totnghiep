<?php

namespace App\Modules\PhieuYeuCau\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\DuAn\Models\DuAn;
use App\Modules\CanBo\Models\CanBo;
use App\Modules\PhieuYeuCau\Models\PhieuYeuCau;
use DataTables;

class PhieuYeuCauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $PhieuYeuCau = PhieuYeuCau::latest()->get();
        if ($request->ajax()) {
            $data = PhieuYeuCau::latest()->get();
            foreach ($data as $key => $value) {
                 $data[$key]->TenDA = DuAn::where('id','=',$data[$key]->IDDuAn)->first()->TenDA;
                 $data[$key]->HoTen = CanBo::where('id','=',$data[$key]->IDCanBo)->first()->HoTen;
            }     
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPhieuYeuCau"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;Sửa</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePhieuYeuCau"><i class="fa fa-trash" aria-hidden="true"></i></i>&nbsp;Xóa</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('PhieuYeuCau::PhieuYeuCau',compact('PhieuYeuCau'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
