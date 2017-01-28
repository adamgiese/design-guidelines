<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{

    /** 
     * Return all Teams associated with currently authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        $teams = $user->teams;
        return $teams;
    }

    /**
     * Creates new team
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $user = Auth::user();
        $team = new Team;
        $team->title = $request->title;
        $team->description = $request->description;
        $team->user_id = $user->id;
        $team->save();

    }
}
