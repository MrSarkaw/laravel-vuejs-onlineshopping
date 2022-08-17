<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {

        $transactions = Transaction::with('user')->latest()->paginate(20);

       if(request()->wantsJson()){
            return response()->json([
                'data'=>$transactions
            ]);
        }
        return view('admin.transaction.index', compact('transactions'));

    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'state' => !$transaction->state
        ]);

        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'بەسەرکەوتوی تازەکرایەوە'
            ]);
        }

        return redirect()->back();
    }


    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();

        if(request()->wantsJson()){
            return response()->json([
                'msg'=>'بەسەرکەوتوی سڕایەوە'
            ]);
        }
        return redirect()->back();
    }
}
