<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Resources\GenreResource;

class GenreController extends Controller
{
    public function show(){
        $genres = GenreResource::collection(Genre::all());
        return response()->json([
            "data" => $genres
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:games|max:24',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);

        return response()->json([
            "data" => [
                "message" => "Genre added!"
            ]
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:games|max:24',
        ]);

        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json([
                "data" => [
                    "message" => "Genre not found!"
                ]
            ]);
        }

        $genre->update([
            'name' => $request->name,
        ]);

        return response()->json([
            "data" => [
                "message" => "Genre updated!"
            ]
        ]);
    }
    
    public function destroy($id){
        $genre = Genre::find($id);

        if ($genre) {
            $genre->delete();
            return response()->json([
                "data" => [
                    "message" => "Genre deleted!"
                ]
            ]);
        } else {
            return response()->json([
                "data" => [
                    "message" => "Genre not found!"
                ]
            ]);
        }
    }
}
