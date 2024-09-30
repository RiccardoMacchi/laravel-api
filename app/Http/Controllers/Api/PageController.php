<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;

class PageController extends Controller
{
    public function index(){
        $items = Item::orderBy('id')->with('technologies', 'type')->get();

        return response()->json($items);
    }
}
