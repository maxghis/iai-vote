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
        return view('admin.index', compact('voters', 'user_votes', 'categories'));
    }

    public function category()
    {
        $categories = Category::get();
        return view('admin.cathegory', compact('categories'));
    }

  
    public function del_save_cat($action, Request $request)
    {
        if ($action == "save") {

            $this->validate($request, [
                'category' => ['required', 'max:255'],
            ]);

            if (empty($request->id)) {
                $request->id = 0;
            }
            $cate = Category::find($request->id);

            if ($cate == null) {
                Category::create([
                    'cat' => $request->category,
                ]);
    
               return 1;
            } else {
                $cate->update([
                    'cat' => $request->category,
                ]);
    
               return 2;
            }
            
            
        } elseif($action == "delete"){

           $cat = Category::find($request->id);
           if ($cat != null) {
            $cat->delete();
            return 1;
           }
           else {
            return response()->json(['Ressource not found'], 202);
           }
           
        }
        else {
            return response()->json(['Page not Found'], 404);
        }
        
    }

    public function users()
    {
        $tip = "Electeurs";
        $nbre = User::where('type', 2)->count();
        $users = User::where('type', 2)->orderBy('name', 'asc')->paginate(30);
       
        return view('admin.users', compact('users', 'tip', 'nbre'));
    }

    public function admin()
    {
        $tip = "Administrateur";
        $nbre = User::where('type', 1)->count();
        $users = User::where('type', 1)->orderBy('name', 'asc')->paginate(40);
       
        return view('admin.users', compact('users', 'tip', 'nbre'));
    }

    public function manage_users()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $user = User::find($id);

            if ($user != null) {
                if (isset($_GET['type'])) {
                    return view('admin.delete_user', compact('user'));
                } else {
                    return view('admin.manage_user', compact('user'));
                }
                
            }

            return response()->json(['invalid Input'], 404);

        }
        return view('admin.manage_user');
    }


    public function manage_candi()
    {
        $categories = Category::with('voters')->get();
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $user = Voter::find($id);

            if ($user != null) {
               
                    return view('admin.man_candidate', compact('user', 'categories'));
                
                
            }

            return response()->json(['invalid Input'], 404);

        }
        return view('admin.man_candidate', compact('categories'));
    }


    public function del_save_user($action, Request $request)
    {
        if ($action == "save") {

          

            if (empty($request->id)) {
                $request->id = 0;
            }
            $user = User::find($request->id);

            if ($user == null) {

                $this->validate($request, [
                    'name' => ['required', 'string', 'max:255'],
                    'type' => ['required', 'in:1,2'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);


                $ran = strtolower(str_shuffle(strrev(Str::random(5))));
                $ver = User::where('username', $ran)->first();
                while ($ver != null) {
                    $ran = Str::random(5);
                    $ver = User::where('username', $ran)->first();
                }
                $pass = str_shuffle(strrev('@'.(Str::random(6)).'#'));
                $utilisateur = User::create([
                    'name' => $request->name,
                    'username' => $ran,
                    'email' => $request->email,
                    'password' => Hash::make($pass),
                    'type' => $request->type,
                ]);

                Mail::to($request->email)->send(new ActivationRequest($utilisateur, $pass));
    
               return 1;
            } else {

                $this->validate($request, [
                    'name' => ['required', 'string', 'max:255'],
                    'type' => ['required', 'in:1,2'],
                'email' => ['required', 'string', 'email', 'max:255'],
                ]);
            

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'type' => $request->type,
                ]);
    
               return 2;
            }
            
            
        } elseif($action == "delete"){

           $user = User::find($request->id);
           if ($user != null) {
            $user->delete();
            return 1;
           }
           else {
            return response()->json(['Ressource not found'], 202);
           }
           
        }
        else {
            return response()->json(['Page not Found'], 404);
        }
        
    }


    public function manage_candidate()
    {
        $categories = Category::with('voters')->get();
       
       return view('admin.manage_candidate', compact('categories'));
    }

    public function del_save_can($action, Request $request)
    {
        $aceptimg = array('image/jpg', 'image/jpeg', 'image/png', 'image/x-jg', '.bm image/bmp', 'image/gif', 'image/pjpeg');
        $aceptvideo = array('video/mp4');
        $maxsuze = 921323323;
        

    

        if ($action == "save") {

          

            if (empty($request->id)) {
                $request->id = 0;
            }
            $user = Voter::find($request->id);

            if ($user == null) {
                

                $this->validate($request, [
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'max:500'],
                'imgp' => ['required', new FileValidate($request, $aceptimg, $maxsuze, 'imgp')],
                'imgc' => ['required', new FileValidate($request, $aceptimg, $maxsuze, 'imgc')],
                'videoc' => ['required', new FileValidate($request, $aceptvideo, $maxsuze, 'videoc')],
                ]);

      
                Voter::create([
                    'name' => $request->name,
                    'description' => htmlspecialchars($request->description),
                    'cathegory_id' => intval($request->type),
                    'image_campagne' => $request->file('imgc')->store('candidates/image_campagne', 'public'),
                    'image_profile' => $request->file('imgp')->store('candidates/image_profile', 'public'),
                    'video_campagne' => $request->file('videoc')->store('candidates/video_campagne', 'public'),
                ]);
    
               return 1;
            } else {

                $this->validate($request, [
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'max:500'],
                ]);
          
                   
                $user->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

                if ($request->hasFile('imgc')) {
                    Storage::disk('public')->delete($user->image_campagne);
                    $this->validate($request, [
                    'imgc' => ['required', new FileValidate($request, $aceptimg, $maxsuze, 'imgc')],
                    ]);
                    $user->update([
                        'image_campagne' => $request->file('imgc')->store('candidates/image_campagne', 'public'),
                    ]);
                }

                if ($request->hasFile('imgp')) {
                    Storage::disk('public')->delete($user->image_profile);
                    $this->validate($request, [
                    'imgp' => ['required', new FileValidate($request, $aceptimg, $maxsuze, 'imgp')],
                    ]);
                   // dd( $request->file('imgp')->store('candidates/image_profile', 'public'));
                    $user->update([
                        'image_profile' => $request->file('imgp')->store('candidates/image_profile', 'public'),
                    ]);
                }

                if ($request->hasFile('videoc')) {
                    Storage::disk('public')->delete($user->video_campagne);
                    $this->validate($request, [
                    'videoc' => ['required', new FileValidate($request, $aceptvideo, $maxsuze, 'videoc')],
                    ]);
                    $user->update([
                        'video_campagne' => $request->file('videoc')->store('candidates/video_profile', 'public'),
                    ]);
                }



          
               return 2;
            }
            
            
        } elseif($action == "delete"){

           $user = Voter::find($request->id);
           if ($user != null) {
            Storage::disk('public')->delete($user->image_campagne);

            Storage::disk('public')->delete($user->image_profile);

            Storage::disk('public')->delete($user->video_campagne);

            $user->delete();
            return 1;
           }
           else {
            return response()->json(['Ressource not found'], 202);
           }
           
        }
        else {
            return response()->json(['Page not Found'], 404);
        }
        
    }

}
