@extends('Admin.layout')
@section('content')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-12">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Thông Tin Yêu Cầu</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page-body start -->
                <div class="page-body">

                    <!--profile cover end-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- tab content start -->
                            <div class="tab-content">
                                <!-- tab panel personal start -->
                                <div class="tab-pane active" id="personal" role="tabpanel">
                                    <!-- personal card start -->
                                    <div class="card">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-block">
                                            <div class="edit-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <form action="{{ url('dashboard/transaction/update') }}" method="POST">
                                                        @csrf
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <input type="hidden" name="id" value="{{  $transaction['id'] }}">
                                                                    <div class="col-md-6">
                                                                        <label for="bank_account">Số Tài Khoản</label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="bank_account" value="{{ $transaction['bank_account'] }}" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="bank_account">Tên Ngân Hàng</label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="bank_name" value="{{$transaction['bank_name'] }}" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="bank_account">Tên Chủ Tài Khoản</label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="account_name" value="{{ $transaction['account_name'] }}" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="bank_account">Số Tiền</label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="so_tien" value="{{  $transaction['so_tien'] }}" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="bank_account">Số Xu</label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="quantity_coin" value="{{ $transaction['quantity_coin'] }}" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-md-6">
                                                                        <label for="status">Trạng thái</label>
                                                                        <div class="input-group">
                                                                            <select name="status" class="form-control">
                                                                                
                                                                                <option value="0">Đang Xử Lý</option>
                                                                                <option value="1">Đã Xử Lý</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- end of row -->
                                                                <div class="row">
                                                                    <div class="col-md-12 text-right">
                                                                        <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                                        <a href="" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end of edit info -->
                                                        </form>
                                                    </div>
                                                    <!-- end of col-lg-12 -->
                                                </div>
                                                <!-- end of row -->
                                            </div>
                                        </div>
                                        <!-- end of card-block -->
                                    </div>
                                    <!-- personal card end-->
                                </div>

                            </div>
                            <!-- tab content end -->
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main body end -->
    </div>
</div>

@endsection
@section('js')

<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor3');



    // var cleave = new Cleave('.cleave1', {
    //     numeral: true,
    //     numeralThousandsGroupStyle: 'thousand'
    // });

    // var cleave2 = new Cleave('.cleave2', {
    //     numeral: true,
    //     numeralThousandsGroupStyle: 'thousand'
    // });

    function slug(str) {

        str = str.replace(/^\s+|\s+$/g, "");
        str = str.toLowerCase();

        var from = "àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ·/_,:;";
        var to = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyd------";
        for (var i = 0; i < from.length; i++) {
            str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, "-")
            .replace(/-+/g, "-")

        return str
    }

    // $('#name').on('input', function() {
    //     $('#slug').val(slug($(this).val()))
    // })

    document.getElementById('name').oninput = function() {
        document.getElementById('slug').value = (slug(document.getElementById('name').value))
    }
</script>

@endsection
