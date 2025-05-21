<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    use HasFactory;

    /**
     * A tömegesen feltölthető attribútumok.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    /**
     * A ProductType-hoz tartozó attribútumok lekérdezése.
     */
    public function attributes()
    {
        //return $this->hasMany(Attribute::class);
        return $this->belongsToMany(Attribute::class, 'attribute_product_type', 'product_type_id', 'attribute_id');
    }
}
