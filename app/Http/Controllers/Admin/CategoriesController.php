<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $category= Category::leftJoin('categories as parents', 'parents.id','=','categories.parent_id')->select([
          'categories.*',
          'parents.name as parent_name'
      ])

          ->where('categories.status','=','active')
          ->orderBy('categories.created_at','DESC')
          ->orderBy('categories.name','ASC')
          ->with('parent')
          ->withCount('Products as count')
          ->has('Products') //لارجاع الكاتقيوري الي فيها برودكت من خلال العلاقة
          ->withTrashed()
          ->simplePaginate(5);

      $success=session()->get('success');

      return view('admin.categories.index',[
          'categories'=>$category,
          'title'=>'categories list',
          'success'=>$success,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents=Category::all();
        return view('admin/categories/create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
     /*   $rules=[
            'name'=>'required|string|max:255|min:3',
            'parent_id'=>'nullable|int|min:3|',
            'description'=>'nullable|min:5',
            'image'=>'image|max:512000|dimension:min_width=360,min_height=300',
            'status'=>'required|in:active,draft',
        ];
        $clean=$request->validate($rules);
*/

     $request->merge([
         'Slug'=>Str::slug($request->name),
         'status'=>'active',
     ]);
  $category= Category::create($request->all());

         return redirect()->route('categorise.index')
             ->with('success','category created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Category $category)
    {
 return $category->load('parent ','Products');
return $category->products()
    ->with('category: id,name,slug,')
    ->where('price','>',150)
    ->orderBy('price','ASC')
   ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category= Category::findOrFail($id);
        $parents= Category::withTrashed()->where('id','<>',$category->id)->get();
        return view('admin.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
      /*  $rules=[
            'name'=>'required|string|max:255|min:3',
            'parent_id'=>'nullable|int|min:3|',
            'description'=>'nullable|min:5',
            'image'=>'image|max:512000|dimension:min_width=360,min_height=300',
            'status'=>'required|in:active,draft',
        ];
        $clean=$request->validate($rules,[
            // لعمل رسالة الفالديت (اختياري)
            'required'=>'the :attribute required',
            'name.required'=>'the category name required'
        ]);*/

        $category= Category::find($id);
      $category->update($request->all());
        return redirect()->route('categorise.index')
            ->with('success','category updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  Category::destroy($id);
  //session()->put('success','category deleted');
        //session()->flash('success','category deleted');
        return redirect()->route('categorise.index')
            ->with('success','category deleted');
    }
}
