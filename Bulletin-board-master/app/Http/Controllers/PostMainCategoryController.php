<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts\PostMainCategory;
use Auth;
use App\Http\Requests\MainCategoryCreateRequest;

class PostMainCategoryController extends Controller
{
    public function addView(){
        $main_category=\DB::table('post_main_categories')->get();
        return view('categories/add',['main_category'=>$main_category]);
    }

    public function add(MainCategoryCreateRequest $request){
        $main_categories=new PostMainCategory;
        $main_categories->main_category=$request->input('main_category');
        $main_categories->save();
        return redirect("/add_category");
    }
}
