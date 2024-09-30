<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Type;
use App\Models\Technology;
use App\Functions\Helper;
use App\Http\Requests\ItemRequest;

// Storage
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'I miei Lavori';
        // Controllo per effettuare la ricerca
        if(isset($_GET['search'])){
            $items = Item::where('title', 'LIKE', '%' . $_GET['search'] . '%')->orderBy('title')->paginate(10);
            $items->appends(request()->query());

            return view('admin.items.index', compact('items','title'));
        }

        // Controllo per ordinamento
        $direction = 'asc';
        if(isset($_GET['direction']) && isset($_GET['column'])){
            $direction = $_GET['direction'] == 'asc' ? 'desc' : 'asc';
            $column = $_GET['column'];
            $items = Item::orderBy($column, $direction)->paginate(10);
            $items->appends(request()->query());
            return view('admin.items.index', compact('items','title','direction'));
        }

;       $items = Item::orderBy('title')->paginate(10);
        return view('admin.items.index', compact('items','title','direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Aggiungi un nuovo lavoro';
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.items.create', compact('title','types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->all();
        // dd($data);
        $data['slug'] = Helper::generateSlug($data['title'], Item::class);
        $new_item = new Item();

        if(array_key_exists('img_path',$data)){
            $img_path = Storage::put('uploads',$data['img_path']);
            $img_name = $request->file('img_path')->getClientOriginalName();
            $data['img_path'] = $img_path;
            $data['original_img_name'] = $img_name;
        }

        $new_item->fill($data);

        $new_item->save();
        if(array_key_exists('technologies', $data)){
            // aggiunta dei vari tag alla nuova istanza
            $new_item->technologies()->attach($data['technologies']);
        }


        return redirect()->route('admin.items.show', $new_item->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        return view('admin.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);
        $technologies = Technology::all();
        $types = Type::all();
        $title = 'Stai modificando ' . $item->title;
        return view('admin.items.edit', compact('item','title','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        $data = $request->all();
        $item = Item::find($id);
        if($item->title != $data['title']){
            $data['slug'] = Helper::generateSlug($data['title'], Item::class);
        }

        if(array_key_exists('img_path',$data)){
            // Canello la vecchia immagine
            if($item->img_path){
                Storage::delete($item->img_path);
            }

            // Aggiunngi l'immagine
            $img_path = Storage::put('uploads',$data['img_path']);
            // Salvo il nome
            $img_name = $request->file('img_path')->getClientOriginalName();
            // Assegnamo le variabili all'istanza
            $data['img_path'] = $img_path;
            $data['original_img_name'] = $img_name;
        }

        $item->update($data);
        if(array_key_exists('technologies', $data)){
            $item->technologies()->sync($data['technologies']);
        } else{
            $item->technologies()->detach();
        }

        return redirect()->route('admin.items.show', $item);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if($item->img_path){
            Storage::delete($item->img_path);
        }
        $item->delete();
        return redirect()->route('admin.items.index');
    }

    // Mie funzioni

    public function deleteImg(Item $item)
    {
        if($item->img_path){
            Storage::delete($item->img_path);
            return redirect()->route('admin.items.index');
        }
    }
}
