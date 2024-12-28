<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\User;
use App\models\Message;
use App\models\Conversation;
use App\Events\MessageSent;

class AdminController extends Controller
{
    public function users(){
        $data['user_list']=User::where('id','!=',Auth()->user()->id)->get();
        return view('users',$data);
    }
    public function addUser()
    {
        return view('addUser');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=>'required',
            'confirm' => 'required|confirmed:password',
            'role'=>'required'
        ]);
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$request->password,
            "role"=>$request->role,
        ]);

        return view('addUser')->with('success','User Added Successfully');
    }
    public function edit(Request $request,$id)
    {
        $data['user']=User::find($id);
        return view('editUser',$data);
    }
    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            // 'password'=>'required',
            // 'confirm' => 'required|confirmed:password',
            'role'=>'required'
        ]);
        User::where('id',$id)->update([
            "name"=>$request->name,
            "email"=>$request->email,
            // "password"=>$request->password,
            "role"=>$request->role,
        ]);
        $data['user']=User::find($id);
        return redirect()->back()->with('success', 'User updated successfully');
    }
    public function delete($id)
    {
            User::where('id',$id)->delete();
            return redirect('/users');
    }
    public function dashboard(){
        $data['user_list']=User::where('id','!=',Auth()->user()->id)->get();
        return view('dashboard',$data);
    }
    public function chatbox($id){
        $data['user_to']=User::where('id',$id)->first();
        $conversation = Conversation::where('channel',$id.'_'.Auth()->user()->id)->orWhere('channel',Auth()->user()->id.'_'.$id)->first();
       
        if(!$conversation){
           $conversation = Conversation::create([
                'channel'=>$id.'_'.Auth()->user()->id
            ]);
        }
        
        $data['channel']=$conversation->channel;
        $data['messages']=Message::where('conversation_id',$conversation->id)->get();
        return view('chatbox',$data);
    }
    public function send(Request $request){
        
        $conversation = Conversation::where('channel',$request->channel)->first();
       
        Message::create([
            'conversation_id'=>$conversation->id,
            'message_from'=> $request->sender,
            'message_to'=>$request->send_to,
            'message'=>$request->message,
        ]);
        MessageSent::dispatch($request->sender,$request->message,$request->send_to);
        return $request->all();
    }
}
