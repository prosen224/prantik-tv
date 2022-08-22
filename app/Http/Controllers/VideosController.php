<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;
class VideosController extends Controller
{
    public function index(){

        

        if(isset($_GET['title']) || isset($_GET['category']) || isset($_GET['status'])):
            $videos = Videos::where(function($q){
                if($_GET['title'] !=''){
                    $q->orWhere('title', 'like', '%' . $_GET['title'] . '%');
                    
                }
                if($_GET['category'] !=''){
                    $q->orWhere('category_id',$_GET['category']);
                }
                if(isset($_GET['status']) !=''){
                    $q->orWhere('status',$_GET['status']);
                }
            })->with('r_category')->get();

        else:
            $videos = Videos::with('r_category')->get();
        endif;
        $category = Category::all();
        return view('Frontend.Videos.index', ['videos'=>$videos,'category'=>$category]);
    }
    public function new(){
        $category = Category::all();
        return view('Frontend.Videos.new', ['category'=>$category]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|unique:videos',
            'video_url' => 'required|min:5',
            'description' => 'required|min:5',
            'featured'=>'required',
            'status'=>'required',
            'category_id'=>'required',
        ]);
        $slug = \Str::slug($request->title);
        $insert_here = Videos::create(
            $validator->validated()
        );
        // get id here
        $id = $insert_here->id;
        Videos::find($id)->update(['slug'=>$slug]);
        if($request->hasfile('thumb_image')){
            $file = $request->file('thumb_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('uploads/thumb_image', $filename);
            Videos::find($id)->update(['thumb_image'=>$filename]);
        }

        if($request->hasfile('banner_image')){
            $file = $request->file('banner_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('uploads/banner_image', $filename);
            Videos::find($id)->update(['banner_image'=>$filename]);
        }
        return redirect()->route('admin.videos')->with('message', 'Video Added Successfully');
    }


    public function edit($aaa){
        $videos = Videos::find($aaa);
        $category = Category::all();
        return view('Frontend.Videos.edit', ['videos'=> $videos, 'category'=>$category]);
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:videos,title,'.$id,
            'video_url' => 'required|min:5',
            'description' => 'required|min:5',
            'status'=>'required',
            'featured'=>'required',
            'category_id'=>'required',
        ]);
        $slug = \Str::slug($request->title);
       Videos::find($id)->update(
            $validator->validated()
        );
        Videos::find($id)->update(['slug'=>$slug]);
        if($request->hasfile('thumb_image')){
            $old_img = public_path('uploads/thumb_image/'.Videos::find($id)->thumb_image);
            if(File::exists($old_img)){
                File::delete($old_img);
            }
            $file = $request->file('thumb_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('uploads/thumb_image', $filename);
            Videos::find($id)->update(['thumb_image'=>$filename]);
        }

        if($request->hasfile('banner_image')){
            $file = $request->file('banner_image');
           
            $old_img = public_path('uploads/banner_image/'.Videos::find($id)->banner_image);
            if(File::exists($old_img)){
                File::delete($old_img);
            }
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('uploads/banner_image', $filename);
            Videos::find($id)->update(['banner_image'=>$filename]);
        }

        return redirect()->route('admin.videos')->with('message', 'Video Updated Successfully');
    }

    public function delete($id){
        // file delete if exist
        $old_img = public_path('uploads/thumb_image/'.Videos::find($id)->thumb_image);
        if(File::exists($old_img)){
            File::delete($old_img);
        }
        $old_img = public_path('uploads/banner_image/'.Videos::find($id)->banner_image);
        if(File::exists($old_img)){
            File::delete($old_img);
        }
        Videos::find($id)->delete();
        return redirect()->route('admin.videos')->with('message', 'Video Deleted Successfully');
    }
}
