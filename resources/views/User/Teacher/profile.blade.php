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
					</form>
				</div>
			</div>
			<div class="container">
				<!-- Bảng nhiệm vụ của giảng viên -->
				<section id="tasks">
					<h2>Bảng nhiệm vụ</h2>
					<table border="2">
				<thead>
					<tr>
						<th>Tên người học</th>
						<th>Title</th>
						<th>Quantity Coin</th>
						<th>Type</th>
						<th>Point</th>
						<th>Time/Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Người học A</td>
						<td>Task 1</td>
						<td>10</td>
						<td>Type A</td>
						<td>50</td>
						<td>2023-11-27</td>
						<td>
							<button  class="btn btn-success" onclick="startTask(1)">Bắt đầu</button>
							<button class="btn btn-danger" onclick="cancelTask(1)">Hủy</button>
						</td>
					</tr>
					<!-- Add more rows for other tasks -->
				</tbody>
			</table>
		
				</section>
		
				<!-- Lịch sử giao dịch của giảng viên -->
				<section id="transaction-history">
					<h2>Lịch sử giao dịch</h2>
					<table border="2">
				<thead>
					<tr>
						<th>Title</th>
						<th>Quantity Coin</th>
						<th>Type</th>
						<th>Point</th>
						<th>Time/Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Task 1</td>
						<td>10</td>
						<td>Type A</td>
						<td>50</td>
						<td>2023-11-27</td>
						<td>
							<button  class="btn btn-success" onclick="startTask(1)">Bắt đầu</button>
							<button class="btn btn-danger" onclick="cancelTask(1)">Hủy</button>
						</td>
					</tr>
					<!-- Add more rows for other tasks -->
				</tbody>
			</table>
				</section>
			</div>
		</div>
	</div>
	<script src="<?= url("resources/js/client/profileClient.js") ?>"></script>
</body>
@endsection