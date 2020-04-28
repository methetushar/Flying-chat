<?php

namespace App\Http\Controllers;

use App\Model\Message;
use App\Model\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Chat__Layout.Chat__UI_2');
    }

    public function create()
    {
        return view('Chat__Layout.Chat__UI_2');
    }
    public function store(Request $request)
    {
        $data=[
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' =>$request->password,
        ];
        Register::create($data);
        Session::put('authenticated',$request->email);
        $session =  session()->get('authenticated');
        if ($session){
            Register::where('email',$session)->update(['is_active'=>1]);
        }
        return  response()->json('Stored', 200);
    }

    public function login(Request $request)
    {
        $match_data = Register::where('email',$request->email)->where('password',$request->password)->first();
        if ($match_data){
            Session::put('authenticated',$request->email);
            $session =  session()->get('authenticated');
            if ($session){
                Register::where('email',$session)->update(['is_active'=>1]);
            }
            return  response()->json('logged_in', 200);
        }else{
            return  response()->json('Not_match', 401);
        }

    }

    public function User()
    {
        $session =  session()->get('authenticated');
        $userList = Register::where('email','!=',$session)->get();
        return response($userList);
    }

    public function ViewMessage($friend_id)
    {
        $session =  session()->get('authenticated');
        $UserData =  Register::where('email',$session)->first();
        $my_id = $UserData->id;

        $message = Message::where(function ($query) use ($friend_id,$my_id){
            $query->where('from',$my_id)->where('to',$friend_id);
        })->orWhere(function ($query) use ($friend_id,$my_id){
            $query->where('from',$friend_id)->where('to',$my_id);
        })->get();
       $viewData =  Register::find($friend_id);
       $data = [$viewData,$message];
        return response()->json($data);
    }
}
