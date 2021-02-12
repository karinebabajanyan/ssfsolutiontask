<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//+
    {
        $auth = Auth::user();
        return view('users.index',['auth'=>$auth]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store($id)//+
    {
        $user = User::find($id);
        $auth=Auth::user();
        $authid = $auth->id;
        $existssender=Auth::user()->sender()->where('receiver_id', $id)->first();
        $existsreceiver=Auth::user()->receiver()->where('sender_id', $id)->first();
        if($existssender===null && $existsreceiver===null){
            $auth->addFriend($user,$authid);
        }else{
            $getdeletessender=$auth->getDeletesSender()->where('receiver_id',$id);
            if($getdeletessender){
                $getdeletessender->update(['status' => 'pending']);
            }
            $getdeletesreceiver=$auth->getDeletesReceiver()->where('sender_id',$id);
            if($getdeletesreceiver){
                $getdeletesreceiver->update(['status' => 'pending']);
            }
        }
        return Redirect::back();
    }

    /**
     * Display the all resource.
     *
     * @param  string  $feature
     */
    public function show($feature)
    {
        $auth = Auth::user();
        if($feature=='requests'){//+
            $requests=$auth->getRequests()->paginate(1);
            return view('users.request', compact('requests'));
        }else if($feature=='friends'){//+
            $friendssender=$auth->getFriendsSender()->get();
            $friends=$auth->getFriendsReceiver()->get();
            foreach ($friendssender as $key=>$value){
                $count=count($friends);
                $friends[$count]=$value;
            }
            $friends=$friends->paginate(1);
            return view('users.friend', compact('friends'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)//+
    {
        $auth = Auth::user();
        $auth->getRequests()->where('sender_id',$id)->update(['status' => 'approved']);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//+
    {
        $auth = Auth::user();
        $deletedsender=$auth->getFriendsSender()->where('receiver_id',$id);
        $deletedreceiver=$auth->getFriendsReceiver()->where('sender_id',$id);
//        dump(count($deletedsender));
//        dd(count($deletedreceiver->get()));
        if($deletedsender->get()!==null){
            $deletedsender->update(['status' => 'rejected']);
        }
        if($deletedreceiver->get()!==null){
            $deletedreceiver->update(['status' => 'rejected']);
        }
//        return Redirect::back();
        return redirect()->route('users.show', ['friends']);

    }

    /**
     * Search the searched resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function search(Request $request){//+
        // Get the search value from the request
        $authid = Auth::user()->id;
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $users = User::select('id','name', 'surname', 'email')->where(DB::raw('concat(name," ",surname)'), 'LIKE', "%{$search}%")
            ->whereNotIn('id', Auth::user()->notFriendSender->modelKeys())->whereNotIn('id', Auth::user()->notFriendReceiver->modelKeys())->get();

        // Return the search view with the resluts compacted
        return view('users.search', compact('users','authid'));
    }

    /**
     * Live Search the searched resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function autocomplete(Request $request)
    {
        $search = $request->input('search');
        $friends = User::select('id', 'name', 'surname', 'email')->where(DB::raw('concat(name," ",surname)'), 'LIKE', "%{$search}%")
            ->where('id', Auth::user()->getFriendsSender->modelKeys())->orWhere('id', Auth::user()->getFriendsReceiver->modelKeys())->paginate(1);
        return view('users.friend', compact('friends'));
    }
}
