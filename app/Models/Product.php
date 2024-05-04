<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','name', 'description','price'];

    protected function casts(): array
    {
        return [
            'price' => 'float',
        ];
    }

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
