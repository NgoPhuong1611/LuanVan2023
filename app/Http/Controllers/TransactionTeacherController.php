<?php

namespace App\Http\Controllers;

use App\Models\RequestTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionTeacherController extends Controller
{
    public function index(Request $request)
    {
        // return view('user.Transaction.index');
        $redirect = $request->input('redirect');
        $so_tien = $request->input('so_tien');
        // $selectedMethod = $request->input('transactionType');
        return view('user.Teacher.Transaction.index',  compact('so_tien','redirect'));
    }
    public function transactionHistory()
    {
        $user_id = User::find(session()->get('id'))->id; // Lấy ID của người dùng đã đăng nhập
        $transactions = Transaction::where('user_id', $user_id)->get();
        return view('user.Teacher.Transaction.History', ['transactions' => $transactions]);
    }
    public function showTransactionForm(Request $request)
    {
        $so_tien = $request->so_tien;
        $redirect =$request->redirect;
        // dd($request->all());
        // dd($request->so_tien);
        // Truyền giá trị giá quy đổi vào view và hiển thị giao diện nhập thông tin
        return view('user.Teacher.Transaction.createRequest', compact('so_tien','redirect'));
    }
    

    public function createRequest(Request $request)
    {  
        $so_tien = $request->input('so_tien');
        $redirect = $request->input('redirect');
        $user_id = User::find(session()->get('id'))->id; 
        $user = User::findOrFail($user_id);
        // Lấy giá trị hiện tại của quantity_coin từ người dùng đã tìm thấy
         $currentQuantityCoin = $user->quantity_coin;
        //  dd($currentQuantityCoin,$redirect);
        if($currentQuantityCoin < $redirect)
        {
            return redirect()->back()->with('errors', 'Không đủ xu để thực hiện giao dịch.');
        }      
         $newQuantityCoin = $currentQuantityCoin-$redirect;
         $data = [
            
             'quantity_coin'=>  $newQuantityCoin,  
         ];
         User::where('id', $user_id)->update($data);
        // dd($request->all());
        //Lưu yêu cầu rút tiền vào database
        $requestTransaction =  RequestTransaction::create([
            'user_id' => $user->id,
            'mn_withdraw' => $so_tien,
            'status' => 'đang xử lý',
            'bank_account' => $request->input('account_number'),
            'method' => 'chuyển khoản', // Giá trị cứng cho chuyển khoản
            'account_name' => $request->input('account_name'),
            'quantity_coin' => $redirect,
            'bank_name' => $request->input('bank_name'),
        ]);
        // Tạo bản ghi mới trong bảng Transaction  
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'requestTran_id'=>$requestTransaction->id,
            'title' => 'Rút Xu',
            'type' => 1,
            'quantity_coin' => $redirect,
            'status' => 'đang xử lý',
        ]);
        $transactions = Transaction::where('user_id', $user_id)->get();
        return view('user.Teacher.Transaction.History', ['transactions' => $transactions]);
        
    }


}
