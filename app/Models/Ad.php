<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
    private string $external_link;
    private string $last_view;

    // add a seen count number, default to 0
    private int $seen_count = 0;

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

    public function getAdAttributeValueByAttributeSlug(string $key)
    {
        $attributes = json_decode($this->attributes['attributes'], true);

        return $attributes[$key] ?? null;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->width(400)
            ->height(400)
            ->nonQueued()
        ;
        $this->addMediaConversion('medium')
            ->width(800)
            ->height(800)
            ->nonQueued()
        ;
        $this->addMediaConversion('large')
            ->width(1600)
            ->height(1600)
            ->nonQueued()
        ;
    }

}
