<?php
namespace App\Http\Controllers\Auth\Admin;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;

class AuthController extends Controller
{

    public function login()
    {
        return view('Admin.User.login');
    }

    public function index()
    {
        return view('Admin.Dashboard.index');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email','password');
        $remember = $request->get('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // dd(1);
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->route('admin.login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function AllBroker(Request $request)
    {
        $info = User::where('id', '!=', '');

        if($request->search['value']!=''){
            $info = $info->where('title', 'LIKE', $request->search['value'].'%');
        }

        if($request->order['0']['column']!=''){
            if($request->order['0']['column']==2){
                $col = 'updated_at';
            }
            if($request->order['0']['column']==1){
                $col = 'title';
            }
            $info = $info->orderBy('updated_at', $request->order['0']['dir']);
        }

        $count = $info->count();

        $data = $info->offset($request->start)->limit($request->length)->get();

        $this->return = [
            "draw" => $request->draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" =>$data,
        ];
        return response()->json($this->return);
    }
}
