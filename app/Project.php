<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Gets the associated team to the project
     *
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
