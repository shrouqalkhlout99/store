<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
   public function store(Request $request,$type)
   {
       $request->validate([
         'rating'=>'required|int|min:1|max:5',
           'id'=>'required|int',
       ]);
       if($type== 'product'){
           $model=product::find($request->post('id'));
       }
     elseif ($type== 'user'){
         $model=User::find($request->post('id'));
     }else{
           abort(404);
       }

       $rating=$model->ratings()->create([
           'rating'=>$request->post('rating'),

       ]);

       return $rating;
   }
}
