<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        return response()->json([
            'success' => true,
            'data' => [
                'products' => Product::with('category')->get(),
                'categories' => Category::all()
            ]
        ]);
    }



    public function store(){
        $input = Input::all();
        $rules = [
            'category_id' => 'required|integer|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|between:0,999999,9999'
        ];
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors'    => $validator->errors()->all()
            ]);
        }

        $product = new Product();
        $product->category_id = $input['category_id'];
        $product->product_name = $input['product_name'];
        $product->product_price = $input['product_price'];
        $product->save();

        return response()->json([
            'success' => true,
            'data'    => Product::with('category')->find($product->id)
        ]);
    }

    public function show($id){
        return response()->json([
            'success' => true,
            'data'    => Product::findOrFail($id)
        ]);
    }


    public function update($id){


        $input = Input::all();
        $rules = [
            'category_id' => 'required|integer|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|between:0,999999,9999'
        ];
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors'    => $validator->errors()->all()
            ]);
        }

        $product = Product::findOrFail($input['id']);
        $product->category_id = $input['category_id'];
        $product->product_name = $input['product_name'];
        $product->product_price = $input['product_price'];
        $product->save();
        return response()->json([
            'success' => true
        ]);

    }

    public function delete($id){
        Product::findOrFail($id)->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function test(){
        
    }
}
