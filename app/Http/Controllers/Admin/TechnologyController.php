<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Functions\Helper;
use App\Models\Technology;

use App\Http\Requests\TechnologyRequest;


class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Gestione Tecnologie';
        $techs = Technology::all();
        return view('admin.techs.index', compact('techs','title'));
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
    public function store(TechnologyRequest $request)
    {
        $data = $request->all();
        $new_tech = new Technology();
        $new_tech->name = $data['name'];
        $new_tech->slug = Helper::generateSlug($data['name'], Technology::class);
        $new_tech->save();

        return redirect()->route('admin.techs.index')->with('success','Tecnologia creata con successo!');

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
    public function edit(Technology $tech)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TechnologyRequest $request, Technology $tech)
    {
        $exists = Technology::where('name', $request->name)->first();
        if($exists == null){

            $data = $request->all();
            $data['slug'] = Helper::generateSlug($data['name'], Technology::class);
            $tech->update($data);

            return redirect()->route('admin.techs.index')->with('success','Tecnologia modificata con successo!');

        }else{
            return redirect()->route('admin.techs.index')->with('error','Tecnologia già presente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $tech)
    {
        $tech->delete();
        return redirect()->route('admin.techs.index')->with('success','Tecnologia eliminata con successo!');

    }
}
