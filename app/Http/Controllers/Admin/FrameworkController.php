<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Functions\Helper;

use App\Models\Framework;

use App\Http\Requests\FrameworkRequest;


class FrameworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frameworks = Framework::all();
        $title = 'Gestisci tutti i Frameworks e Librerie';

        return view('admin.frameworks.index', compact('frameworks', 'title'));
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
    public function store(FrameworkRequest $request)
    {
        $exists = Framework::where('name', $request->name)->first();
        if($exists == null){

            $data = $request->all();

            $new_framework = new Framework();
            $new_framework->name = $data['name'];
            $new_framework->slug = Helper::generateSlug($data['name'], Framework::class);
            $new_framework->save();

            return redirect()->route('admin.frameworks.index')->with('success','Framework creato con successo!');
        } else{
            return redirect()->route('admin.frameworks.index')->with('error','Framework già presente!');

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
    public function update(FrameworkRequest $request, Framework $framework)
    {
        $exists = Framework::where('name', $request->name)->first();
        if($exists == null){

            $data = $request->all();
            $data['slug'] = Helper::generateSlug($data['name'], Framework::class);
            $framework->update($data);

            return redirect()->route('admin.frameworks.index')->with('success','Framework modificato con successo!');

        }else{
            return redirect()->route('admin.frameworks.index')->with('error','Framework già presente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Framework $framework)
    {
        $framework->delete();

        return redirect()->route('admin.frameworks.index')->with('success','Framework eliminato con successo!');
    }
}
