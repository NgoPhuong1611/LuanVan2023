<?php
namespace App\Http\Controllers;
use App\Events\MyEvent;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Models\TeaForumcher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Event;

class ToForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User.Forum.index');

    }

    public function sendMessage(Request $request)
   {
    $ch = curl_init();
$caPath = 'C:\\cacert.pem'; // Đường dẫn đến file cacert.pem

curl_setopt($ch, CURLOPT_URL, 'https://api-ap1.pusher.com/apps/1718245/events'); // Đường dẫn API của Pusher

// Thiết lập tùy chọn CURLOPT_CAINFO để chỉ định đường dẫn đến file CA certificate
curl_setopt($ch, CURLOPT_CAINFO, $caPath);

// Thiết lập các tùy chọn cURL khác nếu cần thiết
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

// Thực hiện yêu cầu cURL
$response = curl_exec($ch);

// Kiểm tra và xử lý response
if ($response === false) {
    $error = curl_error($ch);
    // Xử lý lỗi nếu cần
} else {
    // Xử lý response nếu cần
}

// Đóng cURL handle
curl_close($ch);
       try {
           $message = $request->input('message');
           // Validate and process the message as needed

           event(new MyEvent($message));

           return response()->json(['status' => 'Message sent']);
       } catch (\Exception $e) {
           // Đăng nhập ngoại lệ
           \Log::error('Exception in sendMessage: ' . $e->getMessage());
           // Trả về phản hồi lỗi
           return response()->json(['error' => 'Internal Server Error'], 500);
       }
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
