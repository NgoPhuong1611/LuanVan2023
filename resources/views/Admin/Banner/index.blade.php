@extends('Admin.layout')

@section('content')
<style>
    #product-Banner .jFiler-item-info {
    max-width: 500px; /* Adjust the maximum width as needed */
    max-height: 500px; /* Adjust the maximum height as needed */
    overflow: hidden;
}

#product-Banner img {
    width: 100%;
    height: auto;
}
</style>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Banner</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-block">

                                    <form action="{{ url('dashboard/banner/save') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-3" id="Banner">
                                                <label for="upload_Banner">Upload tệp hình ảnh</label>
                                                <input type="file" name="Banner_Banner" id="filer_input_Banner" onchange="return fileValidation()" accept=".jpg, .png, .jpeg, .gif, .psd" multiple="multiple">
                                                @if (isset($Banner))
                                                    <input type="hidden" name="old_Banner_id" value="{{ $Banner['id'] }}">
                                                    <ul id="product-Banner" class="jFiler-items-list jFiler-items-default">
                                                        <li class="jFiler-item" data-jfiler-index="0" id="img-{{ $Banner['id'] }}">
                                                            <div class="jFiler-item-container">
                                                                <div class="jFiler-item-inner">
                                                                    <div class="jFiler-item-info pull-left">
                                                                        <img src="{{ asset('resources/file/images/slide/' . $Banner['img_name']) }}" alt="{{ $Banner['img_name'] }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                    <a href="{{ url('dashboard/banner') }}" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
                                                </div>
                                            </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>

@endsection
@yield('js')
