<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioGroup extends Model
{
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(PortfolioItem::class);
    }
}
