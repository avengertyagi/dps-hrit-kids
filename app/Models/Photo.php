<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\{HasSlug, SlugOptions};

class Photo extends Model
{
    use HasSlug;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'thumbnail_image',
        'status'
    ];
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    /**
     * Get all of the photo images for the Photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photoImages()
    {
        return $this->hasMany(PhotoImage::class);
    }
}
