<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

class Menu extends Model
{
    use HasFactory;

    private string $title;
    private string $link;
    private ?string $imageUrl;
    private bool $isActive;
    private integer $position;

    protected $fillable = [
        'title',
        'link',
        'image_url',
        'is_active',
        'position',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
