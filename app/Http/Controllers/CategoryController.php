<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
        elseif($action == "state"){

            $cat = Category::find($request->id);
            if ($cat != null) {
                
                if ($cat->status == 1) {
                    $cat->update([
                        'status' => 0,
                    ]);
                    return 1;
                }
                else
                {   $cat->update([
                    'status' => 1,
                ]);

                return 1;

                }
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
