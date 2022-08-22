<?php
namespace App\Http\Controllers\Auth\User;

use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Auth;
use App\Models\User;
use App\Models\Videos;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Validator;
use Mail;
class AuthController extends Controller
{

    public $return;
    public function __construct()
    {
        $this->return =[
            "status"=>"error"
        ];
            
    }
    public function index()
    {
        $data=[];
        $data['videos'] = Videos::all()->count();
        $data['category'] = Category::all()->count();
        $data["total_view"] = Videos::sum('view_count');
        return view("Frontend.Dashboard.index",$data);
    }

    public function login()
    {
        return view('Frontend.User.login');
    }

    public function authenticate(Request $request)
    {
            $validator = null;
            $validator = Validator::make($request->all(), [
                // 'email' => 'required|string|email',
                'name' => 'required',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                $this->return = [
                    "status" => "error",
                    "errors" => $validator->errors(),
                ];
            }else{
            $credentials = $request->only('email','password');
            $remember = $request->get('remember');
            // $activity_query = User::where("email", $request->email)->first();
            $activity_query = User::where("name", $request->name)->first();
            if($activity_query){
                if($activity_query->status != 1){
                    $this->return = [
                        "status"=>"inactive",
                        "message"=>"Your are not a active user. Please contact to the admin about your activity."
                    ];
                }else{
                    if (Auth::guard('web')->attempt(['name' => $request->name, 'password' => $request->password,'status' => "1"])) {
                        $this->return = [
                            "status"=>"success",
                            "message"=>"Welcome! You are successfully login."
                        ];
                    }else{
                        $this->return = [
                            "status"=>"error",
                            "message"=>"Invalid Credentials."
                        ];
                    }
                }
            }else{
                $this->return = [
                    "status"=>"error",
                    "message"=>"We couldn't find your account, please register first."
                ];
            }


        }
        return response()->json($this->return);
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function register()
    {
        return view('Frontend.User.registration');
    }

    public function store(Request $request)
    {
        $validator = null;

        $validator = Validator::make($request->all(), [
            'user_name'     => 'required|unique:users,name',
            'phone'      => 'required|numeric',
            'email'          => 'required|unique:users,email',
            'password'       => 'required',
            'first_name'       => 'required',
            'last_name'       => 'required',
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        }else{
            $user = new User();
            $vc =  $user->generateCode();
            $user->email = $request->email;
            $user->name = $request->user_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->verify_code = $vc;
            $user->password = bcrypt($request->password);
            if($user->save()){
                $user->sendVerificationMail($user->id);
                $this->return = [
                    "status"=>"success",
                    "message"=>__("A verification link sent to your email. Please check your email to verify your account.")
                ];
            }
        }
        return response()->json($this->return);
    }

    public function verifyEmail()
    {
        $verify_id = decrypt($_GET["vef"]);
        $verify_query = User::where("verify_code",$verify_id)->first();
        if($verify_query){
            $verify_query->updateRole($verify_query->id);
            Auth::login($verify_query);
            return redirect()->intended(route('home'));
        }else{
            return redirect()->route('login');
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = null;

        $validator = Validator::make($request->all(), [
            'email'          => 'required|email',
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
                "message"=>"We couldn't find your account please register first."
            ];
        }else{
            $user_email = $request->email;
            $query = User::where("email",$user_email)->first();
            // dd($query);
            if($query){
                $query->sendForgotPasswordMail($query->id);
                // return 1;
                $this->return = [
                    "status"=>"success",
                    "message"=>"A reset password link sent to your email. Please check your email to reset your password."
                ];
            }else{
                // return 0;
                $this->return =[
                    "status"=>"error",
                    "message"=>"We couldn't find your account please register first."
                ];
            }
        }
        return response()->json($this->return);
    }

    public function setPassword(Request $request,$id)
    {
        $u_id = Crypt::decrypt($id);
        $request->validate([
            'password'     => 'required|min:8',
            'password_mass' => 'required|min:8'
        ]);
        $pass = $request->password;
        $pass_mass = $request->password_mass;
        if($pass == $pass_mass){
            $set_pass_query = User::findOrFail($u_id);
            $set_pass_query->password = bcrypt($request->password);
            if($set_pass_query->save()){
                $this->return =[
                    "status"=>"success",
                    "message"=>"Welcome! Your password reset successfully."
                ];
            }
        }
        return response()->json($this->return);
    }

    function sendMail($to='',$user_name='')
    {
        $to = "jshohan887@gmail.com";
        // $data = array('name'=>"env('APP_NAME')");

        $data = [
            "to"=>$to,
            "user_name"=>$user_name,
        ];

        Mail::send('mail', $data, function($message) use ($to) {
            $message->to($to, 'Shohan')->subject('Your One time E-mail varification link - env("APP_NAME")');
            $message->from("shohan@coder71.com", "env('APP_NAME')");
        });
        echo "HTML Email Sent. Check your inbox.";
    }
    public function changePassword(Request $request)
    {
        $validator = null;
        $validator = Validator::make($request->all(), [
            'current_pass'     => 'required|min:8',
            'confirm_pass'      => 'required|min:8',
            'new_pass'          => 'required|min:8',
        ]);
        if ($validator->fails()) {
            $this->return = [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        }else{
            $current_password = $request->current_pass;
            $confirm_password = $request->confirm_pass;
            $new_password = $request->new_pass;
            if($confirm_password == $new_password){
                $user = User::findOrFail(Auth::user()->id);
                if (Hash::check($request->current_pass, $user->password)) {
                    $user->password = bcrypt($new_password);
                    if($user->save()){
                        $this->return = [
                            "status"=>"success",
                            "message"=>"Password changed successfully."
                        ];
                    }
                }else{
                    $this->return = [
                        "status"=>"error",
                        "message"=>"Password doesn't match, If your forgot your password please reset your password."
                    ];
                }
            }else{
                $this->return =[
                    "status"=>"error",
                    "message"=>"New password and confirm password doesn't match."
                ];
            }
        }

        return response()->json($this->return);
    }


}
