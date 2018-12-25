<?php

namespace App\Models;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ram extends Model
{
    //
    use SoftDeletes;
    protected $fillable=[
        'ram',
    ];

    protected $dates=[
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
