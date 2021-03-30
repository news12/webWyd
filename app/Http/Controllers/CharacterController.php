<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\CharacterRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index (CharacterRepositoryInterface $model)
    {
        $characters = $model->all();
        return view('panel.character.index')->with('characters', $characters);
    }

    public function listCharacter(CharacterRepositoryInterface $model)
    {
        $loggedId = intval(Auth::id());
        $characters = $model->getCharacter(['*'], [ 'accountID' => $loggedId]);


        return view('panel.character.listCharacter')->with('characters', $characters);

    }
}