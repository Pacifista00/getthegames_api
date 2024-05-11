<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showUser(){
        $user = new UserResource(User::find(Auth::user()->id));
        return response()->json([
            "data" => $user
        ]);
    }
    public function shows(){
        $users = UserResource::collection(User::all());
        return response()->json([
            "data" => $users
        ]);
    }
    public function show($id){
        $user = new UserResource(User::find($id));
        return response()->json([
            "data" => $user
        ]);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:64',
            'username' => 'required|max:24',
            'email' => 'required',
            'bio' => 'max:254',
            'image' => 'image|file|max:1024',
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                "data" => [
                    "message" => "User not found!"
                ]
            ]);
        }       
        if(Auth::user()->id != $user->id) {
            return response()->json([
                "data" => [
                    "message" => "You do not own this account!"
                ]
            ]);
        }else{
            $dataRequest = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ];

            if($request->hasFile('image')){
                $previousImagePath = $user->image_path;
                if ($previousImagePath != 'profile_pictures/profile.jpg') {
                    Storage::delete($previousImagePath);
                }
                $dataRequest['image_path'] = $request->file('image')->store('profile_pictures');
            }
            if($request->has('bio')){
                $dataRequest['bio'] = $request->bio;
            }

            $user->update($dataRequest);

            return response()->json([
                "data" => [
                    "message" => "User data updated!"
                ]
            ]);
            
        }
    }

    public function destroy($id){
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                "data" => [
                    "message" => "User not found!"
                ]
            ]);
        }
        if(Auth::user()->id != $user->id){
            return response()->json([
                "data" => [
                    "message" => "You do not own this account!"
                ]
            ]);
        }

        if ($user->image_path != 'profile_pictures/profile.jpg') {
            Storage::delete($user->image_path);
        }
        
        $user->delete();
        return response()->json([
            "data" => [
                "message" => "User deleted!"
            ]
        ]);
    }
}
