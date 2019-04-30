<?php

namespace App\Http\Controllers;

use App\Encounters\MonsterToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class MonsterTokenController extends Controller
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
        return view('monster_tokens.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monster_tokens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(),
            [
                'name' => 'required|max:255',
                'token_type' => ['required',Rule::in(
                    [
                        MonsterToken::$TOKEN_TYPE_NUMBER,
                        MonsterToken::$TOKEN_TYPE_COLOR,
                        MonsterToken::$TOKEN_TYPE_COLORED_NUMBER,
                        MonsterToken::$TOKEN_TYPE_MINI,
                    ])]
            ]
        );
        $v->sometimes('token_number', 'required|numeric', function($input)
        {
           return ($input->token_type ==  MonsterToken::$TOKEN_TYPE_NUMBER || $input->token_type ==  MonsterToken::$TOKEN_TYPE_COLORED_NUMBER);
        });
        $v->sometimes('token_color', 'required', function($input)
        {
            return ($input->token_type ==  MonsterToken::$TOKEN_TYPE_COLOR || $input->token_type ==  MonsterToken::$TOKEN_TYPE_COLORED_NUMBER);
        });
        $data = $v->validate();
        $token = new MonsterToken();
        $token->fill($data);
    
        $file = $request->file('portrait');
        if($file && $data['token_type'] == MonsterToken::$TOKEN_TYPE_MINI)
        {
            $image = Image::make($file->getRealPath());
            $image->widen(64);
            $image->crop(64, 64);
            $token->mini = $image->encode('png');
        }
        $request->user()->monsterTokens()->save($token);
        return redirect()->route('monster_tokens.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $token = MonsterToken::findOrFail($id);
        if($token->user_id != $request->user()->id)
            return abort(404, "Permission denied");
        if($token->token_type == MonsterToken::$TOKEN_TYPE_MINI)
            return $token->mini;
        else
        {
            $color = ($token->token_type == MonsterToken::$TOKEN_TYPE_NUMBER)? '#fff': $token->token_color;
            $img = Image::canvas('32', '32', $color);
            if($token->token_type != MonsterToken::$TOKEN_TYPE_COLOR)
            {
                $img->text($token->token_number, 15, 15, function($font)
                {
                    $font->file(5);
                    $font->size(12);
                    $font->color('#000');
                    $font->align('center');  //left, right or center.
                    $font->valign('middle');    //top, bottom or middle.
                });
            }
            return $img->response('png');
        }
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $token = MonsterToken::findOrFail($id);
        return view('monster_tokens.edit', compact('token'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $token = MonsterToken::findOrFail($id);
        $v = Validator::make($request->all(),
                             [
                                 'name' => 'required|max:255',
                                 'token_type' => ['required',Rule::in(
                                     [
                                         MonsterToken::$TOKEN_TYPE_NUMBER,
                                         MonsterToken::$TOKEN_TYPE_COLOR,
                                         MonsterToken::$TOKEN_TYPE_COLORED_NUMBER,
                                         MonsterToken::$TOKEN_TYPE_MINI,
                                     ])]
                             ]
        );
        $v->sometimes('token_number', 'required|numeric', function($input)
        {
            return ($input->token_type ==  MonsterToken::$TOKEN_TYPE_NUMBER || $input->token_type ==  MonsterToken::$TOKEN_TYPE_COLORED_NUMBER);
        });
        $v->sometimes('token_color', 'required', function($input)
        {
            return ($input->token_type ==  MonsterToken::$TOKEN_TYPE_COLOR || $input->token_type ==  MonsterToken::$TOKEN_TYPE_COLORED_NUMBER);
        });
        $data = $v->validate();
        $token->fill($data);
    
        $file = $request->file('portrait');
        if($file && $data['token_type'] == MonsterToken::$TOKEN_TYPE_MINI)
        {
            $image = Image::make($file->getRealPath());
            $image->widen(64);
            $image->crop(64, 64);
            $token->mini = $image->encode('png');
        }
        $request->user()->monsterTokens()->save($token);
        return redirect()->route('monster_tokens.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $token = MonsterToken::findOrFail($id);
        $token->delete();
        return view('monster_tokens.index');
    }
    
    public function tokensList(Request $request)
    {
        $tokens = MonsterToken::where('user_id', '=', $request->user()->id);
        return Datatables::of($tokens)->make(true);
    }
}
