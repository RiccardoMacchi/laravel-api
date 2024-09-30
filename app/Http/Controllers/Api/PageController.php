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
        return response()->json(compact('success','technologies'));
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

    public function itemBySlug($slug){
        $item = Item::where('slug', $slug)->with('technologies','type')->first();
        if($item){
            $success = true;
            if($item->img_path){
                $item->img_path = asset('storage/' . $item->img_path);
            } else {
                $item->img_path = '/placeholder_img.jpg';
                $item->original_img_name = 'No image';
            }
        } else{
            $success = false;

        }

        return response()->json(compact('success','item'));
    }

    public function listByType($slug){
        $type = Type::where('slug', $slug)->with('items')->first();
        if($type){
            $success = true;
        } else{
            $success = false;
        }
        return response()->json(compact('success','type'));
    }

    public function listByTechnology($slug){
        $technology = Technology::where('slug', $slug)->with('items')->first();
        if($technology){
            $success = true;
        } else{
            $success = false;
        }
        return response()->json(compact('success','technology'));
    }

}
