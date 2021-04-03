<?php

namespace App\Modules\CanBo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Modules\CanBo\Models\CanBo;
use App\Modules\DonVi\Models\DonVi;
use App\Modules\NhomQuyen\Models\NhomQuyen;


class CanBoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $canbo = CanBo::latest()->get();
        


        // $donvi = DonVi::pluck('TenDV', 'id');
        // $nhomquyen = NhomQuyen::pluck('TenQuyen', 'id');
        
        if ($request->ajax()) {
            $data = CanBo::latest()->get();

            foreach ($data as $key => $value) {
                $data[$key]->TenDV = DonVi::where('id','=',$data[$key]->IDDonVi)->first()->TenDV;
                $data[$key]->TenQuyen = NhomQuyen::where('id','=',$data[$key]->IDNhomQuyen)->first()->TenQuyen;
            }
            // $data = CanBo::join('don_vi', 'can_bo.IDDonVi', '=', 'don_vi.id')
            // ->join('nhom_quyen', 'can_bo.IDNhomQuyen', '=', 'nhom_quyen.id')
            // ->select(['can_bo.id','can_bo.HoTen', 'can_bo.TaiKhoan', 'can_bo.MatKhau', 'can_bo.Email', 'don_vi.TenDV','nhom_quyen.TenQuyen', 'can_bo.created_at', 'can_bo.updated_at']);

           

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCanBo"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;Sửa</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCanBo"><i class="fa fa-trash" aria-hidden="true"></i></i>&nbsp;Xóa</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
      
        return view('CanBo::canbo',compact('canbo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CanBo::updateOrCreate(['id' => $request->canbo_id],
            ['HoTen' => $request->HoTen,
            'TaiKhoan' => $request->TaiKhoan,
            'MatKhau' => $request->MatKhau,
            'Email' => $request->Email,
            'IDDonVi' => $request->IDDonVi,
            'IDNhomQuyen' => $request->IDNhomQuyen]
        );        
   
        return response()->json(['success'=>'Thêm thành công']);
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
        $canbo = CanBo::find($id);
        return response()->json($canbo);
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
        CanBo::find($id)->delete();
      
        return response()->json(['success'=>'Xóa thành công']);
    }

}
