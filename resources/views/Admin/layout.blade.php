<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">



    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= asset('templates\libraries\assets\images\favicon.ico')?>" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\bower_components\bootstrap\css\bootstrap.min.css')?>">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\assets\icon\feather\css\feather.css')?>">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\assets\pages\data-table\css\buttons.dataTables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')?>">
    <!-- Notification.css -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\assets\pages\notification\notification.css')?>">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\assets\icon\themify-icons\themify-icons.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\assets\icon\font-awesome\css\font-awesome.min.css')?>">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\assets\icon\icofont\css\icofont.css')?>">

    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\bower_components\bootstrap-multiselect\css\bootstrap-multiselect.css')?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\bower_components\multiselect\css\multi-select.css')?>">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\assets\css\style.css')?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('templates\libraries\assets\css\jquery.mCustomScrollbar.css')?>">

    <link rel="stylesheet" type="text/css" href="<?= asset('templates\css\app.css')?>">
    <link type="text/css" rel="stylesheet" href="<?= asset('templates\libraries\assets\pages\jquery.filer\css\jquery.filer.css')?>">
    <link type="text/css" rel="stylesheet" href="<?= asset('templates\libraries\assets\pages\jquery.filer\css\themes\jquery.filer-dragdropbox-theme.css')?>">

    <!-- ckeditor js -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    @yield('css')

    <style>
        body {
            font-size: 16px;
        }

        select.form-control:not([size]):not([multiple]) {
            height: auto !important;
        }
    </style>
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div style="position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -50px;
        margin-left: -50px;
        width: 100px;
        height: 100px;" class='contain'>
            <div class="preloader3 loader-block">
                <div class="circ1 loader-primary loader-md"></div>
                <div class="circ2 loader-primary loader-md"></div>
                <div class="circ3 loader-primary loader-md"></div>
                <div class="circ4 loader-primary loader-md"></div>
            </div>

        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

        @include('User.Chat.chat')

            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('Admin.navbar')
                    @yield('content')

                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Ends -->
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\select2\js\select2.full.min.js')?>"></script>


    <!-- Validation js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?= asset('templates\libraries\assets\pages\form-validation\validate.js')?>"></script>
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\jquery\js\jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\jquery-ui\js\jquery-ui.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\popper.js\js\popper.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\bootstrap\js\bootstrap.min.js')?>"></script>

    <!-- jquery file upload js -->
    <script src="<?= asset('templates\libraries\assets\pages\jquery.filer\js\jquery.filer.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\assets\pages\filer\custom-filer.js" type="text/javascript')?>"></script>
    <script src="<?= asset('templates\libraries\assets\pages\filer\jquery.fileuploads.init.js" type="text/javascript')?>"></script>

    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\jquery-slimscroll\js\jquery.slimscroll.js')?>"></script>
    <!-- data-table js -->
    <script src="<?= asset('templates\libraries\bower_components\datatables.net\js\jquery.dataTables.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\assets\pages\data-table\js\jszip.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\assets\pages\data-table\js\pdfmake.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\assets\pages\data-table\js\vfs_fonts.js')?>"></script>
    <script src="<?= asset('templates\libraries\bower_components\datatables.net-buttons\js\buttons.print.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\bower_components\datatables.net-buttons\js\buttons.html5.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')?>"></script>
    <!-- notification js -->
    <script type="text/javascript" src="<?= asset('templates\libraries\assets\js\bootstrap-growl.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\assets\pages\notification\notification.js')?>"></script>

    <!-- modernizr js -->
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\modernizr\js\modernizr.js')?>"></script>

    <!-- Chart js -->
    <script src="<?= asset('templates\libraries\assets\js\jquery.mCustomScrollbar.concat.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\assets\js\pcoded.min.js')?>"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\i18next\js\i18next.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\bower_components\jquery-i18next\js\jquery-i18next.min.js')?>"></script>
    <!-- custom js -->
    <script src="<?= asset('templates\libraries\assets\js\vartical-layout.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\assets\js\script.js')?>"></script>
    <script src="<?= asset('templates\libraries\assets\pages\data-table\js\data-table-custom.js')?>"></script>
    <script src="<?= asset('templates\libraries\assets\js\pcoded.min.js')?>"></script>
    <script src="<?= asset('templates\libraries\assets\js\jquery.mCustomScrollbar.concat.min.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\js\app.js')?>"></script>
    <script type="text/javascript" src="<?= asset('templates\libraries\assets\js\jquery.quicksearch.js')?>"></script>
    <!-- ajax -->

    <script>
        $('#remove-alert').on('click', function() {
            $('.alert').remove();
        })

        $(function() {
            $('[data-toggle="popover"]').popover({
                trigger: 'focus',
                container: 'body',
                boundary: 'body',
                fallbackPlacement: ['bottom', 'bottom', 'bottom', 'bottom']
            })
        })
    </script>
    <script>
        function fileValidation() {
            var fileInput =
                document.getElementById('filer_input1');

            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions =
                /(\.xlsx|\.xls)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Vui lòng chọn đúng định dạng file excel vd: *.xlsx,*.xls !');
                fileInput.value = '';
                return false;
            }
        }
    </script>
@yield('js')
</body>

</html>
