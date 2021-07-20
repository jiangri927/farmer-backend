<?php

namespace App\Http\Controllers;

use App\Products;
use App\User;
use Illuminate\Http\Request;
use App\Goods;
use App\Farmer;
use App\SBP;

class GoodsController extends Controller
{
    public function index(){
        $goodslist = Products::orderBy('created_at','desc')->get();
        return view('goods.goods.index',['goodslist'=>$goodslist]);
    }

    public function datatable(){
//
        $goods = Products::get();
        foreach ($goods as $good){
            $good['farmer_name'] = User::find($good->user_id)->name;
            $good['phone_number'] = User::find($good->user_id)->phone_number;
        }
        return response()->json($goods);
    }

    public function show($id){
        return  view('users.farmers.index');
    }

    public function store(Request $request){

        $input = $request->all();

        $goods = Products::updateOrCreate(['id'=>$request->product_id],
            [
                'sbp'=>$request->sbp,
                'sp'=>$request->sp,
                'atp'=>$request->atp,
                'category'=>$request->category,
                'ani'=>$request->ani,
            ]
            );

        return  redirect()->back();
    }

    public function delete(){
        return  view('users.farmers.index');
    }

    public function edit_page(Request $request){
//        dd($request->product_id);
        $product = Products::find($request->product_id);
        return response()->json(array(
            'product' => $product
        ));
    }
}
