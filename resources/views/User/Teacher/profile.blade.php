@extends('User.Teacher.layout')

@section('content')
<input style="display:none;" id="baseUrl" value="" />
</head>

<body>

	<div class="container">
		<h3 class="page-header">Quản Lý Tài Khoản</h3>
		<ul class="nav nav-tabs" id="tabs">
			<input type="hidden" class="form-control-plaintext nguoiDungId" value="" name="id">
			<li class="active"><a href="">Thông tin cá nhân</a></li>
            <li><a href="EditPassWord">Đổi mật khẩu</a></li>
		</ul>
		<div>
			<div class="tab-content">
				<div class="tab-pane active" id="information">
					<form class="form-profile" action="<?= url('User/updateProfile') ?>" method="post">
						<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
						<div class="form-group">
							<label style="font-weight: bold" for="staticEmail" class="col-sm-2 col-form-label">Email đăng ký</label>
							<div class="col-sm-10">
								<input type="text" readonly class="form-control-plaintext" value="<?php echo $user['email']; ?>" name="email">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
							</div>
						</div>
						<div class="form-group">
							<label for="staticEmail" style="font-weight: bold" class="col-sm-2 col-form-label">tai khoan</label>
							<div class="col-sm-10">
								<input type="text" readonly class="form-control-plaintext" value="<?php echo $user['username']; ?>" name="username" id="username" required="required">
							</div>

						</div>
						<div class="form-group">
							<label for="staticEmail" style="font-weight: bold" class="col-sm-2 col-form-label">Ho</label>
							<div class="col-sm-10">
								<input type="text" readonly class="form-control-plaintext" value="<?php echo $user['first_name']; ?>" name="first_name" id="first_name" required="required">
							</div>
						</div>

						<div class="form-group">
							<label for="staticEmail" style="font-weight: bold" class="col-sm-2 col-form-label">Tên</label>
							<div class="col-sm-10">
								<input type="text" readonly class="form-control-plaintext" value="<?php echo $user['last_name']; ?>" name="last_name" id="last_name" required="required">
							</div>
						</div>
						<div class="form-group">
							<label style="font-weight: bold" for="staticEmail" class="col-sm-2 col-form-label">Số xu hiện tại</label>
							<div class="col-sm-10">
								<input type="text" readonly class="form-control-plaintext" value="<?php echo $user['quantity_coin']; ?>" name="quantity_coin">
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
	<script src="<?= url("resources/js/client/profileClient.js") ?>"></script>
</body>
@endsection