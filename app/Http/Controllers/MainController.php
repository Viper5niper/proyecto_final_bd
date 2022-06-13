<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vuelo;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vuelos = Vuelo::paginate(16);

        return view('vuelo.index', compact('vuelos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vuelo.create', ['Vuelo' => new Vuelo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SaveVueloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveVueloRequest $request)
    {
        $validated = $request->validated();

        Vuelo::create($validated);

        return redirect()->route('Vuelo')
            ->with('message', 'Vuelo creado.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vuelo $Vuelo)
    {
        return view('vuelo.show', $Vuelo->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Vuelo  $Vuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vuelo $Vuelo)
    {
        return view('vuelo.edit', ['Vuelo' => $Vuelo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SaveVueloRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveVueloRequest $request, $id)
    {
        $validated = $request->validated();

        $Vuelo = Vuelo::find($id)->update($validated);

        return redirect()->route('Vuelo')
            ->with('message', 'Informacion editada.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vuelo::findOrFail($id)->delete();
        return redirect()->route('Vuelo')
            ->with('message', 'Vuelo eliminado.')
            ->with('status', 'success');
    }
}
