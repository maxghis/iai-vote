<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\MatUser;
use App\Rules\ModelValide;
use Illuminate\Http\Request;

class MatriculeController extends Controller
{
    public function index()
    {
        
        $nbre = MatUser::count();
        $matricules = MatUser::orderBy('matricule', 'asc')->paginate(1000);
     
            return view('admin.matUser', compact('matricules', 'nbre'));
        
    }

    public function manage_matricules()
    {
        $classes = Classe::get();
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $matricule = MatUser::find($id);

         

            if ($matricule != null) {
               
                if (isset($_GET['type'])) {
                    return view('admin.delete_matricule', compact('matricule', 'classes'));
                } else {
                    return view('admin.manage_matricule', compact('matricule', 'classes'));
                }
                
            }

            return response()->json(['invalid Input'], 404);

        }

        if (isset($_GET['type'])) {
            return view('admin.manage_mass_matricule', compact('classes'));
        }
        return view('admin.manage_matricule', compact('classes'));
    }

    
    public function del_save_matricule($action, Request $request)
    {
        if ($action == "save") {

          

            if (empty($request->id)) {
                $request->id = 0;
            }
            $user = MatUser::find($request->id);

            if ($user == null) {

                $this->validate($request, [
                'matricule' => ['required', 'string', 'max:255', 'unique:mat_users'],
                'classe' => ['required', new ModelValide('Classe', 'classe', 'name')],
                ]);
            
         
                MatUser::create([
                    'matricule' => $request->matricule,
                    'classe' => $request->classe,
                ]);

                return 1;
                
               
            } else {

                $this->validate($request, [
                    'matricule' => ['required', 'string', 'max:255', 'unique:mat_users'],
                    'classe' => ['required', new ModelValide('Classe', 'classe', 'name')],
                    ]);
            

                $user->update([
                    'matricule' => $request->matricule,
                    'classe' => $request->classe,
                ]);
    
               return 2;
            }
            
            
        } elseif($action == "delete"){

           $user = MatUser::find($request->id);
           if ($user != null) {
            $user->delete();
            return 1;
           }
           else {
            return response()->json(['Ressource not found'], 202);
           }
           
        }

        elseif ($action == "mass-save") {
            $this->validate($request, [
                'classe' => ['required', new ModelValide('Classe', 'classe', 'name')],
                ]);
            $matricules = explode("_", $request->matricule);
           foreach ($matricules as $matricule) {
                $mat = MatUser::where('matricule', $matricule)->first();
                if ($mat == null) {
                    MatUser::create([
                        'matricule' => $matricule,
                        'classe' => $request->classe,
                    ]);
                }
           }

           return 1;
        }
        else {
            return response()->json(['Page not Found'], 404);
        }
        
    }
}
