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


    <!--HEADER ROW-->

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
            <h2>Giới thiệu giảng viên</h2>
            <div>
                <!-- Thông tin giảng viên -->
                <h3>Tên giảng viên</h3>
                <p>Giới thiệu về giảng viên và kinh nghiệm của họ.</p>
            </div>
        </section>

        <!-- Bảng nhiệm vụ của giảng viên -->
        <section id="tasks">
            <h2>Bảng nhiệm vụ</h2>
            <table>
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
            <table>
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
@endsection


