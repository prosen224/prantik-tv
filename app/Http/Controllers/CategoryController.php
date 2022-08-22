<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function index(){
        
        $category = Category::paginate(10);
        return view('Frontend.Category.index', ['category'=>$category]);
    }
    public function new(){
        return view('Frontend.Category.new');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'status'=>'required',
        ]);
        $insert_here = Category::create(
            $validator->validated()
        );
        $id = $insert_here->id;
        Category::find($id)->update(['slug'=>\Str::slug($request->name)]);

        return redirect()->route('admin.category')->with('message', 'Category Added Successfully');
    }
    public function edit($aaa){
        $edit = Category::find($aaa);
        return view('Frontend.Category.edit', ['edit'=> $edit]);
    }


    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'status'=>'required',
        ]);
        Category::find($id)->update(
            $validator->validated()
        );
        Category::find($id)->update(['slug'=>\Str::slug($request->name)]);
        return redirect()->route('admin.category')->with('message', 'Category Updated Successfully');

        // return redirect('admin.category');
    }

    public function delete($bbb){
        $delete = Category::find($bbb)->delete();
        return redirect()->route('admin.category')->with('warning', 'Category Deleted Successfully');
    }
}
