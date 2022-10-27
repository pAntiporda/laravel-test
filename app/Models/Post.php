<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
    ];

    protected $with = ['category', 'author'];

    // Query scope. Syntax is scopeName: (parameters). $query is implicitly passed to the scope.
    // Accessible via filter() method.
    public function scopeFilter($query, array $filters)
    {
        // Chained function. Only call the function WHEN the first argument is true
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
        $query->where(fn ($query) =>
        $query
            ->where('title', 'like', "%{$search}%")
            ->orWhere('body', 'like', "%{$search}%")));

        $query->when($filters['category'] ?? false, fn ($query, $category) =>
        $query->whereHas('category', fn ($query) =>
        $query->where('slug', $category)));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        // The belongsTo method can accept a second argument to specify the foreign key name. In this use case, since it makes more sense to call the user
        // associated with a Post an 'author', we call the method to get the user associated with the Post 'author' but use the 'user_id' as the foreign key.
        return $this->belongsTo(User::class, 'user_id');
    }
}
