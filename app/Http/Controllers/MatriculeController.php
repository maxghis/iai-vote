<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\MatUser;
use App\Rules\ModelValide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

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
            $maxsuze = 921323323;
            $this->validate($request, [
                'fichier' => 'bail|required|file|mimes:xlsx',
                'classe' => ['required', new ModelValide('Classe', 'classe', 'name')],
                
                ]);

            $namep = $request->fichier->hashName();
            $fichier = $request->fichier->move(public_path().'/tmp', $namep);

            $reader = SimpleExcelReader::create($fichier);

            $rows = $reader->getRows();

         
           
           foreach ($rows->toArray() as  $mat) {

            if ( array_key_exists('mat', $mat) ) {

                $matri = MatUser::where('matricule', $mat['mat'])->first();
                if ($matri == null) {
                    MatUser::create([
                        'matricule' => $mat['mat'],
                        'classe' => $request->classe,
                    ]);
                }
               
            }
               
           }

          File::deleteDirectory('tmp');

           return 1;
        }
        else {
            return response()->json(['Page not Found'], 404);
        }
        
    }
}
