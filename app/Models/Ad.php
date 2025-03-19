<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ad extends Model implements HasMedia
{
    private string $title;
    private string $description;
    private int $externalId;
    private string $images;
    private string $url;
    private float $price;
    private int $user_id;
    private int $merchant_id;
    private string $categoryType1;
    private string $categoryType2;
    private string $categoryType3;
    private string $external_link;
    private string $last_view;

    private int $category_id;

    /*
    protected $attributes;
    */

    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
