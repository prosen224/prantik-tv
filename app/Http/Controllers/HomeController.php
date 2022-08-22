<?php

namespace App\Http\Controllers;

use App\Models\Aboutus;
use App\Models\Category;
use App\Models\Videos;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $category_model = new Category();
        $data = [];
        $data['featured'] = Videos::where('featured',1)->orderBy('created_at', 'DESC')->get();
        $data['category'] = Category::where('status',1)->get();
        $data['most_popular'] = Videos::orderBy('view_count', 'DESC')->limit(3)->get();

        $category_video = [];
        if($data['category']->count() > 0){
            foreach($data['category'] as $category){
                $category_video[$category->name] = Videos::where('category_id',$category->id)->orderBy('created_at', 'DESC')->limit(4)->get();
            }
        }
        return view('index', $data)->with('category_video', $category_video)->with('category_model', $category_model);
    }

    public function view_category($slug)
    {
        $data = [];
        if($slug == "most-popular"){
            $data["videos"] = Videos::orderBy('view_count', 'DESC')->paginate(20);
            $data["category_name"] = "Most Popular";
        }else{
            $find_category = Category::where('slug',$slug)->first();
            $data["category_name"] = $find_category->name;
            $data["videos"] = Videos::where('category_id', $find_category->id)->paginate(20);
        }
      
       return view('view_category', $data);
    }

    public function checkCaptcha($request)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $data = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->recaptcha,
            'remoteip' => $remoteip,
        ];

        /* CURL */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        /* END */

        $resultJson = json_decode($result);

        if ($resultJson->success != true) {
            //return back()->withErrors(['captcha' => 'ReCaptcha Error']);
            $this->return = [
                "status" => "error",
                "errors" => 'ReCaptcha Error',
            ];
            return $this->return;
        }

        if ($resultJson->score >= 0.3) {
            $this->return = [
                "status" => "success",
                "errors" => 'ReCaptcha Success',
                'data' => $resultJson,
            ];
            return $this->return;

        } else {
            $this->return = [
                "status" => "error",
                "errors" => 'ReCaptcha Error',
            ];
            return $this->return;
        }
    }

    public function view_video ($slug)
    {
        $data = [];
        $data["slug"] = $slug;
        if($slug == "all"):
            $data["videos"] = Videos::orderBy('view_count', 'DESC')->paginate(20);
        else:
        $data["video"] = Videos::with('r_category')->where('slug', $slug)->first();
        $data["video"]->view_count = $data["video"]->view_count + 1;
        $data["video"]->save();
        $data["videos"] = Videos::with('r_category')->where('category_id', $data["video"]->category_id)->where('id','!=',$data["video"]->id)->orderBy('created_at', 'DESC')->limit(3)->get();
        endif;
       
        return view('view_video', $data);
    }
    public function about()
    {
        $data = Aboutus::first();
        return view('about',compact('data'));
    }
    public function dcma()
    {
        $data = Aboutus::find(2);
        return view('dema',compact('data'));
    }

    public function contactUs(Request $request)
    {  
       
        if(request()->isMethod('post')){
            $check_captcha = $this->checkCaptcha($request);
            if ($check_captcha['status'] != "success") {
                $this->return = [
                    "status" => "error",
                    "message" => "Something went wrong. Please try again.",
                ];
                return response()->json($this->return);
            }
            $data = [];
            $to = $request->visitor_email;
            $name = $request->visitor_name;
            $receiver = env('CONTACT_USMAIL_RECIPIENT');
            // $data['subject'] = $request->subject;
            // $data['message'] = $request->message;

            $data["content"] = $request->visitor_message;

            Mail::send('mail', $data, function($message) use ($to ,$name,$receiver ) {
                $message->to($receiver, "env('APP_NAME')")->subject('Contract Email');
                $message->from($to, $name);
            });

            return response()->json(['status' => 'success','message'=>"Your message has been sent successfully."]);
            // return Redirect::back()->with('msg', 'Message Sent Successfully');
            // return redirrect()->back()->with("message","Contact Us Mail Sent Successfully");
        }

        return view('contact_us');
    }
    public function search(Request $request){
        // search from videos table
        if($request->search_with == ''){
            return Redirect::back();
        }
        $data = [];
        $data["search_with"] = $request->search_with;
        if($request->search_with != ''){
            $data['videos'] = Videos::where('title','LIKE','%'.$request->search_with.'%')->orWhere("description",'%'.$request->search_with.'%')->get();
        }
        return view('search',$data); 
    }
}
