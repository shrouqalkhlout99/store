<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products=product::
      with('category.parent') //لادخال الاسماء عن طريق علاقة بين المودلز
      //join('categories', 'categories.id','=' , 'products.category_id')
          ->select([
              'products.*',
             // 'categories.name as category_name',
          ])
          ->active()


     ->paginate(10);

      return view('admin.products.index',[
              'products'=>$products,
          ]
      );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::pluck('name','id');
        return view('admin.products.create',[
            'categories'=>$categories,
           'product'=>new product(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(productRequest $request)
    {
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image_path=$file->store('/','uploads');
            $request->merge([
                'image_path'=>$image_path,
            ]);

        }
        $request->merge([
            'Slug'=>Str::slug($request->name),

        ]);
        $product=product::create($request->all());
        return redirect()->route('products.index')
            ->with('success',"Product($product->name) created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product=product::findOrFail($id);
      return view('admin.products.show',[
          'product'=>$product,
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=product::findOrFail($id);
        return view('admin.products.edit',[
            'product'=>$product,
            'categories'=>Category::withoutTrashed()->pluck('name','id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, $id)
    {
        $product=product::findOrFail($id);


        if($request->hasFile('image')){
            $file=$request->file('image');
            $image_path=$file->store('/','uploads');
            $request->merge([
               'image_path'=>$image_path,
            ]);

        }
        $product->update($request->all());
        return redirect()->route('products.index')
            ->with('success',"Product ($product->name) updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=product::findOrFail($id);
        $product->delete();
        Storage::disk('uploads')->delete($product->image_path);
        return redirect()->route('products.index')
            ->with('success',"Product($product->name) deleted");
    }
    public function trash()
    {
        $products = product::onlyTrashed()->paginate();
        return view('admin.products.trash', [
            'products' => $products,
        ]);
    }
        public function restore(Request $request,$id = null){
        if($id){
            $products=product::onlyTrashed()->findOrFail($id);
            $products->restore();
            return redirect()->route('products.index')
                ->with('success',"Product ($products->name) restored");
        }
            product::onlyTrashed()->restore();
            return redirect()->route('products.index')
                ->with('success', " All trashed Product restored");


        }
    public function forceDelete(Request $request,$id = null){
        if($id){
            $products=product::onlyTrashed()->findOrFail($id);
            $products->forceDelete();
            return redirect()->route('products.index')
                ->with('success',"Product ($products->name) deleted forever");
        }
        product::onlyTrashed()->forceDelete();
        return redirect()->route('products.index')
            ->with('success', " All trashed Product deleted forever");


    }


}
