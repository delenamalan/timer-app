<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'start', 'end', 'project_id'];

    /**
     * Get the project to which this time entry belongs.
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * Get the owner of this project.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
