@extends('Admin/layout')
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
                                    <h4>Thêm Đề Thi</h4>
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
                                                        <form action="<?= url('dashboard/exam/save') ?>" method="post"  id="examForm">
                                                        @csrf
                                                            <input type="hidden" name="id" value="">
                                                            <input type="hidden" name="selectedQuestions[]" multiple>
                                                            <div class="general-info">
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="title">Tiêu đề</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="" id="title" name="title" placeholder="Tiêu đề ..." required autofocus>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="title">Xu</label>
                                                                        <div class="input-group">
                                                                            <input type="number" class="form-control"  id="title" name="quantity_coin"  required autofocus>
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
                                                                                <option value="1">Hiển thị</option>
                                                                                <option value="0">Ẩn</option>
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
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value="7">7</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                            <!-- <div class="row">
                                                                    <div class="col-md-12">
                                                                    <label for="part">Chọn Part</label>
                                                                    <div class="input-group">
                                                                    <select id="part" class="form-control" onchange="showTable()">
                                                                        <option value="1">Part 1</option>
                                                                        <option value="2">Part 2</option>
                                                                        <option value="3">Part 3</option>
                                                                        <option value="4">Part 4</option>
                                                                        <option value="5">Part 5</option>
                                                                        <option value="6">Part 6</option>
                                                                        <option value="7">Part 7</option>
                                                                    </select>
                                                                    </div>
                                                                    </div>
                                                                </div> -->
                                                                <!------  danh sach cau hoi----->
                                                                <div class="row">
                                                                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                        <th style="width: 10%;">Phần</th>
                                                                                        <th style="width: 10%;">Id câu hỏi</th>
                                                                                        <th style="width: 40%;">Câu hỏi</th>
                                                                                        <th style="width: 25%;">Ngày tạo</th>
                                                                                        <th style="width: 10%;">Quản lý</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php if (isset($questions) && !empty($questions)) :  ?>
                                                                                            <?php foreach ($questions as $question) : ?>

                                                                                                <tr>
                                                                                                <td style="width: 10%;"><?= $question['exam_part_id'] ?></td>
                                                                                                <td style="width: 10%;"><?= $question['id'] ?></td>
                                                                                                <td style=" width: 60%; max-width: 200px; overflow: hidden; text-overflow: ellipsis;"><?= $question['question'] ?></td>
                                                                                                <td style="width: 25%;"><?= $question['created_at'] ?></td>
                                                                                                <td style="width: 10%;">

                                                                                                <div class="checkbox-fade fade-in-primary d-flex justify-content-center">
                                                                                                    <label>
                                                                                                    <input type="checkbox" class="page-content-checkbox" id="question_<?= $question['id'] ?>" name="selectedQuestions[]" value="<?= $question['id'] ?>">
                                                                                                        <span class="cr">
                                                                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                                                        </span>
                                                                                                    </label>
                                                                                                </div>

                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php endforeach ?>
                                                                                        <?php else : ?>
                                                                                            <tr>
                                                                                                <td colspan="3">Không có câu hỏi nào</td>
                                                                                            </tr>
                                                                                        <?php endif ?>
                                                                                    </tbody>
                                                                                </table>

                                                                </div>
                                                                <!------   end danh sach cau hoi ----->
                                                                <div class="row">
                                                                    <p></p>
                                                                    <p></p>
                                                                </div>

                                                            </div>

                                                            <!-- end of row -->
                                                            <div class="row">
                                                                <div class="col-md-12 text-right">
                                                                <a type="submit" href="<?= url('dashboard/exam/detailradom') ?>" >Thêm ngẫu nhiên</a>                                                                    <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu bài thi</button>
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
@endsection()
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

    document.getElementById('title').oninput = function() {
        document.getElementById('slug').value = (slug(document.getElementById('title').value))
    }
</script>


<script>
function saveSelectedQuestions() {
    var selectedQuestions = [];

    // Duyệt qua từng trang
    $(".page-content-checkbox:checked").each(function () {
        var questionId = $(this).val();
        selectedQuestions.push(questionId);
    });

    // Gán mảng selectedQuestions vào trường input ẩn
    $("#examForm input[name='selectedQuestions']").val(selectedQuestions.join(','));
}

$(document).ready(function () {
    $("button[type='submit']").on('click', function (event) {
        // Gọi hàm saveSelectedQuestions trước khi gửi biểu mẫu
        saveSelectedQuestions();
    });
});
</script>
@endsection

