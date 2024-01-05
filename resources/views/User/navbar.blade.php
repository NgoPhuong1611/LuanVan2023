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
                <li><a  href="{{ url('/') }}">Trang chủ</a></li>
                <li><a href="{{ url('/blog') }}">Blog</a></li>

                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Luyện Tập <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <li><a href="{{ url('/Practice/PracticeListen') }}">Luyện bài nghe</a></li>
                        <li><a href="{{ url('/Practice/PracticeRead') }}">Luyện bài đọc</a></li>
                        <li><a href="{{ url('/Practice/PracticeSpeaking') }}">Luyện Speaking</a></li>
                        <li><a href="{{ url('/Practice/PracticeWriting') }}">Luyện Writing</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Làm Bài Thi<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/listExam/listtoeic') }}">Bài Thi Toeic</a></li>
                            <li><a href="{{ url('/listExam/examrandom') }}">Bài Thi Ngẫu Nhiên</a></li>
                        </ul>
                    </li>
                    <li><a  href="{{ url('/chat') }}">Diễn Đàn</a></li>

                    <li class="dropdown">
                    @php
                        $session = session()->all();
                    @endphp
                        <?php if (isset($session['username']) && !empty($session['username'])) : ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $session['username'] ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{ url('/User/Infor') }}">Tài khoản</a></li>
                            <li><a href="{{ url('/User/ExamHistory') }}">Lịch sử </a></li>
                            <li><a href="{{ url('/transaction') }}">Nạp Xu</a></li>
                            <li><a href="{{ url('/User/Logout') }}">Thoát</a></li>
                            </ul>
                        <?php else : ?>
                            <a href="{{ url('/User/Login') }}">Đăng nhập</a>
                        <?php endif ?>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
