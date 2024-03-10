<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function show(){
        return response()->json([
            "data" => Game::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:games',
            'developer' => 'required',
            'release_year' => 'required|integer',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);

        Game::create([
            'name' => $request->name,
            'developer' => $request->developer,
            'release_year' => $request->release_year,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return response()->json([
            "data" => [
                "message" => "Game added!"
            ]
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:games',
            'developer' => 'required',
            'release_year' => 'required|integer',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);

        $game = Game::find($id);
        if (!$game) {
            return response()->json([
                "data" => [
                    "message" => "Game not found!"
                ]
            ]);
        }

        $game->update([
            'name' => $request->name,
            'developer' => $request->developer,
            'release_year' => $request->release_year,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return response()->json([
            "data" => [
                "message" => "Game updated!"
            ]
        ]);
    }
    
    public function destroy($id){
        $game = Game::find($id);

        if ($game) {
            $game->delete();
            return response()->json([
                "data" => [
                    "message" => "Game deleted!"
                ]
            ]);
        } else {
            return response()->json([
                "data" => [
                    "message" => "Game not found!"
                ]
            ]);
        }
    }
}
