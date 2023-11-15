<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input style="display:none;" id="baseUrl" value="" />

<body>

    <div class="container">
        <h3 class="page-header"></h3>

        <ul class="nav nav-tabs" id="tabs">
            <li><a href="<?= base_url('User/Login') ?>">Đăng Nhập</a></li>
            <li class="active"><a>Đăng Ký</a></li>
        </ul>

        <div>
            <div class="tab-content">
                <div class="tab-pane active" id="information">
                    
                    <i style="color: red"> <?php echo session()->get('error'); ?> </i>    
                      
                    <form class="form-profile" action="<?= base_url('User/save') ?>" method="post">
                        <input type="hidden" name="id" value="">
                        <div>
                            <label for="first_name"><b>FirstName :</b></label>
                            <input type="text" style="width: 500px;" name="first_name" pattern="[a-zA-ZÀ-ỹ\s]+" placeholder="FirstName...." required />
                        </div>

                        <div>
                            <label for="last_name"> <b>Lastname :</b> </label>
                            <input type="text" style="width: 500px;" name="last_name" pattern="[a-zA-ZÀ-ỹ\s]+" placeholder="LastName...." required />
                        </div>
                        <div>
                            <label for="username"> <b>UserName :</b></label>
                            <input type="text" style="width: 500px;" name="username" placeholder="UserName...." required />
                        </div>
                        <div>
                            <label for="password"><b>Password :</b> </label>
                            <input type="password" style="width: 500px;" name="password" placeholder="Password...." required />
                        </div>
                        <div>
                            <label for="email"><b>Email :</b></label>
                            <input type="email" style="width: 500px;" name="email" placeholder="Email...." required />
                        </div>

                        <button type="submit" class="registerbtn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>resources/js/client/profileClient.js"></script>
</body>

<?= $this->endSection() ?>