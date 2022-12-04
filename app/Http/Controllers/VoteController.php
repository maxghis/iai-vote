<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Voter;
use App\Models\Category;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    
    public function index()
    {
        $categories = array();
        $categos = Category::with('voters')->get();
       foreach ($categos as $categorie) {
        $use = Vote::where('cathegory_id', $categorie->id)->where('user_id', auth()->user()->id)->first();
            array_push($categories, compact('use', 'categorie'));
            
       }
    
        return view('vote.index', compact('categories'));
        
    }

    public function submit(Request $request)
    {
        
      foreach ($request->opt_id as $key => $value) {
        $categories = Category::with('voters')->get();
        $cats = $categories->pluck('id');
        foreach ($cats as $cat) {

           if ($key == $cat) {
              $cate = Voter::find(intval($value[0]));
            $vote = Vote::where('cathegory_id', $cate->cathegory_id)->where('user_id', auth()->user()->id)->first();    
            if ($vote == null) {
                Vote::create([
                    'user_id' => auth()->user()->id,
                    'voter_id' => intval($value[0]),
                    'cathegory_id' => $cate->cathegory_id,
                ]);

                return 1;
            }

           }
        }
      }
    }

    public function result()
    {
        $categos = Category::with('voters')->get();
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
        return view('vote.result', compact('voters', 'user_votes', 'categories'));
    }

   
    public function about()
    {
        $categories = Category::with('voters')->get();

        return view('vote.about-candidate', compact('categories'));

    }

    public function aboutCandate(Voter $voter)
    {
       return view('vote.show-candidate', compact('voter'));
    }

    
}
