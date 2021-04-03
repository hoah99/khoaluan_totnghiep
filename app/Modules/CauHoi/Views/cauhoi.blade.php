@extends('layouts.admin')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

@endsection

@section('nav_cauhoi','active')



@section('admin_content')
@php
use App\Modules\MonThi\Models\MonThi;
@endphp
<div class="container">
    <h1>QUẢN LÝ CÂU HỎI</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createDuAn"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Thêm câu hỏi</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nội dung</th>
                <th>Chương</th>
                <th>Môn</th>
                <th>Độ khó</th>
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
                <form id="cauhoiForm" name="cauhoiForm" class="form-horizontal">
                  {{ csrf_field() }}
                   <input type="hidden" name="id" id="id">
                   
                   @php
                   $MonThi = MonThi::all();
                   @endphp
                   <div class="form-group">
                       <label for="name" class="col-sm-12 control-label">Môn thi:</label>
                       <div class="col-sm-12">
                           <select class="form-control" id="idmonthi" name="idmonthi" required="">
                             <option value="" disabled selected>--Chọn môn thi--</option>
                             @foreach($MonThi as $key => $monthi)
                             <option value="{{$monthi->id}}">{{$monthi->tenmon}}</option>
                             @endforeach
                           </select>
                       </div>
                   </div>

                   <div class="form-group">
                    <label for="name" class="col-sm-12 control-label">Chương:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="chuong" name="chuong" placeholder="Nhập chương" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Nội dung:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="noidung" name="noidung" placeholder="Nhập nội dung" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Phương án A:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phuongana" name="phuongana" placeholder="Nhập phương án A" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Phương án B:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phuonganb" name="phuonganb" placeholder="Nhập phương án B" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Phương án C:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phuonganc" name="phuonganc" placeholder="Nhập phương án C" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Phương án D:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phuongand" name="phuongand" placeholder="Nhập phương án D" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Đáp án:</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="dapan" name="dapan" required="">
                                <option value="" disabled selected>--Chọn đáp an--</option>
                                <option value="#phuongana">A</option>
                                <option value="#phuonganb">B</option>
                                <option value="#phuonganc">C</option>
                                <option value="#phuongand">D</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Độ khó:</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="dokho" name="dokho" required="">
                                <option value="" disabled selected>--Chọn độ khó--</option>
                                <option value="Dễ">Dễ</option>
                                <option value="Trung bình">Trung bình</option>
                                <option value="Khó">Khó</option>
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
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>  

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
              ajax: "{{ route('cauhoi.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'noidung', name: 'noidung'},
                  {data: 'chuong', name: 'chuong'},
                  {data: 'tenmon', name: 'tenmon'},
                  {data: 'dokho', name: 'dokho'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              language: {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không tìm thấy",
            "info": "Hiển thị trang _PAGE_/_PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "emptyTable": "Không có dữ liệu",
            "infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
            "sSearch": "Tìm kiếm",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            }
        }
          });
          $('#createDuAn').click(function () {
              $('#saveBtn').val("create-cauhoi");
              $('#id').val('');
              $('#cauhoiForm').trigger("reset");
              $('#modelHeading').html("THÊM CÂU HỎI");
              $('#ajaxModel').modal('show');
          });

          

          $('body').on('click', '.editCauHoi', function () {
            var id = $(this).data('id');
            $.get("{{ route('cauhoi.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("SỬA CÂU HỎI");
                $('#saveBtn').val("edit-cauhoi");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#noidung').val(data.noidung);
                $('#phuongana').val(data.phuongana);
                $('#phuonganb').val(data.phuonganb);
                $('#phuonganc').val(data.phuonganc);
                $('#phuongand').val(data.phuongand);
                $('#dapan').val(data.dapan);
                $('#chuong').val(data.chuong);
                $('#dokho').val(data.dokho);
                $('#idmonthi').val(data.idmonthi);      
            })
         });
          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $(this).html('Lưu');
          
              $.ajax({
                data: $('#cauhoiForm').serialize(),
                url: "{{ route('cauhoi.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
           
                    $('#cauhoiForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
               
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Lưu');
                }
            });

            
          });
          
          
          
          $('body').on('click', '.deleteCauHoi', function (e) {
           
            if(!confirm("Bạn có chắc muốn xóa?")){
                return false;
            }
            e.preventDefault();
              var id = $(this).data("id");
            //   confirm("Bạn có chắc muốn xóa?");
            
              $.ajax({
                  type: "DELETE",
                  url: "{{ route('cauhoi.store') }}"+'/'+id,
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