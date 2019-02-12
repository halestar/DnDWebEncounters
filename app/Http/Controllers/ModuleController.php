<?php

namespace App\Http\Controllers;

use App\Encounters\Encounter;
use App\Encounters\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ModuleController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'nullable',
                'tier' => 'required|numeric|min:0|max:4',
                'optimized_level' => 'required|numeric|min:1|max:20',
                'encounters' => 'nullable|array'
            ]
        );
        
        $module = new Module();
        $module->fill($data);
        $request->user()->modules()->save($module);
        $module->encounters()->sync($data['encounters']);
        
        return view('modules.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'nullable',
                'tier' => 'required|numeric|min:0|max:4',
                'optimized_level' => 'required|numeric|min:1|max:20',
                'encounters' => 'nullable|array'
            ]
        );
    
        $module->fill($data);
        $module->save();
        $module->encounters()->sync($data['encounters']);
    
        return view('modules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.index');
    }
    
    public function moduleList(Request $request)
    {
        $modules = Module::where('modules.user_id', '=', $request->user()->id);
        return Datatables::of($modules)->make(true);
    }
    
    public function encounterList(Request $request)
    {
        $encounters = Encounter::where('encounters.user_id', '=', $request->user()->id)->get();
        return response()->json($encounters, 200);
    }
}
