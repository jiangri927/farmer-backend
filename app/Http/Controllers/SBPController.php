<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SBP;

class SBPController extends Controller
{
    public function index(){
        return view('goods.SBP.index');
    }

    public function datatable(){
        $traders = SBP::all();


        return response()->json($traders);
    }

    public function show($id){
        return  view('goods.SBP.index');
    }

    public function store(Request $request){
        
        $trader = SBP::updateOrCreate([
            'ani' => $request->ani
        ],[
            'category' => $request->category,
            'price' => $request->price,
        ]);

        return  redirect()->back();
    }

    public function delete(){
        return  view('goods.SBP.index');
    }

    public function edit_page(Request $request){
        $sbp = SBP::where('ani', $request->ani)->first();
        return response()->json(array(
            'sbp' => $sbp
        ));
    }
}
