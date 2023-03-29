<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use Auth;
use App\Http\Requests\MainCategoryCreateRequest;

class PostMainCategoryController extends Controller
{
    public function addView(){
        $main_category=PostMainCategory::all();
        $category_list=PostMainCategory::with('postSubCategories')->get();
        $sub_category=PostSubCategory::all()->pluck('post_main_category_id')->toArray();
        $sub_category_id=array_flip($sub_category);
        return view('categories/add',['main_category'=>$main_category,'category_list'=>$category_list,'sub_category_id'=>$sub_category_id]);
    }

    public function add(MainCategoryCreateRequest $request){
        $main_categories=new PostMainCategory;
        $main_categories->main_category=$request->input('main_category');
        $main_categories->save();
        return redirect("/add_category");
    }

    public function delete($id){
        \DB::table('post_main_categories')
             ->where('id',$id)
             ->delete();

             return redirect('/add_category');
    }
}
