<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birthdate',
        'address',
        'address_complement',
        'district',
        'zipcode',
        'code'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}