<?php

namespace App\Models;

use App\Http\Controllers\BookController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books
 * @property-read int|null $books_count
 * @property string|null $photo_path
 * @method static \Illuminate\Database\Eloquent\Builder|Category wherePhotoPath($value)
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    public function books() :BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] =  strtolower($value);
    }

}
