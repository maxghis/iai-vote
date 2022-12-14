<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\Category;
use App\Rules\FileValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function manage_candidate()
    {
        $categories = Category::where('status', true)->with('voters')->get();
       
       return view('admin.manage_candidate', compact('categories'));
    }

    public function manage_candi()
    {
        $categories = Category::where('status', true)->with('voters')->get();
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
