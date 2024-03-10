<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;

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
            'developer' => 'required',
            'release_year' => 'required|integer',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);

        Console::create([
            'name' => $request->name,
            'developer' => $request->developer,
            'release_year' => $request->release_year,
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
            'name' => 'required|unique:consoles|max:24',
            'developer' => 'required',
            'release_year' => 'required|integer',
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

        $console->update([
            'name' => $request->name,
            'developer' => $request->developer,
            'release_year' => $request->release_year,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return response()->json([
            "data" => [
                "message" => "Console updated!"
            ]
        ]);
    }
    
    public function destroy($id){
        $console = Console::find($id);

        if ($console) {
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
