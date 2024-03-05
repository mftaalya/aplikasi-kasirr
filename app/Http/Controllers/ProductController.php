<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        $kategoris = Kategori::all();
        return view('product.index',[
            'products'=> $products,
            'kategoris'=> $kategoris
        ]);
    }

    public function store(Request $request){
        // $request->validate([
        //     'name'=>'required',
        //     'price'=>'required|int',
        //     'kategori_id' => 'required'
        // ]);

        $products = new Product();
        $products->name = $request->name;
        $products->kategori_id = $request->kategori_id;
        $products->price = $request->price;

        $products->save();

        return redirect()->route('product.index');
    }

    public function edit(Product $product){

        $kategori = Kategori::all();
        return view('product.edit',[
            'product' => $product,
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, Product $product){

        $request->validate([
            'name'=> 'required',
            'price'=>'required|int',
            'kategori_id' => 'required'
        ]);

        $product->update($request->all());

        return redirect()->route('product.index')->with('success', 'Product updated success!');
    }

    public function destroy(Product $product){
        $product->delete();

        return redirect()->route('product.index');
    }
}
