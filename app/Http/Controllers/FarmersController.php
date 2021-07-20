<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Farmer;
use Illuminate\Support\Facades\Hash;

class FarmersController extends Controller
{

    public function index(){
        $farmers = User::where('user_role',2)->orderBy('created_at','desc')->get();
        return view('users.farmers.index',['farmers'=>$farmers]);
    }

    public function datatable(){
        $farmers = User::where('user_role',2)->get();

        return response()->json($farmers);
    }

    public function show($id){
        return  view('users.farmers.index');
    }

    public function store(Request $request){

        $farmer = User::updateOrCreate([
            'phone_number' => $request->phone_number
        ],[
            'name' => $request->name,
            'password' => Hash::make($request->PIN),
            'address' => $request->address,
            'city' => $request->city,
            'bank_type' => $request->bank_type,
            'agriculture_category' => $request->agriculture_category,
            'user_role' =>2,
        ]);

        return  redirect()->back();
    }

    public function delete(){
        return  view('users.farmers.index');
    }

    public function edit_page(Request $request){
        $farmer = User::where('phone_number', $request->phone_number)->first();
        return response()->json(array(
            'farmer' => $farmer
        ));
    }
}
