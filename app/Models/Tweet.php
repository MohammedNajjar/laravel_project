<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    protected $table = 'tweets';
    protected $fillable = ['content', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'likes', 'tweet_id', 'user_id');
    }

}
