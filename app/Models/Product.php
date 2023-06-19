<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'photo',
        'price',
        'type'        
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}