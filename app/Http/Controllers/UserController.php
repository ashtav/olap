<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;

class UserController extends Controller
{
    public function index(){
        $users = User::with('detail')->latest()->get();
        return view('dashboard.pengguna', compact('users'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email|max:190|unique:users'
        ]);

        $input = $request->all();

        $input['email'] = strtolower($request->email);
        $input['password'] = app('hash')->make('secret');

        try {
            $user = User::create($input);

            $detail = $request->except(['email','level']);

            $detail['user_id'] = $user->id;
            $detail['nama'] = ucwords($request->nama);
            $detail['alamat'] = ucwords($request->alamat);

            UserDetails::create($detail);

            return response()->json([
                'message' => 'Data berhasil ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'email' => 'required|email|max:190|unique:users,email,'. $id
        ]);

        $input = $request->all();

        $input['email'] = strtolower($request->email);
        // $input['password'] = app('hash')->make('secret');

        try {
            User::find($id)->update($input);

            $detail = $request->except(['email','level','_method']);
            $detail['nama'] = ucwords($request->nama);
            $detail['alamat'] = ucwords($request->alamat);

            UserDetails::where(['user_id' => $id])->update($detail);

            return response()->json([
                'message' => 'Data berhasil diperbarui'
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy($id){
        User::find($id)->delete();
        UserDetails::where(['user_id' => $id])->delete();
    }
}
