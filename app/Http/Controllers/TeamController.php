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

        if (!empty($user)) {
            $teams = $user->teams;
            return array('success' => true, 'teams' => $teams);
        } else {
            return array('success' => false, 'message' => 'No user currently authenticated.');
        }
    }

    /**
     * Creates new team
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $user = Auth::user();
        $team = new Team;
        $team->title = $request->title;
        $team->description = $request->description;
        $team->user_id = $user->id;
        $team->save();

    }
}
