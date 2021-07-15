<?php

namespace App\Http\Controllers\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct()
    {
        $this->call = new ResponseController;
    }

    public function getSemuaUser()
    {        
        return $this
            ->call
            ->arrays(
                'ok',
                'success',
                User::with('survey')->get(),
                200);
    }

    public function buatUserAparatur(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:6',
        ]);
        User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);
        return $this->call->index('ok','Berhasil menambahkan data',200);
    }

    public function detailUser($id)
    {
        $user = User::find($id);
        $calon = $user->jadwal;
        $calonJadwal;
        foreach ($calon as $x) {
            $user['jadwal'] = $x;
        }
        return $this->call->arrays(
            'ok',
            'success',
            $user,
        200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);
        return $this->call->index('ok','data berhasil diubah',200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->call->index('ok','data berhasil dihapus',200);
    }
    
}
