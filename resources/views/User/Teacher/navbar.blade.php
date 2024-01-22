<style>
    a{
        display: block;
    }
</style>
<div class="span9">
    <div class="navbar pull-right">
        <div class="navbar-inner">
        <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
        <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                
                <li><a href="{{ url('Teacher/mission') }}">Nhiệm vụ</a></li>
                <li><a href="{{ url('/blogTeacher') }}">Blog</a></li>
                <li><a  href="{{ url('/chatTeacher') }}">Diễn Đàn</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Quản Lý Giao Dịch<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('Teacher/transactionHistory') }}">Lịch sử giao dịch</a></li>
                        <li><a href="{{ url('Teacher/coin') }}">Rút Xu</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    @php
                        $session = session()->all();
                    @endphp
                        <?php if (isset($session['username']) && !empty($session['username'])) : ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $session['username'] ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{ url('Teacher/Infor') }}">Thông tin giảng viên</a></li>
                            <li><a href="{{ url('Teacher/terms') }}">Điều khoản áp dụng</a></li>
                            <li><a href="{{ url('User/Logout') }}">Thoát</a></li>
                            </ul>
                        <?php else : ?>
                            <a href="{{ url('User/Login') }}">Đăng nhập</a>
                        <?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
