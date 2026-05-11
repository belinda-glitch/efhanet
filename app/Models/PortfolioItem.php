<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    protected $fillable = ['portfolio_group_id', 'project_name', 'scope_of_work'];

    public function group()
    {
        return $this->belongsTo(PortfolioGroup::class, 'portfolio_group_id');
    }
}
