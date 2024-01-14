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
                                    <h4>Thông tin đề thi</h4>
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

                                            <!-- <div class="alert alert-danger">
                                                <div class="col-10">
                                                    Error
                                                </div>
                                                <div class="col-1 text-right">
                                                    <span aria-hidden="true" id="remove-alert">&times;</span>
                                                </div>
                                            </div> -->

                                            <!-- <div class="alert alert-danger mb-1">
                                                <div class="row">
                                                    <div class="col-11">
                                                        Error
                                                    </div>
                                                    <div class="col-1 text-right">
                                                        <span aria-hidden="true" id="remove-alert">&times;</span>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="card-block">
                                            <div class="edit-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <form action="<?= url('dashboard/exam/update/'.$exam['id']) ?>" method="post">
                                                        @csrf


                                                        <input type="hidden" name="id" value="">
                                                            <input type="hidden" name="selectedQuestions[]" multiple>
                                                            <div class="general-info">
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="title">Tiêu đề</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="<?=  $exam['id']?>" id="title" name="title" placeholder="Tiêu đề ..." required autofocus>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="quantity_coin">Xu</label>
                                                                        <div class="input-group">
                                                                            <input type="number" class="form-control" value="<?=  $exam['quantity_coin']?>"  id="quantity_coin" name="quantity_coin"  required autofocus>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                <div class="col-md-6">
                                                                        <label for="status">Trạng thái</label>
                                                                        <div class="input-group">
                                                                            <select name="status" class="form-control" required>

                                                                                <option value="" disabled selected>
                                                                                    --Chọn trạng thái--
                                                                                </option>
                                                                                <?php  if($exam['status'] == 1): ?>
                                                                                    <option value="1" checked selected >Hiển thị</option>
                                                                                    <option value="0">Ẩn</option>
                                                                                <?php endif ?>
                                                                                <?php  if($exam['status'] == 0): ?>
                                                                                    <option value="1"  >Hiển thị</option>
                                                                                    <option value="0" checked selected>Ẩn</option>
                                                                                <?php endif ?>
                                                                            </select>
                                                                        </div>
                                                                                </div>
                                                                    <div class="col-md-6">
                                                                        <label for="level">Level</label>
                                                                        <div class="input-group">
                                                                            <select name="level" class="form-control" required>
                                                                                <option value="" disabled selected>
                                                                                    --Chọn Level--
                                                                                </option>
                                                                                <option value="1" <?= $exam['level'] == 1 ? 'selected' : ''?> >1</option>
                                                                                <option value="2"<?= $exam['level'] == 2 ? ' selected' : ''?> >2</option>
                                                                                <option value="3"<?= $exam['level'] == 3 ? ' selected' : ''?> >3</option>
                                                                                <option value="4"<?= $exam['level'] == 4 ? ' selected' : ''?> >4</option>
                                                                                <option value="5"<?= $exam['level'] == 5 ? ' selected' : ''?> >5</option>
                                                                                <option value="6"<?= $exam['level'] == 6 ? ' selected' : ''?> >6</option>
                                                                                <option value="7"<?= $exam['level'] == 7 ? ' selected' : ''?> >7</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- end of row -->
                                                                <div class="row">
                                                                    <div class="col-md-12 text-right">
                                                                        <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                                        <a href="<?= url('dashboard/exam/detail') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
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

@yield('js')
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
@if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif
