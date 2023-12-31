<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'description',
        'price_cost',
    ];

    //RELATIONSHIPS
    //Many products are in many orders
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
