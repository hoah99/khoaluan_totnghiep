@extends('layouts.admin')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('nav_nhomdichvu','active')
    


@section('admin_content')
<div class="container">
    <h1>QUẢN LÝ NHÓM DỊCH VỤ</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNhomDV"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Thêm nhóm dịch vụ</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nhóm dịch vụ</th>
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
                <form id="nhomdvForm" name="nhomdvForm" class="form-horizontal">
                   <input type="hidden" name="nhomdv_id" id="nhomdv_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Tên công việc:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="TenNhom" name="TenNhom" placeholder="Nhập tên nhóm" value="" required="">
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
              ajax: "{{ route('nhomdv.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'TenNhom', name: 'TenNhom'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          $('#createNhomDV').click(function () {
              $('#saveBtn').val("create-nhomdv");
              $('#nhomdv_id').val('');
              $('#nhomdvForm').trigger("reset");
              $('#modelHeading').html("THÊM NHÓM DỊCH VỤ");
              $('#ajaxModel').modal('show');
          });

          

          $('body').on('click', '.editNhomDV', function () {
            var nhomdv_id = $(this).data('id');
            $.get("{{ route('nhomdv.index') }}" +'/' + nhomdv_id +'/edit', function (data) {
                $('#modelHeading').html("Sửa nhóm dịch vụ");
                $('#saveBtn').val("edit-nhomdv");
                $('#ajaxModel').modal('show');
                $('#nhomdv_id').val(data.id);
                $('#TenNhom').val(data.TenNhom);
                
            })
         });
          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $(this).html('Lưu');
          
              $.ajax({
                data: $('#nhomdvForm').serialize(),
                url: "{{ route('nhomdv.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
           
                    $('#nhomdvForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
               
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Lưu');
                }
            });

            
          });
          
          
          
          $('body').on('click', '.deleteNhomDV', function (e) {
           
            if(!confirm("Bạn có chắc muốn xóa?")){
                return false;
            }
            e.preventDefault();
              var congviec_id = $(this).data("id");
            //   confirm("Bạn có chắc muốn xóa?");
            
              $.ajax({
                  type: "DELETE",
                  url: "{{ route('nhomdv.store') }}"+'/'+nhomdv_id,
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