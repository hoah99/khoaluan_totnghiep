@extends('layouts.admin')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('nav_canbo','active')



@section('admin_content')

@php
use App\Modules\DonVi\Models\DonVi;
use App\Modules\NhomQuyen\Models\NhomQuyen;
@endphp

<div class="container">
    <h1>QUẢN LÝ CÁN BỘ</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createCanBo"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Thêm cán bộ</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Họ tên</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Email</th>
                <th>ID Đơn vị</th>
                <th>ID Nhóm Quyền</th>
                <th>Đơn vị</th>
                <th>Nhóm Quyền</th>
                <th width="300px">Hành động</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="canboForm" name="canboForm" class="form-horizontal">
                    {{ csrf_field() }}
                   <input type="hidden" name="canbo_id" id="canbo_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Họ tên:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="HoTen" name="HoTen" placeholder="Nhập họ tên" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Tài khoản:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="TaiKhoan" name="TaiKhoan" placeholder="Nhập tên tài khoản" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Mật khẩu:</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="MatKhau" name="MatKhau" placeholder="Nhập mật khẩu" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Email:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="Email" name="Email" placeholder="Nhập email" value="" required="">
                        </div>
                    </div>

                    @php
                    $donvi = DonVi::all();
                    $nhomquyen = NhomQuyen::all();
                    @endphp

                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Đơn vị:</label>
                        <div class="col-sm-12">
                            <select name="IDDonVi" id="IDDonVi" class="form-control">
                                <option value="" disabled selected>--Chọn đơn vị--</option>
                                @foreach($donvi as $key => $dv)
                                <option value="{{ $dv->id }}">{{ $dv->TenDV }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Đơn vị:</label>
                        <div class="col-sm-12">
                            <select name="IDNhomQuyen" id="IDNhomQuyen" class="form-control">
                                <option value="" disabled selected>--Chọn nhóm quyền--</option>
                                @foreach($nhomquyen as $key => $nq)
                                <option value="{{ $nq->id }}">{{ $nq->TenQuyen }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Lưu
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  

    <script type="text/javascript">
        




        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('canbo.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'HoTen', name: 'HoTen'},
                  {data: 'TaiKhoan', name: 'TaiKhoan'},
                  {data: 'MatKhau', name: 'MatKhau'},
                  {data: 'Email', name: 'Email'},
                  {data: 'IDDonVi', name: 'IDDonVi'},
                  {data: 'IDNhomQuyen', name: 'IDNhomQuyen'},
                  {data: 'TenDV', name: 'TenDV'},
                  {data: 'TenQuyen', name: 'TenQuyen'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          $('#createCanBo').click(function () {
              $('#saveBtn').val("create-canbo");
              $('#canbo_id').val('');
              $('#canboForm').trigger("reset");
              $('#modelHeading').html("THÊM CÁN BỘ");
              $('#ajaxModel').modal('show');
          });

          

          $('body').on('click', '.editCanBo', function () {
            var canbo_id = $(this).data('id');
            $.get("{{ route('canbo.index') }}" +'/' + canbo_id +'/edit', function (data) {
                $('#modelHeading').html("Sửa cán bộ");
                $('#saveBtn').val("edit-canbo");
                $('#ajaxModel').modal('show');
                $('#canbo_id').val(data.id);
                $('#HoTen').val(data.HoTen);
                $('#TaiKhoan').val(data.TaiKhoan);
                $('#MatKhau').val(data.MatKhau);
                $('#Email').val(data.Email);
                $('#IDDonVi').val(data.IDDonVi);
                $('#IDNhomQuyen').val(data.IDNhomQuyen);
                
            })
         });
          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $(this).html('Lưu');
          
              $.ajax({
                data: $('#canboForm').serialize(),
                url: "{{ route('canbo.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
           
                    $('#canboForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
               
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Lưu');
                }
            });

            
          });
          
          
          
          $('body').on('click', '.deleteCanBo', function (e) {
           
            if(!confirm("Bạn có chắc muốn xóa?")){
                return false;
            }
            e.preventDefault();
              var canbo_id = $(this).data("id");
            //   confirm("Bạn có chắc muốn xóa?");
            
              $.ajax({
                  type: "DELETE",
                  url: "{{ route('canbo.store') }}"+'/'+canbo_id,
                  success: function (data) {
                      table.draw();
                  },
                  error: function (data) {
                      console.log('Error:', data);
                  }
              });
          });
           
        });
      </script>
@endsection