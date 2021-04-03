@extends('layouts.admin')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

@endsection

@section('nav_monthi','active')

@section('admin_content')
<div class="container">
    <h1>QUẢN LÝ MÔN THI</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createMonThi"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Thêm môn thi</a>
    <table class="table table-bordered" id="tbl_monthi">
        <thead>
            <tr>
                <th>No</th>
                <th>Môn thi</th>
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
                <form id="monthiForm" name="monthiForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Tên môn thi:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tenmon" name="tenmon" placeholder="Nhập tên môn thi" value="" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create" onclick="toastr.success('Thành công!');">Lưu
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
          var table = $('#tbl_monthi').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('monthi.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'tenmon', name: 'tenmon'},
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
          $('#createMonThi').click(function () {
              $('#saveBtn').val("create-monthi");
              $('#id').val('');
              $('#monthiForm').trigger("reset");
              $('#modelHeading').html("THÊM MÔN THI");
              $('#ajaxModel').modal('show');
          });

          

          $('body').on('click', '.editMonThi', function () {
            var id = $(this).data('id');
            $.get("{{ route('monthi.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("SỬA MÔN THI");
                $('#saveBtn').val("edit-monthi");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#tenmon').val(data.tenmon);
                
            })
         });
          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $(this).html('Lưu');
          
              $.ajax({
                data: $('#monthiForm').serialize(),
                url: "{{ route('monthi.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
           
                    $('#monthiForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
               
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Lưu');
                }
            });

            
          });
          
          
          
          $('body').on('click', '.deleteMonThi', function (e) {
           
            if(!confirm("Bạn có chắc muốn xóa?")){
                return false;
            }
            e.preventDefault();
              var id = $(this).data("id");
            
              $.ajax({
                  type: "DELETE",
                  url: "{{ route('monthi.store') }}"+'/'+id,
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