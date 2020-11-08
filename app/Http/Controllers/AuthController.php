<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function index(){
        $data = User::with('detail')->find(Auth::id())->first();
        return view('dashboard.akun', compact('data'));
    }

    public function update(Request $request, $id){
        $input = $request->except('_method');
        $input['nama'] = ucwords($request->nama);
        $input['alamat'] = ucwords($request->alamat);

        try {
            UserDetails::where(['user_id' => $id])->update($input);

            return response()->json([
                'message' => 'Profil berhasil diperbarui'
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function updateAccount(Request $request){
        // $input = $request->except('_method');
        $id = Auth::id();

        $this->validate($request, [
            'email' => 'required|email|max:190|unique:users,email,'. $id
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            try {
                User::find($id)->update([
                    'email' => strtolower($request->email),
                    'password' => app('hash')->make($request->new_password)
                ]);
    
                return response()->json([
                    'message' => 'Akun berhasil diperbarui'
                ], 201);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 400);
            }
        }else{
            return response()->json(['error' => 'Password lama salah'], 400);
        }
    }

    public function changeAvatar(Request $request){
        $id = Auth::id();
        $user = UserDetails::where(['user_id' => $id])->first();

        $upload_path = 'storage';

        try {
            if ($request->hasFile('foto')) {
                
                if ($request->file('foto')->isValid()) {

                    // hapus foto lama
                    if($user->foto != null){
                        $localFileName = str_replace('/storage/','',$user->foto);
                        $exists = Storage::disk('public')->has($localFileName);

                        if($exists){
                            Storage::disk('public')->delete($localFileName);
                        }
                    }

                    $ext = $request->foto->extension();
                    $filename = time().'.'.$ext;
                    
                    $request->foto->storeAs('/public', $filename);
                    $url = Storage::url($filename);
                    $user->update(['foto' => $url]);

                    return response()->json([
                        'message' => 'Foto berhasil diperbarui'
                    ], 201);
                }else{
                    return response()->json([
                        'message' => 'File tidak valid'
                    ], 400);
                }
            }else{
                return response()->json([
                    'message' => 'File tidak ditemukan'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function login(Request $request){

        try {

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {

                $user = User::where('email', $request->email)->first();
                Session::put('auth', $user);
                
                return response()->json([
                    'message' => 'Login has been succesful'
                ], 201);
            }else{
                return response()->json([
                    'message' => 'Failed to login'
                ], 400);
            };
            

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to login'
            ], 400);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
