<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'date','image', 'text', 'description', 'posted', 'type', 'category_id'];

    public function category() {
        return $this->BelongsTo(Category::class);
    }

    public function tags() {
        return $this->morphToMany(Tag::class, 'taggables');
    }

}
