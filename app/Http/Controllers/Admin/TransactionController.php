<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestTransaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all(); // Lấy tất cả các giao dịch từ bảng transaction

        return view('admin.Transaction.index', ['transactions' => $transactions]);
    }
    public function showDetail($id)
    {
        // $rt_id = RequestTransaction::find(session()->get('id'))->id; 
        $rt = RequestTransaction::findOrFail($id);
        // dd($rt->id);
        // Lấy giá trị hiện tại của quantity_coin từ người dùng đã tìm thấy
        $transaction = [
            'id' => $rt->id,
            'bank_account' => $rt->bank_account,
            'bank_name' => $rt->bank_name,
            'account_name' => $rt->account_name,
            'so_tien' => $rt->mn_withdraw,
            'quantity_coin' => $rt->quantity_coin,
            // Thêm các thuộc tính khác nếu cần
        ];
        // Truyền dữ liệu chi tiết giao dịch vào view
        return view('admin.Transaction.detail', ['transaction' => $transaction]);
    }
    public function updateTransaction(Request $request)
    {
        // Lấy dữ liệu từ request
        $id = $request->input('id');
        // dd($request->all());
        if($request->input('status')==='1'){
        $data = [  
            'status'=> 'Đã Xử Lý' ,  
        ];
        RequestTransaction::where('id',$id)->update($data);
        Transaction::where('requestTran_id', $id)->update($data);
        }
        // Chuyển hướng sang view 'index'
        $transactions = Transaction::all(); // Lấy tất cả các giao dịch từ bảng transaction
        return view('admin.Transaction.index', ['transactions' => $transactions]);
    }
}
