<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\SubCategoryCreateRequest;

class PostSubCategoryController extends Controller
{
    public function add(SubCategoryCreateRequest $request){
        $param=[
            'post_main_category_id'=>$request->main_category_id,
            'sub_category'=>$request->sub_category
        ];
        DB::table('post_sub_categories')->insert($param);
        return redirect("/add_category");
    }
}
