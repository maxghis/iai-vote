<?php

namespace App\Models;

use App\Models\User;
use App\Models\Voter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    protected $guarded = [];


    public function candidate()
    {
        return $this->belongsTo(Voter::class, 'voter_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



    use HasFactory;
}
