<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Type;
use App\Models\Technology;


class PageController extends Controller
{
    public function index(){
        $items = Item::orderBy('id')->with('technologies', 'type')->get();


        if($items){
            $success = true;
        }else{
            $success = false;
        }
        $response = [
            'success'=> $success,
            'data' => $items
        ];


        return response()->json($response);
    }

    public function allTechnologies(){
        $technologies = Technology::all();
        if($technologies){
            $success = true;
        } else{
            $success = false;
        }
        return response()->json($technologies);
    }

    public function allTypes(){
        $types = Type::all();
        if($types){
            $success = true;
        } else{
            $success = false;
        }
        return response()->json($types);
    }


}
