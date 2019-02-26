<?php

namespace App\Http\Controllers;

use App\Players\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\Datatables\Datatables;

class PlayerController extends Controller
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
    public function index(Request $request)
    {
        $players = $request->user()->players;
        return view('players.index', compact('players'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('players.create');
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
                'dci' => 'numeric|nullable',
                'portrait' => 'mimes:jpeg,bmp,png|nullable',
            ]
        );
        $player = new Player();
        $player->name = $data['name'];
        $player->dci = $data['dci'];
        $file = $request->file('portrait');
        if($file)
        {
	        $image = Image::make($file->getRealPath());
	        $image->widen(64);
	        $image->crop(64, 64);
            $player->portrait = $image->encode('png');
        }
        $request->user()->players()->save($player);
        return redirect()->route('players.index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Player $player)
    {
        if($player->user_id != $request->user()->id)
            return abort(404, "Permission denied");
        if(!$player->portrait)
            return Storage::disk('local')->get('unkn.png');
        return $player->portrait;
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Player $player)
    {
        return view('players.edit', compact('player'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'dci' => 'numeric|nullable',
                'portrait' => 'mimes:jpeg,bmp,png|nullable',
            ]
        );
        $player->name = $data['name'];
        $player->dci = $data['dci'];
        $file = $request->file('portrait');
        if($file)
        {
	        $image = Image::make($file->getRealPath());
	        $image->widen(64);
	        $image->crop(64, 64);
	        $player->portrait = $image->encode('png');
        }
        $player->save();
        return redirect()->route('players.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Player $player)
    {
        $player->delete();
        return redirect()->route('players.index');
    }
	
	public function playerList(Request $request)
	{
		$query = $request->user()->players()->select('name','dci','id');
		return Datatables::of($query)->make(true);
	}
	
 
 
}
