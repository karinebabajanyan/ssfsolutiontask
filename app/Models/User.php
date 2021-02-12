<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use App\Models\User;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function sender()
    {
        return $this->belongsToMany('App\Models\User', 'relationships', 'sender_id', 'receiver_id');
    }
    public function receiver()
    {
        return $this->belongsToMany('App\Models\User', 'relationships', 'receiver_id', 'sender_id');
    }
    public function getFriendsSender()
    {
        return $this->sender()->where('status','approved');
    }
    public function getFriendsReceiver()
    {
        return $this->receiver()->where('status','approved');
    }
    public function getRequests()
    {
        return $this->receiver()->where('status','pending');
    }
    public function getDeletesSender()
    {
        return $this->sender()->where('status','rejected');
    }
    public function getDeletesReceiver()
    {
        return $this->receiver()->where('status','rejected');
    }
    public function addFriend(User $user,$id)
    {
        $this->sender()->orWhere('receiver_id',$id)->attach($user->id);
    }
    public function notFriendSender()
    {
        return $this->sender()->where('status','approved')->orWhere('status','pending');
    }
    public function notFriendReceiver()
    {
        return $this->receiver()->where('status','approved')->orWhere('status','pending');
    }
//    public function confirmFriend(User $user)
//    {
//        $this->friends()->where($user->status, 'pending')->update([$user->status => 'approved']);
//    }
//    public function removeFriend(User $user)
//    {
//        $this->friends()->where($user->status, 'approved')->update([$user->status => 'rejected']);
//    }
}
