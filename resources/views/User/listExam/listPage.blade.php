<!DOCTYPE html>

<html>

<head>
    <meta charset="ISO-8859-1">
    <title>Quản lý Vocab</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="../resources/css/searchResult.css">
    <link rel="stylesheet" href="../resources/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
</head>

<script>
    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                continue;
            }
            var img = document.getElementById("previewImage");
            img.file = file;

            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);
        }
    }
</script>

<body>


    <div class="col-md-9 animated bounce">
        <h3 class="page-header">Quản lý Bài hướng dẫn học từ vựng</h3>

        <button class="btn btn-success btnAddVocab" data-toggle="modal" data-target="#vocabModal">Thêm mới</button>

        <h4 style="color:red">error</h4>
        <h4>error: </h4>

        <hr/>

        <table class="table table-hover nhanHieuTable">
            <thead>
                <tr>
                    <th>Vocab Id</th>

                    <th>Name</th>

                    <th>Image</th>


                    <th>Update</th>

                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>


                <tr>
                    <td class="center"> baitaptuvung </td>
                    <td class="center"> enbaituvung</td>
                    <td class="center"> anhbaituvung </td>
                    <td class="center">
                        <a class="yellow" href="#">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                    </td>

                    <td class="center">
                        <a class="red" href="">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                    </td>
                </tr>



            </tbody>



        </table>

    </div>




    <div class="paging">

        <a href="">Back</a>

        <a class="current">1</a>

        <a href="">1</a>


        <a class="current">2</a>

        <a href="">3</a>

        <a href="">Next</a>

    </div>













</body>

</html>