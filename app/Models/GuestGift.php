<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestGift extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'guest_gifts';
    protected $guarded = [];

    public function giftToUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
