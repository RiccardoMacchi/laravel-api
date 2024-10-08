<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Type;
use App\Models\Technology;
use App\Models\Framework;


use Illuminate\Support\Facades\Storage;


class PageController extends Controller
{
    public function index(){

        if(isset($_GET['search'])){
            $items = Item::where('title', 'LIKE', '%' . $_GET['search'] . '%')->orderBy('title')->with('technologies', 'type','frameworks')->paginate(10);
        }else{
            $items = Item::orderBy('title')->with('technologies', 'type','frameworks')->paginate(10);
        }


        if($items){
            $success = true;
            foreach($items as $item){
                if($item->img_path){
                    $item->img_path = Storage::url($item->img_path);
                } else {
                    $item->img_path = Storage::url('placeholder_img.jpg');
                    $item->original_img_name = 'No image';
                }
            }
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
        return response()->json(compact('success','types'));
    }

    public function allFrameworks(){
        $frameworks = Framework::all();
        if($frameworks){
            $success = true;
        } else{
            $success = false;
        }
        return response()->json(compact('success','frameworks'));

    }


    public function itemBySlug($slug){
        $item = Item::where('slug', $slug)->with('technologies','type','frameworks')->first();
        if($item){
            $success = true;
            if($item->img_path){
                $item->img_path = Storage::url($item->img_path);
            } else {
                $item->img_path = Storage::url('placeholder_img.jpg');
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

    public function listByFramework($slug){
        $framework = Framework::where('slug', $slug)->with('items')->first();
        if($framework){
            $success = true;
        } else{
            $success = false;
        }
        return response()->json(compact('success','framework'));
    }

}
