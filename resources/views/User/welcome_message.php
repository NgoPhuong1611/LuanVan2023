<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Trang chủ</title>

    <link href="<?= base_url() ?>/resources/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>/resources/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?= base_url() ?>/resources/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/resources/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/resources/css/style.css" />
    <link href="<?= base_url() ?>/resources/font/font.css" rel="stylesheet">

    <link href="<?= base_url() ?>/resources/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>/resources/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?= base_url() ?>/resources/css/style.css" rel="stylesheet">


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
    <?= $this->include("User/header") ?>
    <?= $this->renderSection('content') ?>
    <?= $this->include("User/footer") ?>




</body>
<script src="http://code.jquery.com/jquery.js"></script>
<!-- <script src="../resources/js/bootstrap.min.js>"></script> -->
<script src="<?= base_url() ?>/resources/js/jquery-1.js"></script>
<script src="<?= base_url() ?>/resources/js/bootstrap.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="<?= base_url() ?>/resources/js/client/home.js"></script>

</html>
