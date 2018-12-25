<?php

namespace App;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Cpu;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\System;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'description',
        'image',
        'cost',
        'quantity',
        'rate',
        'views',
        'name',
        'sold',
        'ram_id',
        'system_id',
        'cpu_id',
        'storage_id',
        'screen_size',
        'weight',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cpu()
    {
        return $this->belongsTo(Cpu::class);
    }

    public function ram()
    {
        return $this->belongsTo(Ram::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
    }
}
