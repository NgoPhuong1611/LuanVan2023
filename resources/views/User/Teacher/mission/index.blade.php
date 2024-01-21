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

        <!-- Bảng nhiệm vụ của giảng viên -->
        <section id="tasks">
            <h2>Bảng nhiệm vụ</h2>
            <table>
        <thead>
            <tr>
                <th>Loại Bài Làm</th>
                <th>Phần Bài Làm</th>
                <th>Số Xu Nhận Được</th>
                <th>Time/Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($missions as $mission)
            <tr>
                @if($mission->type=='0')
                {<td>SPEAKING</td>}
                @else{<td>WRITING</td>}
                @endif
                @if($mission->part_number=='8')
                {<td>Read Aloud</td>}
                @elseif($mission->part_number=='9')
                {<td>Describe a Picture</td>}
                @elseif($mission->part_number=='10')
                {<td>Respond to Questions</td>}
                @elseif($mission->part_number=='11')
                {<td>Respond to questions using information provided</td>}
                @elseif($mission->part_number=='12')
                {<td>Express an opinion</td>}
                @elseif($mission->part_number=='13')
                {<td> Write a sentence based on a picture</td>}
                @elseif($mission->part_number=='14')
                {<td>Respond to a written request</td>}
                @elseif($mission->part_number=='15')
                {<td>Write an opinion essay</td>}
                @endif
                <td>0</td>
                <td>{{$mission->time_date}}</td>    
                <td>
                    <button type="submit" class="btn btn-default check_out">
                        <a href="{{ url("Teacher/showDetail", ['id' => $mission->id]) }}">Bắt Đầu </a>
                    </button>
                </td>                                    
            </tr>
        @endforeach
            <!-- Add more rows for other tasks -->
        </tbody>
    </table>

    </section>
    </div>



@endsection


