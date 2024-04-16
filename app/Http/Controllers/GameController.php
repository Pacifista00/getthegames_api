<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\GameResource;

class GameController extends Controller
{
    public function show($id){
        $game = Game::find($id);
        if (!$game) {
        return response()->json([
            "data" => [
                "message" => "Game not found!"
                ]
            ]);
        }
        $gameData = new GameResource($game);
        return response()->json([
            "data" => $gameData
        ]);
    }
    
    public function shows(){
        $games = GameResource::collection(Game::all());
        return response()->json([
            "data" => $games
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:games',
            'image' => 'required|image|file|max:1024',
            'publisher' => 'required',
            'description' => 'required',
            'release_year' => 'required|integer',
            'console_id' => 'required|integer|exists:consoles,id',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'genre' => 'required|array',
            'genre.*' => 'integer|exists:genres,id'
        ]);

        $game = Game::create([
            'name' => $request->name,
            'image_path' => $request->file('image')->store('game_images'),
            'description' => $request->description,
            'publisher' => $request->publisher,
            'release_year' => $request->release_year,
            'console_id' => $request->console_id,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        $newGame = Game::find($game->id);
        $newGame->genres()->attach($request->genre);

        return response()->json([
            "data" => [
                "message" => "Game added!"
            ]
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'image' => 'image|file|max:1024',
            'publisher' => 'required',
            'description' => 'required',
            'release_year' => 'required|integer',
            'console_id' => 'required|integer|exists:consoles,id',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'genre' => 'required|array',
            'genre.*' => 'integer|exists:genres,id'
        ]);

        $game = Game::find($id);
        if (!$game) {
            return response()->json([
                "data" => [
                    "message" => "Game not found!"
                ]
            ]);
        }

        $dataRequest =  [
            'name' => $request->name,
            'publisher' => $request->publisher,
            'description' => $request->description,
            'release_year' => $request->release_year,
            'console_id' => $request->console_id,
            'stock' => $request->stock,
            'price' => $request->price,
        ];

        if(!$request->hasFile('image')){
            $dataRequest['image_path'] = $game->image_path;
        }else{
            Storage::delete($game->image_path);
            $dataRequest['image_path'] = $request->file('image')->store('game_images');
        }

        $game->update($dataRequest);
        $game->genres()->sync($request->genre);

        return response()->json([
            "data" => [
                "message" => "Game updated!"
            ]
        ]);
    }
    
    public function destroy($id){
        $game = Game::find($id);

        if ($game) {
            Storage::delete($game->image_path);
            $game->genres()->detach();
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
