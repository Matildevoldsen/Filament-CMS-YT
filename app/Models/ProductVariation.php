<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ProductVariation extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasRecursiveRelationships;

    protected $fillable = [
        'order',
        'parent_id',
        'title',
        'type',
        'price',
        'SKU'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($variation) {
            $variation->order = ProductVariation::where('product_id', $variation->product_id)->max('order') + 1;
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class, 'parent_id');
    }
}
