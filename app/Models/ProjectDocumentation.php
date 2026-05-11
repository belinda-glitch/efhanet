<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDocumentation extends Model
{
    protected $fillable = [
        'project_id',
        'file_path',
        'thumbnail_path',
        'caption',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
