<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input style="display:none;" id="baseUrl" value="" />
</head>

<body>
    <div class="container">
        <h3 class="page-header"></h3>
        <br>
        <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a>Đăng Nhập</a></li>
            <li><a href="<?= base_url('User/Register') ?>">Đăng Ký</a></li>
        </ul>
        <div class="tab-content">
            <form class="form-login" action="<?= base_url('User/userlogin') ?>" method="post">

                <div class="col-12">
                    <?php $errors = session()->getFlashdata('error_msg') ?>
                    <?php if (!empty($errors)) :  ?>
                        <?php if (!is_array($errors)) : ?>
                            <div class="alert alert-danger mb-1">
                                <?= $errors ?>
                            </div>
                        <?php else : ?>
                            <?php foreach ($errors as $error) : ?>
                                <div class="alert alert-danger mb-1">
                                    <?= $error ?>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endif ?>
                </div>

                <div class="container">
                    <label for="username"><b>Username</b></label>
                    <input style="width: 500px;" type="text" placeholder="Enter Username" name="username" required>
                    <label for="passsword"><b>Password</b></label>
                    <input style="width: 500px;" type="password" placeholder="Enter Password" name="password" required>
                    <br>
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="<?= base_url() ?>resources/js/client/profileClient.js"></script>
<?= $this->endSection() ?>