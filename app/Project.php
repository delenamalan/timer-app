<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
     * Get all of the time entries belonging to this project.
     */
    public function entries()
    {
        return $this->hasMany('App\Entry');
    }
}
