<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper;

use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        $title = 'Gestisci tutti i tipi';
        return view('admin.types.index', compact('types', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        $exists = Type::where('name', $request->name)->first();
        if($exists == null){
            $data = $request->all();
            $new_type = new Type();
            $new_type->fill($data);
            $new_type->slug = Helper::generateSlug($new_type->name, Type::class);
            $new_type->save();
            return redirect()->route('admin.types.index')->with('success', 'Tipo creato con successo!');
        } else{
            return redirect()->route('admin.types.index')->with('error', 'Categoria già presente!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        // salviamo l'esistenza o meno del dato se null non esiste
        $exists = Type::where('name', $request->name)->first();
        if($exists == null){

            $data = $request->all();
            $data['slug'] = Helper::generateSlug($data['name'], Type::class);
            $type->update($data);

            return redirect()->route('admin.types.index')->with('success', 'Tipo modificato con successo!');
        } else{
            return redirect()->route('admin.types.index')->with('error', 'Categoria già presente!');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('sucess', 'Tipo eliminato con successo!');

    }

    public function itemsTypes(){
        $types = Type::all();

        return view('admin.types.itemsTypes', compact('types'));
    }
}
