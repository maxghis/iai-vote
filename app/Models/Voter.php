<?php

namespace App\Models;

use App\Models\User;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voter extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function votes()
    {
        return $this->belongsToMany(User::class, 'votes', 'voter_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cathegory_id');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
