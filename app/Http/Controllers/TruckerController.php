<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trucker;

class TruckerController extends Controller
{
    public function index(){
        return view('users.truckers.index');
    }

    public function datatable(){
        $truckers = Trucker::select('name', 'phone_number', 'PIN', 'address', 'city', 'bank_type', 'validated_id', 'validated_status')->get();


        return response()->json($truckers);
    }

    public function show($id){
        return  view('users.truckers.index');
    }

    public function store(Request $request){
        
        $trucker = Trucker::updateOrCreate([
            'phone_number' => $request->phone_number
        ],[
            'name' => $request->name,
            'PIN' => $request->PIN,
            'address' => $request->address,
            'city' => $request->city,
            'bank_type' => $request->bank_type,
            'validated_id' => $request->validated_id,
            'validated_status' => $request->validated_status,
        ]);

        return  redirect()->back();
    }

    public function delete(){
        return  view('users.truckers.index');
    }

    public function edit_page(Request $request){
        $trucker = Trucker::where('phone_number', $request->phone_number)->first();
        return response()->json(array(
            'trucker' => $trucker
        ));
    }
}
