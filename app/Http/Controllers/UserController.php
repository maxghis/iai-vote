<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\ModelValide;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\CreateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function users()
    {
        $tip = "Electeurs";
        $nbre = User::where('type', 2)->count();
        $users = User::where('type', 2)->orderBy('name', 'asc')->paginate(30);
       
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
                'matricule' => ['required', 'unique:users', new ModelValide('MatUser', 'matricule', 'matricule')],
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
                    'matricule' => $request->matricule,
                    'password' => Hash::make($pass),
                    'type' => $request->type,
                ]);

                $mail = Mail::to($request->email)->send(new CreateUserRequest($utilisateur, $pass));
                if ($mail) {
                    return 1;
                } else {
                    $utilisateur->delete();
                    return response()->json(["mail can't be send we have delete user try again"], 500);
                }
                
               
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

    public function onactive()
    {
       return response()->json('Fonctionalite desactive', 500);
    }
}
