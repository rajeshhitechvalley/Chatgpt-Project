<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'icon',
        'title',
        'slug',
        'category',
        'description',
        'plays',
        'rating',
        'status',
        'thumbnail',
        'url'
    ];

    protected $casts = [
        'plays' => 'integer',
        'rating' => 'decimal:1',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Automatically generate slug from title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($game) {
            if (empty($game->slug)) {
                $game->slug = Str::slug($game->title);
            }
        });

        static::updating(function ($game) {
            if ($game->isDirty('title')) {
                $game->slug = Str::slug($game->title);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('plays', 'desc');
    }

    public function scopeTopRated($query)
    {
        return $query->orderBy('rating', 'desc');
    }

    // Accessors
    public function getFormattedPlaysAttribute()
    {
        if ($this->plays >= 1000000) {
            return number_format($this->plays / 1000000, 1) . 'M';
        } elseif ($this->plays >= 1000) {
            return number_format($this->plays / 1000, 1) . 'K';
        }
        return $this->plays;
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status === 'active' 
            ? '<span class="badge bg-success">Active</span>' 
            : '<span class="badge bg-danger">Inactive</span>';
    }
}