@extends('layouts.admin')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('nav_phieuyeucau','active')



@section('admin_content')

@php
use App\Modules\DuAn\Models\DuAn;
use App\Modules\CanBo\Models\CanBo;
@endphp

<div class="container">
    <h1>QUẢN LÝ PHIẾU YÊU CẦU</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Đính kèm</th>
                <th>Ngày tạo</th>
                <th>Hạn xử lý</th>
                <th>ID Dự án</th>
                <th>ID Cán bộ</th>
                <th>Dự án</th>
                <th>Cán bộ</th>
                <th>Trạng thái</th>
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
                   <input type="hidden" name="phieuyeucau_id" id="phieuyeucau_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Trạng thái:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="TrangThai" name="TrangThai" placeholder="" value="" required="">
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
@php
$duan = DuAn::all();
$canbo = CanBo::all();
@endphp

    

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
              ajax: "{{ route('phieuyeucau.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'TieuDe', name: 'TieuDe'},
                  {data: 'NoiDung', name: 'NoiDung'},
                  {data: 'DinhKem', name: 'DinhKem'},
                  {data: 'NgayTao', name: 'NgayTao'},
                  {data: 'HanNgay', name: 'HanNgay'},
                  {data: 'IDDuAn', name: 'IDDuAn'},
                  {data: 'IDCanBo', name: 'IDCanBo'},
                  {data: 'TenDA', name: 'TenDA'},
                  {data: 'HoTen', name: 'HoTen'},
                  {data: 'TrangThai', name: 'TrangThai'},
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

          

          $('body').on('click', '.editPhieuYeuCau', function () {
            var phieuyeucau_id = $(this).data('id');
            $.get("{{ route('phieuyeucau.index') }}" +'/' + phieuyeucau_id +'/edit', function (data) {
                $('#modelHeading').html("Sửa phiếu yêu cầu");
                $('#saveBtn').val("edit-phieuyeucau");
                $('#ajaxModel').modal('show');
                $('#phieuyeucau_id').val(data.id);
                $('#TrangThai').val(data.TrangThai);
              
                
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