<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $categories = Category::latest()->get();
        return view( 'admin.category.index',  compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    {
        
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);

       
        //get form image 
        $image =  $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)){
            //make unique for images
            $currentDate= Carbon::now()->toDateString();
            $imageName = $slug. '-'.  $currentDate .'-'.uniqid().'.'.$image->getClientOriginalExtension();

        
           
          // check category directory exists 
             if(!Storage::disk('public')->exists('category')){
               Storage::disk('public')->makeDirectory('category');
            }
            // //Resize image for category to upload 
              $size1 = Image::make($image)->resize(1600, 479)->stream(); 
              Storage::disk('public')->put('category', $imageName, $size1 ); //not working, persmission issue
             
          //$request->image->move(public_path('storage/category'), $imageName);
     
              
            //check category slider directory exists 
            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category');
            }

           // Resize image for category slider to upload
          //  $size2 = Image::make($image)->resize(500, 333)->stream();
          //  Storage::disk('public')->put('category/slider/', $imageName, $size2 );  
            
           

        }else{
            $imageName = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image =  $imageName;
        $category->save();
        return redirect(route('admin.category.index'))->with('successMsg', 'Category inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,png,jpg'
        ]);

       
        //get form image 
        $image =  $request->file('image');
        $slug = str_slug($request->name);

        $category = Category::find($id);

        if(isset($image)){
            //make unique for images
            $currentDate= Carbon::now()->toDateString();
            $imageName = $slug. '-'.  $currentDate .'-'.uniqid().'.'.$image->getClientOriginalExtension();

          // delete old image 
          if(Storage::disk('public')->exists('category/'. $category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
          }
          //category image slider
          if(Storage::disk('public')->exists('category/slider'. $category->image)){
            Storage::disk('public')->delete('category/slider'.$category->image);
          }
           
          // check category directory exists 
            //  if(!Storage::disk('public')->exists('category')){
            //    Storage::disk('public')->makeDirectory('category');
            // }
            // //Resize image for category to upload 
             // $size1 = Image::make($image)->resize(1600, 479)->stream(); 
             // Storage::disk('public')->put('category', $imageName, $size1 ); //not working, persmission issue
             
          $request->image->move(public_path('storage/category'), $imageName);
    
              
            //check category slider directory exists 
            // if(!Storage::disk('public')->exists('category/slider')){
            //     Storage::disk('public')->makeDirectory('category');
            // }

           // Resize image for category slider to upload
           // $size2 = Image::make($image)->resize(500, 333)->stream();
           // Storage::disk('public')->put('category/slider/', $imageName, $size2 );  
            
           

        }else{
            $imageName =   $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image =  $imageName;
        $category->save();
        return redirect(route('admin.category.index'))->with('successMsg', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // delete old image 
        if(Storage::disk('public')->exists('category/'. $category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
          }
          //category image slider
          if(Storage::disk('public')->exists('category/slider'. $category->image)){
            Storage::disk('public')->delete('category/slider'.$category->image);
          }

          $category->delete();
          return redirect(route('admin.category.index'))->with('successMsg', 'Category deleted successfully');

    }
}
