<?php

namespace App\Http\Controllers\v1;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->call = new ResponseController;
    }
    
    public function checkAuth(Request $request)
    {
        $fetchHeader = $request->header('Authorization');
        $header = str_replace('Render-App ', '', $fetchHeader);
        $user = User::where('token_auth',$header)->first();

        if ($user) {
            return $this->call->arrays('ok',
            'Authenticate',
            [
                'id' => $user->id,
                'privileges' => $user->privileges,
                'nama' => $user->first_name . ' ' . $user->last_name,
            ],
             200);
            // return $this->call->index('ok','Authenticate', 200);
        }else{
            return $this->call->index('failed','Silahkan login kembali', 401);
        }
    }

    public function login(Request $request)
    {
    	$user =User::where('username',$request->username)
            ->orWhere('email',$request->email)
            ->first();
    	if($user){
    		if (Hash::check($request->password, $user->password)) {
                $token = Str::random(10);
                $user->update([
                    'token_auth' => $token,
                ]);
                return $this->call->arrays('ok',
                    'berhasil login',
                    [
                        'token' => $token,
                        'id' => $user->id,
                        'privileges' => $user->privileges,
                        'nama' => $user->first_name . ' ' . $user->last_name,
                    ],
                     200);
    		}else{
                return $this->call->index('failed','Periksa kembali password anda', 401);
    		}
    	}else{
            return $this->call->index('failed','Email atau username yang anda gunakan tidak ada terdaftar', 401);
    	}
    }

    public function logout(Request $request)
    {
        $fetchHeader = $request->header('Authorization');
        $header = str_replace('Render-App ', '', $fetchHeader);
        $user = User::where('token_auth',$header)->first();

        if ($user) {
            $user->update([
                'token_auth' => null,
            ]);
            return $this->call->index('ok','Berhasil logout', 200);
        }else{
            return $this->call->index('failed','Silahkan login kembali', 401);
        }
    }

    public function buatAkun(Request $request)
    {
        // Dokumentasi Header Request
        // $fetchHeader = $request->header('Authorization');
        // $header = str_replace('Render-App ', '', $fetchHeader);
        // $user = User::where('token_auth',$header)->first();
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'privileges' => "aparatur",
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'username' => $request->username,
            'password'=> Hash::make($request->password),
        ]);
        
        return $this->call->index('ok','Berhasil membuat akun aparatur', 200);
    }
    
}
