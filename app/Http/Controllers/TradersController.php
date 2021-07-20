<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Trader;
use Illuminate\Support\Facades\Hash;

class TradersController extends Controller
{
    public function index(){
        return view('users.traders.index');
    }

    public function datatable(){
        $traders = User::where('user_role',3)->get();
        return response()->json($traders);
    }

    public function show($id){
        return  view('users.traders.index');
    }

    public function store(Request $request){
        
        $trader = User::updateOrCreate([
            'phone_number' => $request->phone_number
        ],[
            'name' => $request->name,
            'password' => Hash::make($request->PIN),
            'address' => $request->address,
            'city' => $request->city,
            'bank_type' => $request->bank_type,
            'validated_id' => $request->validated_id,
            'validated_status' => $request->validated_status,
            'user_role' => 3,
        ]);

        return  redirect()->back();
    }

    public function delete(){
        return  view('users.traders.index');
    }

    public function edit_page(Request $request){
        $trader = User::where('phone_number', $request->phone_number)->first();
        return response()->json(array(
            'trader' => $trader
        ));
    }
}
