<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Book
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $cover
 * @property string|null $custom
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUrl($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property string|null $cover_url
 * @property string|null $photo_path
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCoverUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePhotoPath($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    use HasFactory;

    public function categories() :BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] =  strtolower($value);
    }
    public function setCoverAttribute($value)
    {
        $this->attributes['cover'] =  strtolower($value);
    }
}
