<?php

namespace App\Models;

use App\Models\Voter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function voters()
    {
        return $this->hasMany(Voter::class, 'cathegory_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'cathegory_id');
    }
}
