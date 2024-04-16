<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Basket;
use App\Models\Game;
use App\Models\Console;

class BasketController extends Controller
{
    public function show(){
        $baskets = Basket::with('product')->get();

        return response()->json([
            "data" => $baskets
        ]);
    }
    public function showUserBasket(){
        $userid = Auth::user()->id;
        $baskets = Basket::with('product')->where('user_id', $userid)->get();

        return response()->json([
            "data" => $baskets
        ]);
    }
    public function consoleStore(Request $request){
        $userid = Auth::user()->id;

        $request->validate([
            'console_id' => 'required',
            'quantity' => 'required|integer',
        ]);

        $console = Console::find($request->console_id);

        Basket::create([
            'user_id' => $userid,
            'product_id' => $request->console_id,
            'product_type' => Console::class,
            'image_path' => $console->image_path,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            "data" => [
                "message" => "Basket added!"
            ]
        ]);
    }
    public function gameStore(Request $request){
        $userid = Auth::user()->id;

        $request->validate([
            'game_id' => 'required',
            'quantity' => 'required|integer',
        ]);

        $game = Game::find($request->game_id);

        Basket::create([
            'user_id' => $userid,
            'product_id' => $request->game_id,
            'product_type' => Game::class,
            'image_path' => $game->image_path,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            "data" => [
                "message" => "Basket added!"
            ]
        ]);
    }
    public function basketUpdate(Request $request, $id){
        $userid = Auth::user()->id;
        $basket = Basket::find($id);
        if($userid !== $basket->user_id){
            return response()->json([
                "message" => "You are not the owner of the basket!"
            ]);
        }

        $request->validate([
            'quantity' => 'required|integer',
        ]);

        if(!$basket){
            return response()->json([
                "message" => "Basket not found!"
            ]);
        }

        $basket->update([
            'user_id' => $basket->user_id,
            'product_id' => $basket->product_id,
            'product_type' => $basket->product_type,
            'image_path' => $basket->image_path,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            "data" => [
                "message" => "Basket updated!"
            ]
        ]);
    }
    public function destroy($id){
        $basket = Basket::find($id);
        $userid = Auth::user()->id;

        if ($basket) {
            if($basket["user_id"] != $userid){
                return response()->json([
                    "data" => [
                        "message" => "You are not the owner of the basket!"
                    ]
                ]);
            }

            $basket->delete();
            return response()->json([
                "data" => [
                    "message" => "Basket deleted!"
                ]
            ]);
        } else {
            return response()->json([
                "data" => [
                    "message" => "Basket not found!"
                ]
            ]);
        }
    }
}
