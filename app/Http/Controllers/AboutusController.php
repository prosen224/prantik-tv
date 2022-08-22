<?php

namespace App\Http\Controllers;

use App\Models\Aboutus;
use Illuminate\Http\Request;
use Validator;
use File;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $aboutus = Aboutus::first();
        if(!$aboutus){
            $aboutus = new Aboutus();
            $aboutus->save();
        }
        return view('Frontend.About.index',compact('aboutus'));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        Aboutus::find($id)->update(
            $validator->validated()
        );
        if($request->hasfile('image')){
            if(Aboutus::find($id)->image && File::exists('uploads/aboutus/'.Aboutus::find($id)->image)){
                File::delete('uploads/aboutus/'.Aboutus::find($id)->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('uploads/aboutus', $filename);
            Aboutus::find($id)->update(['image'=>$filename]);
        }

        return redirect()->route('admin.about-us')->with('message', 'Aboutus Updated Successfully');
    }

    public function dcma(Request $request)
    {
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
            ]);
    
            Aboutus::find($request->id)->update(
                $validator->validated()
            );
            if($request->hasfile('image')){
                if(Aboutus::find($request->id)->image && File::exists('uploads/aboutus/'.Aboutus::find($request->id)->image)){
                    File::delete('uploads/aboutus/'.Aboutus::find($request->id)->image);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time(). '.' .$extension;
                $file->move('uploads/aboutus', $filename);
                Aboutus::find($request->id)->update(['image'=>$filename]);
            }
    
            return redirect()->route('admin.dcma')->with('message', 'DCMA Updated Successfully');
        }

        $dema = Aboutus::find(2);
        if(!$dema){
            $dema = new Aboutus();
            $dema->save();
        }
        return view('Frontend.About.dema',compact('dema'));
    }

}
