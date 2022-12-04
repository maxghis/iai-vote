<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Voter;
use App\Models\Category;
use App\Rules\FileValidate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ActivationRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $categos = Category::where('status', true)->with('voters')->get();
        $categories = array();
       foreach ($categos as $categorie) {
        $colect = collect([]);
      
        foreach ($categorie->voters as $voter) {
            $colect->push(['nbrvote' => $voter->votes()->count(), 'voter' => $voter]);
        }
    

    $electTries = $colect->sort(function($a, $b){
        if ($a['nbrvote'] == $b['nbrvote']) {
           return 0;
        }
        return $a['nbrvote'] > $b['nbrvote'] ? -1 : 1;
        });

        array_push($categories, compact('electTries', 'categorie'));
       }

     
       
         $voters = User::where('type', 2)->count();
        $user_votes = Vote::count();
        return view('admin.index', compact('voters', 'user_votes', 'categories'));
    }

   
    

    

    public function admin()
    {
        $tip = "Administrateur";
        $nbre = User::where('type', 1)->count();
        $users = User::where('type', 1)->orderBy('name', 'asc')->paginate(40);
       
        return view('admin.users', compact('users', 'tip', 'nbre'));
    }


  

}
