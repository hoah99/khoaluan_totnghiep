@extends('layouts.client')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="js/jquery-1.11.1.min.js"></script>




<link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css"><script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<style>
    h4{
        color: dodgerblue;
    }
    span{
        color: red;
    }
</style>
@endsection

@section('nav_yeucau','active')

@section('client_content')
    <div class="container">
        <h1>PHIẾU YÊU CẦU</h1>
        <form action="{{ route('yeucau.store') }}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
            @endif

            <h4>1. Thông tin bắt buộc <span>(*)</span></h4>
                <div class="form-group">
                    <label><span style="color: red;">*</span>Mô tả</label>
                    <textarea name="editor1" class="form-control " id="editor1"></textarea>
                </div> 
                <div class="form-group">
                    <label for="name"></label>
                </div>
            <h4>2. Thông tin không bắt buộc</h4>
                <div class="form-group">
                    <label for="name">*Tiêu đề</label>
                    <input type="text" class="form-control" id="tieude" name="tieude">
                </div>

                <div class="row">
                    <div class="col">
                    <span>*Chọn hạn ngày</span>
                    <div class="md-form form-group">
                        <input type="date" class="form-control" id="hanngay" name="hanngay">
                    </div>
                </div>
                </div>
                <div class="file-upload-wrapper">
                    <label for="name">*Tệp đính kèm</label>
                    <input type="file" name="file">
                </div>
                <br>
                @php
                    use App\Modules\DuAn\Models\DuAn;

                    $DuAn = DuAn::all();
                @endphp

                <div class="form-group">
                    <label for="name">*Chọn dự án cần hỗ trợ</label>
                        <select class="form-control" id="IDDuAn" name="IDDuAn">
                            <option value="" disabled selected>--Chọn dự án--</option>
                            @foreach($DuAn as $key => $duan)
                            <option value="{{$duan->id}}">{{$duan->TenDA}}</option>
                            @endforeach
                        </select>
                </div>
                @php
                use App\Modules\CanBo\Models\CanBo;

                $CanBo = CanBo::all();
            @endphp

            <div class="form-group">
                <label for="name">*Chọn cán bộ hỗ trợ</label>
                    <select class="form-control" id="IDCanBo" name="IDCanBo">
                        <option value="" disabled selected>--Chọn cán bộ--</option>
                        @foreach($CanBo as $key => $canbo)
                        <option value="{{$canbo->id}}">{{$canbo->HoTen}}</option>
                        @endforeach
                    </select>
            </div>
                <button type="submit" id="btnGuiYeuCau" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;
                    Gửi</button>
            </div>
        </form>

    </div>





{{-- thu vien ckeditor --}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('editor1');
</script>

@endsection