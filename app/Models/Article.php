<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image', 'slug'];

    protected $casts = [
        'published_at' => 'date'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function state(): HasOne
    {
        return $this->hasOne(State::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getBodyPreview()
    {
        return Str::limit($this->body, 100);
    }

    public function scopeLastLimit($query, $number)
    {
        return $query->with('state', 'tags')->orderBy('created_at', 'desc')->limit($number)->get();
    }

    public function scopeAllPaginate($query, $number)
    {
        return $query->with('state', 'tags')->orderBy('created_at', 'desc')->paginate($number);
    }

    public function scopeFindBySlug($query, $slug)
    {
        return $query->with('comments', 'state', 'tags')->where('slug', $slug)->firstOrFail();
    }


}
