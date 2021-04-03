@extends('layouts.admin')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('nav_donvi','active')
    


@section('admin_content')
<div class="container">
    <h1>QUẢN LÝ ĐƠN VỊ</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createDonVi"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Thêm đơn vị</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Đơn vị</th>
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
                <form id="donviForm" name="donviForm" class="form-horizontal">
                   <input type="hidden" name="donvi_id" id="donvi_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Tên đơn vị:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="TenDV" name="TenDV" placeholder="Nhập tên đơn vị" value="" required="">
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
              ajax: "{{ route('donvi.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'TenDV', name: 'TenDV'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          $('#createDonVi').click(function () {
              $('#saveBtn').val("create-donvi");
              $('#donvi_id').val('');
              $('#donviForm').trigger("reset");
              $('#modelHeading').html("THÊM ĐƠN VỊ");
              $('#ajaxModel').modal('show');
          });

          

          $('body').on('click', '.editDonVi', function () {
            var donvi_id = $(this).data('id');
            $.get("{{ route('donvi.index') }}" +'/' + donvi_id +'/edit', function (data) {
                $('#modelHeading').html("Sửa đơn vị");
                $('#saveBtn').val("edit-donvi");
                $('#ajaxModel').modal('show');
                $('#donvi_id').val(data.id);
                $('#TenDV').val(data.TenDV);
                
            })
         });
          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $(this).html('Lưu');
          
              $.ajax({
                data: $('#donviForm').serialize(),
                url: "{{ route('donvi.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
           
                    $('#donviForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
               
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Lưu');
                }
            });

            
          });
          
          
          
          $('body').on('click', '.deleteDonVi', function (e) {
           
            if(!confirm("Bạn có chắc muốn xóa?")){
                return false;
            }
            e.preventDefault();
              var donvi_id = $(this).data("id");
            //   confirm("Bạn có chắc muốn xóa?");
            
              $.ajax({
                  type: "DELETE",
                  url: "{{ route('donvi.store') }}"+'/'+donvi_id,
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