<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Get the projects associated with the team
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    /**
     * Get the owner of the team
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Team');
    }
}
