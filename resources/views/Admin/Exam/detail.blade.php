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
                                                        <form action="<?= url('dashboard/exam/save') ?>" method="post">
                                                        @csrf
                                                            <input type="hidden" name="id" value="">
                                                            <div class="general-info">
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
                                                                        <label for="status">Level</label>
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
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="title">Tiêu đề</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="" id="title" name="title" placeholder="Tiêu đề ..." required autofocus>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
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
                                                                        <!-- Các option khác -->
                                                                    </select>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <!------  danh sach cau hoi----->
                                                                <div class="row">
                                                                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                        <th style="width: 10%;">Phần</th>
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
                                                                                                <td style="width: 40%;"><?= $question['question'] ?></td>
                                                                                                <td style="width: 25%;"><?= $question['created_at'] ?></td>
                                                                                                <td style="width: 10%;">

                                                                                                    <div class="checkbox-fade fade-in-primary d-flex justify-content-center">
                                                                                                        <label>
                                                                                                            <input type="checkbox" id="checkbox2" name="status" value="" >
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
                                                                    <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                                    <a href="<?= url('dashboard/posts/detail') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
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
@yield('js')
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
// Tạo các mảng chứa danh sách câu hỏi cho từng phần
var partQuestions = {
    1: <?= json_encode($questions1) ?>,
    2: <?= json_encode($questions2) ?>,
    3: <?= json_encode($questions3) ?>,
    4: <?= json_encode($questions4) ?>,
    5: <?= json_encode($questions5) ?>,
    6: <?= json_encode($questions6) ?>,
    7: <?= json_encode($questions7) ?>,
};

function showTable() {
    var selectedPart = document.getElementById("part").value;
    var questions = partQuestions[selectedPart]; // Lấy danh sách câu hỏi tương ứng với phần đã chọn

    var tableBody = document.getElementById("simpletable").getElementsByTagName("tbody")[0];
    tableBody.innerHTML = ''; // Xóa dữ liệu cũ trong bảng

    if (questions && questions.length > 0) {
        questions.forEach(function(question) {
            var row = tableBody.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            cell1.innerHTML = question.exam_part_id;
            cell2.innerHTML = question.question;
            cell3.innerHTML = question.created_at;
            cell4.innerHTML = '<div class="checkbox-fade fade-in-primary d-flex justify-content-center">' +
    '<label>' +
    '<input type="checkbox" id="checkbox2" name="status" value="" >' +
    '<span class="cr">' +
    '<i class="cr-icon icofont icofont-ui-check txt-primary"></i>' +
    '</span>' +
    '</label>' +
    '</div>';
        });
    } else {
        var row = tableBody.insertRow(0);
        var cell = row.insertCell(0);
        cell.colSpan = 4;
        cell.innerHTML = "Không có câu hỏi nào";
    }
}
</script>
