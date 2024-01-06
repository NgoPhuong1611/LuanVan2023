<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TransactionUserController extends Controller
{
    public function index()
    {
        return view('user.Transaction.index');
    }


    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request)
    {
      

        $endpoint = env('MOMO_ENDPONT');

        //mã momo cung cấp
        $partnerCode = env('PARTNER_CODE');
        $accessKey = env('ACCESS_KEY');
        $secretKey =env('SECRET_KEY') ;
        // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "SML";
        $requestId = time()."";
        $requestType = "payWithMoMoATM";
  
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $_POST['total_momo'];
        // $amount = '10000';
        $orderId = time() ."";
        $redirectUrl = "http://127.0.0.1:8000/transaction";
        $ipnUrl = "http://127.0.0.1:8000/transaction";
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        // dd($signature);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        // dd($result);
        $jsonResult = json_decode($result, true);  // decode json
        // print_r($jsonResult);
        //Just a example, please check more in there
        // return redirect()->to( $jsonResult['payUrl']);
            $user_id = User::find(session()->get('id'))->id; 
            $transactionAmount = $_POST['redirect']; 
            $user = User::findOrFail($user_id);
           // Lấy giá trị hiện tại của quantity_coin từ người dùng đã tìm thấy
            $currentQuantityCoin = $user->quantity_coin;
            // Tiến hành cộng thêm giá trị $transactionAmount
            $newQuantityCoin = $currentQuantityCoin + $transactionAmount;
            $data = [
                'quantity_coin'=>  $newQuantityCoin,  
            ];
            User::where('id', $user_id)->update($data);
            // Redirect hoặc thông báo thành công khi cộng số xu thành công
            return redirect()->to($jsonResult['payUrl']); 
    }

}
