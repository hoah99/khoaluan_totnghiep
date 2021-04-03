<?php

namespace App\Modules\DonVi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\DonVi\Models\DonVi;
use DataTables;


class DonViController extends Controller
{
    public function index(Request $request)
    {
        $donvi = DonVi::latest()->get();
        
        if ($request->ajax()) {
            $data = DonVi::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDonVi"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;Sửa</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDonVi"><i class="fa fa-trash" aria-hidden="true"></i></i>&nbsp;Xóa</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('DonVi::donvi',compact('donvi'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DonVi::updateOrCreate(['id' => $request->donvi_id],
            ['TenDV' => $request->TenDV]);        
   
        return response()->json(['success'=>'Thêm thành công']);
    }

    public function edit($id)
    {
        $donvi = DonVi::find($id);
        return response()->json($donvi);

    }

    
    public function destroy($id)
    {
        DonVi::find($id)->delete();
      
        return response()->json(['success'=>'Xóa thành công']);
    }
}

