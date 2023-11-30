@extends('User.Teacher.layout')

@section('content')

    <style>
        /* CSS styles for the table, buttons, etc. */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>

    <div class="container">
        <h2>Điều Khoản Sử Dụng và Nghiệp Vụ cho Người Dạy</h2>
        <p>
            Đây là những quy định và chức năng dành cho người dạy sử dụng nền tảng của chúng ta:
        </p>

        <h3>Người Dạy</h3>
        <p>
            Người dạy là những cá nhân có kiến thức sâu về tiếng Anh và TOEIC, tìm đến để chia sẻ kiến thức và kiếm thu nhập từ khả năng của mình. Họ cần qua các bước kiểm tra trình độ và kiến thức để trở thành người dạy trên nền tảng.
        </p>

        <h3>Đăng Ký</h3>
        <p>
            Để đăng ký tài khoản người dạy, người dùng cần xác nhận trình độ của mình và điền thông tin cá nhân cần thiết. Sau khi hoàn thành, hệ thống sẽ xem xét và chấp nhận tài khoản. Sau đó, người dạy có thể tạo và quản lý khóa học để chia sẻ kiến thức với người học.
        </p>

        <h3>Quản Lý Tài Khoản</h3>
        <p>
            Để đảm bảo tính chuyên nghiệp, người dạy chỉ được xem và chỉnh sửa thông tin cá nhân của mình. Họ có thể xem tổng đánh giá và hiển thị đánh giá từ người học.
        </p>

        <h3>Quản Lý Xu</h3>
        <p>
            Người dạy có thể xem số xu hiện tại và quy đổi xu thành tiền mặt. Họ có thể chọn phương thức thanh toán và yêu cầu rút tiền, sau đó hệ thống sẽ xử lý giao dịch.
        </p>

        <h3>Xem Xếp Hạng</h3>
        <p>
            Ngoài bảng xếp hạng của người học, người dạy có bảng xếp hạng riêng để so sánh số xu kiếm được trên nền tảng.
        </p>

        <h3>Quản Lý Nhiệm Vụ</h3>
        <p>
            Người dạy có thể nhận, hoàn thành nhiệm vụ và nhận xu tương ứng. Họ cần tuân thủ thời hạn và yêu cầu, ngược lại có thể bị hình phạt.
        </p>
         <!-- Các điều khoản mới -->
         <h3>Điều Khoản Chi Tiết</h3>
        <ol>
            <li><strong>Tài khoản:</strong> Người dùng cần đăng ký tài khoản cá nhân và không chia sẻ thông tin này cho người khác.</li>
            <li><strong>Bảo mật thông tin:</strong> Cam kết bảo mật thông tin cá nhân và ngăn chặn truy cập trái phép vào dữ liệu.</li>
            <li><strong>Nội dung:</strong> Yêu cầu tuân thủ các nguyên tắc đạo đức khi chia sẻ nội dung trên ứng dụng.</li>
            <li><strong>Sử dụng dịch vụ:</strong> Vui lòng tuân thủ các hướng dẫn và quy định khi sử dụng các tính năng của ứng dụng.</li>
            <li><strong>Trách nhiệm:</strong> Người dùng chịu trách nhiệm đối với hành động từ tài khoản cá nhân.</li>
            <li><strong>Thanh toán:</strong> (Nếu có) Xác định rõ các điều khoản thanh toán và chính sách liên quan.</li>
            <li><strong>Thay đổi điều khoản:</strong> Có thể điều chỉnh, thay đổi điều khoản mà không cần thông báo trước.</li>
        </ol>
    </div>
@endsection
