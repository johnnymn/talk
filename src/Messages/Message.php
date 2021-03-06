<?php
namespace Nahid\Talk\Messages;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{

    protected $table='messages';

    public $timestamps=true;
    public $fillable = ['message', 'is_seen', 'deleted_from_sender', 'deleted_from_reciever', 'user_id', 'conversation_id'];

    public function getTimeAgoAttribute(){
        $date = new Carbon($this->attributes['created_at']);
        $now = $date->now();
        return $date->diffForHumans($now, true);
    }

    public function conversation()
    {
        return $this->belongsTo('App\Conversations');
    }

    public function user()
    {
        return $this->belongsTo(config('talk.user.model', 'App\User'));
    }
}
