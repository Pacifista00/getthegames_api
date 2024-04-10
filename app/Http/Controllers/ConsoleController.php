<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;
use Illuminate\Support\Facades\Storage;

class ConsoleController extends Controller
{
    public function show(){
        return response()->json([
            "data" => Console::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:consoles|max:24',
            'image' => 'required|image|file|max:1024',
            'developer' => 'required',
            'release_year' => 'required|integer',
            'description' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);

        Console::create([
            'name' => $request->name,
            'image_path' => $request->file('image')->store('console_images'),
            'developer' => $request->developer,
            'release_year' => $request->release_year,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return response()->json([
            "data" => [
                "message" => "Console added!"
            ]
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:24',
            'image' => 'image|file|max:1024',
            'developer' => 'required',
            'release_year' => 'required|integer',
            'description' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);

        $console = Console::find($id);
        if (!$console) {
            return response()->json([
                "data" => [
                    "message" => "Console not found!"
                ]
            ]);
        }

        $dataRequest = [
            'name' => $request->name,
            'developer' => $request->developer,
            'release_year' => $request->release_year,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
        ];

        if(!$request->hasFile('image')){
            $dataRequest['image_path'] = $console->image_path;
        }else{
            Storage::delete($console->image_path);
            $dataRequest['image_path'] = $request->file('image')->store('console_images');
        }

        $console->update($dataRequest);

        return response()->json([
            "data" => [
                "message" => "Console updated!"
            ]
        ]);
    }
    
    public function destroy($id){
        $console = Console::find($id);

        if ($console) {
            Storage::delete($console->image_path);
            $console->delete();
            return response()->json([
                "data" => [
                    "message" => "Console deleted!"
                ]
            ]);
        } else {
            return response()->json([
                "data" => [
                    "message" => "Console not found!"
                ]
            ]);
        }
    }
}
