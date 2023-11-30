

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

    <!-- MENU SECTION -->
    <div class="menu">
        <ul>
            <li><a href="#lecturer-info">Giới thiệu giảng viên</a></li>
            <li><a href="#tasks">Bảng nhiệm vụ</a></li>
            <li><a href="#transaction-history">Lịch sử giao dịch</a></li>
        </ul>
    </div>

    <!-- CONTENT SECTION -->
    <div class="container">
        <!-- Giới thiệu giảng viên -->
        <section id="lecturer-info">
            <h2>Thông tin giảng viên</h2>
            <div>
                <!-- Thông tin giảng viên cụ thể -->
                <h3>Tên giảng viên: John Doe</h3>
                <p>Email: johndoe@example.com</p>
                <p>Kinh nghiệm: Tôi là một giảng viên có kinh nghiệm trong lĩnh vực XYZ với hơn 10 năm trong ngành.</p>
            </div>
        </section>
    </div>
@endsection
