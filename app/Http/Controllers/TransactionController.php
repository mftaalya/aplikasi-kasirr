<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Response;
class TransactionController extends Controller
{
    //
    public function index(){
        $transactions = Transaction::all();
        $products = Product::all();
        return view('transaction.index',[
            'transactions' => $transactions,
            'products' => $products
        ]);
    }

    public function store(Request $request){        

        $transactions = Transaction::create([
            'total_price' => $request->total_payment,
            'pay' => $request->payment,
            'change' => $request->change,
        ]);
        $transactions->product()->attach($request->product_id);
        return redirect()->back();
    }

    public function listProduct(Request $request){
        $product_id = $request->get('id');
        
        $selected_product = Product::find($product_id);
        
        return response()->json([$selected_product]);
    }
}
