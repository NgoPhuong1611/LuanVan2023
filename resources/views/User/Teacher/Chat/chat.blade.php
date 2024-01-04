@extends('User.Teacher.layout')
@section('content')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<style>
 ul{
    margin: 10px 20px;
 }
.card {ul
    background: #fff;
    transition: .5s;
    border: 0;
    margin-bottom: 30px;
    border-radius: .55rem;
    position: relative;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}
.chat-app .people-list {
    width: 280px;
    position: absolute;
    left: 0;
    top: 0;
    padding: 20px;
    z-index: 7
}

.chat-app .chat {
    margin-left: 280px;
    border-left: 1px solid #eaeaea
}

.people-list {
    -moz-transition: .5s;
    -o-transition: .5s;
    -webkit-transition: .5s;
    transition: .5s
}

.people-list .chat-list li {
    padding: 10px 15px;
    list-style: none;
    border-radius: 3px
}

.people-list .chat-list li:hover {
    background: #efefef;
    cursor: pointer
}

.people-list .chat-list li.active {
    background: #efefef
}

.people-list .chat-list li .name {
    font-size: 15px
}

.people-list .chat-list img {
    width: 45px;
    border-radius: 50%
}

.people-list img {
    float: left;
    border-radius: 50%
}

.people-list .about {
    float: left;
    padding-left: 8px
}

.people-list .status {
    color: #999;
    font-size: 13px
}

.chat .chat-header {
    margin: 10px 20px;
    padding: 15px 20px;
    border-bottom: 2px solid #f4f7f6
}

.chat .chat-header img {
    float: left;
    border-radius: 40px;
    width: 40px
}

.chat .chat-header .chat-about {
    float: left;
    padding-left: 10px
}

.chat .chat-history {
    padding: 20px;
    border-bottom: 2px solid #fff
}

.chat .chat-history ul {
    padding: 0
}

.chat .chat-history ul li {
    list-style: none;
    margin-bottom: 30px
}

.chat .chat-history ul li:last-child {
    margin-bottom: 0px
}

.chat .chat-history .message-data {
    margin-bottom: 15px
}

.chat .chat-history .message-data img {
    border-radius: 40px;
    width: 40px
}

.chat .chat-history .message-data-time {
    color: #434651;
    padding-left: 6px
}

.chat .chat-history .message {
    color: #444;
    padding: 18px 20px;
    line-height: 26px;
    font-size: 16px;
    border-radius: 7px;
    display: inline-block;
    position: relative
}

.chat .chat-history .message:after {
    bottom: 100%;
    left: 7%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #fff;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .my-message {
    background: #efefef
}

.chat .chat-history .my-message:after {
    bottom: 100%;
    left: 30px;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #efefef;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .other-message {
    background: #e8f1f3;
    text-align: right
}

.chat .chat-history .other-message:after {
    border-bottom-color: #e8f1f3;
    left: 93%
}

.chat .chat-message {
    padding: 20px
}

.online,
.offline,
.me {
    margin-right: 2px;
    font-size: 8px;
    vertical-align: middle
}

.online {
    color: #86c541
}

.offline {
    color: #e47297
}

.me {
    color: #1d8ecd
}

.float-right {
    float: right
}

.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0
}

@media only screen and (max-width: 767px) {
    .chat-app .people-list {
        height: 465px;
        width: 100%;
        overflow-x: auto;
        background: #fff;
        left: -400px;
        display: none
    }
    .chat-app .people-list.open {
        left: 0
    }
    .chat-app .chat {
        margin: 0
    }
    .chat-app .chat .chat-header {
        border-radius: 0.55rem 0.55rem 0 0
    }
    .chat-app .chat-history {
        height: 300px;
        overflow-x: auto
    }
}

@media only screen and (min-width: 768px) and (max-width: 992px) {
    .chat-app .chat-list {
        height: 650px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: 600px;
        overflow-x: auto
    }
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
    .chat-app .chat-list {
        height: 480px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: calc(100vh - 350px);
        overflow-x: auto
    }
}
</style>
<!-- <style>
    .people-list {
    position: fixed;
    top: 0;
    bottom: 0;
    width: 30%;
    overflow-y: auto;
    background-color: #f2f2f2;
}

