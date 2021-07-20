<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProductController extends Controller
{
    //
    public $successStatus = 200;
    function index(){
        $products = Products::orderBy('created_at','desc')->get();
        return response()->json([
            'state' =>'success',
            'products' =>$products,
        ]);
    }
    function store(Request $request){
        $validator = Validator::make($request->all(), [
            'ani' => 'required|string',
            'sbp' => 'required|numeric',
            'sp' => 'required|numeric|',
            'atp' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $product = Products::create($input);

        return response()->json([
           'status' =>'success',
           'product' =>$product,
        ]);
    }

    function delete(Request $request){
        Products::find($request->product_id)->delete();
        return response()->json(['status'=>'success']);
    }
    function delete_all(Request $request){
        $user = Auth::user();
        Products::where('user_id',$user->id)->delete();
        return response()->json(['status'=>'success']);
    }

    function update(Request $request){
        $user = Auth::user()->id;
        $product = Products::find($request->id);
        $input = $request->all();
        $product->update($input);
        return response()->json([
            'state'=>'sccess',
            'product'=>$product,
        ]);
    }


}
