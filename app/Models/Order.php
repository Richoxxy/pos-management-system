<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];
    // protected $guarded = [];


    public function customers(): HasMany {
        return $this->hasMany(Customer::class);
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class);
    }
}