.chat {
    margin-left: 31%; /* Khoảng cách giữa people-list và chat */
    overflow-y: auto; /* Cho phép chat di chuyển theo thanh cuộn */
    height: 100vh; /* Đảm bảo chat có thể cuộn đầy đủ trên màn hình */
}
</style> -->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card chat-app">
        <div class="people-list">
            <div class="input-group">
                <div class="input-group-prepend">
                    <!-- <span class="input-group-text"><i class="fa fa-search"></i></span> -->
                </div>
                <input type="text" class="form-control" placeholder="Search...">
            </div>
            <ul class="list-unstyled chat-list mt-3">
                <li class="list-header">BXH Score</li>
                @if(count($ratings) > 0)
                    @foreach($ratings as $rating)
                    <li class="clearfix">
                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar" class="rounded-circle">
                        <div class="about">
                            <div class="name">{{ $rating['username'] }}</div>
                            <div class="status">
                                <span class="online-dot"></span> Max Score: {{ $rating['max_score'] }}
                            </div>
                        </div>
                    </li>
                    @endforeach
                @else
                    <li class="text-center">No data available</li>
                @endif
            </ul>
        </div>
            <div class="chat">
                <!-- <div class="chat-header clearfix">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                            </a>
                            <div class="chat-about">
                                <h6 class="m-b-0"></h6>
                                <small>Last seen: 2 hours ago</small>
                            </div>
                        </div>
                        <div class="col-lg-6 hidden-sm text-right">
                            <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                        </div>
                    </div>
                </div> -->
                <!-- hien chat -->
                <div class="chat-history">
                    <!-- gui -->
                    <form id="messageForm">
                    <div class="chat-message clearfix">
                    <div class="input-prepend input-append">
                        <span class="add-on"><i class="icon-envelope"></i></span>
                        <input type="text" id="messageInput" class="span2" placeholder="Nhập tin nhắn của bạn">
                        <button class="btn" type="submit">Gửi</button>
                    </div>
                    </div>
                        <!-- Form để gửi tin nhắn -->
                    </form>
                  <!-- gui -->
                    <ul class="m-b-0">
                        <!-- <li class="clearfix">
                            <div class="message-data text-right">
                                <span class="message-data-time">10:10 AM, Today</span>
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                            </div>
                            <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                        </li> -->
                        <div id="messages">
                        <!-- Hiển thị các tin nhắn -->
                        <ul id="messageList">
                            @foreach($messages as $message)
                                @if(isset($usernames[$message->user_id]))
                                    <li class="clearfix">
                                        <div class="message-data">
                                                <h6 class="m-b-0">{{ $usernames[$message->user_id] }}</h6>
                                            <span class="message-data-time">{{ $message->time_date }}, {{ \Carbon\Carbon::parse($message->time_date)->format('l') }}</span>
                                        </div>
                                        <div class="message my-message"><?= $message->detail ?></div>
                                    </li>
                                 @elseif(isset($ad_usernames[$message->admin_id]))
                                    <li class="clearfix"style="background-color: #CCCCFF; border-radius: 10px;padding-left: 10px">
                                            <div class="message-data">
                                                    <h6  class="m-b-0">Admin - <?=  $ad_usernames[$message->admin_id]?>:  <?=$message->title ?></h6>
                                                <span class="message-data-time">{{ $message->time_date }}, {{ \Carbon\Carbon::parse($message->time_date)->format('l') }}</span>
                                            </div>
                                            <div class="message my-message"><?= $message->detail ?></div>
                                    </li>
                                 @endif

                            @endforeach
                        </ul>
                    </ul>
                </div>
                <!-- hien chat-->


            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        encrypted: true
    });

    var channel = pusher.subscribe('chat-channel');

    channel.bind('new-message', function(data) {
    var messagesList = document.getElementById('messageList');
    var newMessage = document.createElement('li');
    newMessage.innerHTML = `
        <div class="message-data">
            <h6 class="m-b-0">${data.username}</h6>
            <span class="message-data-time">${moment(data.message.time_date).format('YYYY-MM-DD HH:mm:ss')}, ${moment(data.message.time_date).format('dddd')}</span>
        </div>
        <div class="message my-message">${data.message.detail}</div>
    `;

    // Chèn tin nhắn mới vào đầu danh sách
    if (messagesList.firstChild) {
        messagesList.insertBefore(newMessage, messagesList.firstChild);
    } else {
        messagesList.appendChild(newMessage);
    }
    });

    $('#messageForm').submit(function(e) {
        e.preventDefault();
        var messageInput = $('#messageInput').val();

        $.post('/send-message', { content: messageInput, _token: '{{ csrf_token() }}' })
            .done(function(data) {
                console.log(data);
                $('#messageInput').val('');
            })
            .fail(function(error) {
                console.error('Lỗi:', error);
            });
    });
</script>
@endsection
