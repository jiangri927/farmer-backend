<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use App\User;
use App\Producta;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function __construct()
    {
//        $this->middleware('admin');
    }
    public function home(Request $request){
        return view('admin.admin');
    }

    public function admin_detail(){
//        dd(123);

        $users = User::where('user_role',2)->get();
        $users_html = view('admin.users',['users'=>$users])->render();
//        $accounts = UserAccount::get();
//        $accounts_html = view('admin.accounts',['accounts'=>$accounts])->render();
//        $bids = Bid::get();
//        $bidding_html = view('admin.bidding',['bids'=>$bids])->render();
//        $messages = Message::get();
//        $message_html = view('admin.messages',['users'=>$users])->render();
        $products = Products::get();
        $product_html = view('admin.products',['products'=>$products])->render();
//        $reviews = Feedback::get();
//        $review_html = view('admin.review',['reviews'=>$reviews])->render();
//        $category = Category::get();
//        $category_html = view('admin.category',['category'=>$category])->render();
//        $city = City::get();
//        $city_html = view('admin.city',['city'=>$city])->render();
        return response()->json([
            'status'=>true,
            'users_html'=>$users_html,
//            'accounts_html'=>$accounts_html,
//            'bidding_html'=>$bidding_html,
//            'message_html'=>$message_html,
            'product_html'=>$product_html,
//            'review_html'=>$review_html,
//            'category_html'=>$category_html,
//            'city_html'=>$city_html,

        ]);
    }

    public  function user_edit(Request $request){
        $user = User::find($request->id);
        return view('admin.user_edit',['user'=>$user]);
    }

    public function user_store(Request $request){
//        dd($request);
        $user = User::find($request->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->verify_status = $request->verify_status;
        $user->rating = $request->rating;
        $user->transaction_count = $request->transaction_count;
//        if ($request->membership!=0)
//        $user->bid_count = Membership::where('id',$request->membership)->first()->bid_limit;
        $user->bid_count = $request->bid_count;

        $user->user_role = $request->role;
        $user->membership = $request->membership;
        $user->membership_type = 1;
        $user->save();

        return redirect('admin');

    }

    public  function user_delete(Request $request){

        Product::where('user_id',$request->id)->delete();

        Bid::where('buyer_id',$request->id)->orWhere('seller_id',$request->id)->delete();
        Favorite::where('user_id',$request->id)->delete();
        Feedback::where('to_user',$request->id)->delete();
        Message::where('from_user',$request->id)->orWhere('to_user',$request->id)->delete();
        User::where('id',$request->id)->first()->delete();

        return redirect()->back();

    }

    public function user_valid_id(Request $request){
        $user = User::find($request->id);
        if ($request->accept ==1){
            $user->update(['valid_id_status'=>1]);
        }
        else{
            $user->update(['valid_id_status'=>2,'valid_id'=>null]);
        }
        return redirect('admin');

    }

    public function verify_email(Request $request){
        $user = User::where('id',$request->id)->first();
        $user->email_verified_at = now();
        $user->verify_status = $user->verify_status + 5;
        $user->save();
        return redirect()->back();
    }

    public function create_user(){
        return view('admin.create_user');
    }

    public function store_newuser(Request $request){
        $user =  User::create([

            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'avatar' => "default.png",
            'user_role'=> $request['role'],
            'verify_status'=>5,
            'membership' => $request['membership'],
            'membership_type' => 1,

            'bid_count'=>Membership::where('id',$request->membership)->first()->bid_limit,

        ]);


        return redirect('admin');
    }

    public function moderator($user , $type){

        $moderator = new Moderator();
        $moderator->user_id = $user;
        $moderator->type = $type;
        $moderator->save();

        $user = User::find($user);
        $user->user_role = 2;
        $user ->save();
        return redirect('admin');
    }
    public function delete_illegal($id){
        Product::find($id)->delete();
        return redirect('admin');
    }

}
