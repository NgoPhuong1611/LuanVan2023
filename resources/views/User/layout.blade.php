<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= isset($title) && !empty($title) ? $title : 'Document' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

   <link href="{{ asset('resources/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/bootstrap-responsive.css') }}" rel="stylesheet">
<link href="{{ asset('resources/css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('resources/css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('resources/css/style.css') }}" />
<link href="{{ asset('resources/font/font.css') }}" rel="stylesheet">

    <!-- ************ -->
    <!-- <link href="../resources/font/font.css" rel="stylesheet"> -->
    <style>
        .radio-inline {
            display: inline-flex;
            padding-left: 35px;
        }

        input[type=radio] {
            margin-right: 5px;
        }

        h3 {
            margin: 0;
        }
    </style>
</head>

<body>
    <!--HEADER ROW-->
    @include("User.header")
    @yield('content')
    @include("User.footer")




</body>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="{{ asset('resources/js/jquery-1.js') }}"></script>
<script src="{{ asset('resources/js/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="{{ asset('resources/js/client/home.js') }}"></script>
</html>
