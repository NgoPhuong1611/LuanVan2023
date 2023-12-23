<!DOCTYPE html>
<html>
<head>
    <title>Real-time Chat</title>
    <!-- Include Pusher -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<body>
    <div id="app">
        <div id="messages">
            <!-- Hiển thị các tin nhắn -->
            <ul id="messageList">
                @foreach($messages as $message)
                    <li>{{ $message->content }}</li>
                @endforeach
            </ul>
        </div>
        <form id="messageForm">
            <!-- Form để gửi tin nhắn -->
            <input type="text" id="messageInput" placeholder="Nhập tin nhắn của bạn">
            <button type="submit">Gửi</button>
        </form>
    </div>
    <script>
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true
        });

        var channel = pusher.subscribe('chat-channel');

        channel.bind('new-message', function(data) {
            // Xử lý khi có tin nhắn mới
            var messagesList = document.getElementById('messageList');
            var newMessage = document.createElement('li');
            newMessage.textContent = data.message.content;
            messagesList.appendChild(newMessage);
        });

        // Gửi tin nhắn mới qua Ajax
        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var messageInput = document.getElementById('messageInput').value;
            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ content: messageInput })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                document.getElementById('messageInput').value = ''; // Xóa nội dung input sau khi gửi
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
