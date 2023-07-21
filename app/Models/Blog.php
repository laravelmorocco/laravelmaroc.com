<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Blog extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id',
        'title',
        'slug',
        'status',
        'featured',
        'language_id',
    ];

    public $timestamps = false;

    protected $filterable = [
        'id',
        'title',
        'slug',
        'status',
        'featured',
        'language_id',
    ];

    protected $fillable = [
        'title',
        'description',
        'image',
        'slug',
        'status',
        'featured',
        'meta_title',
        'meta_description',
        'language_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'satuts' => Status::class,
    ];

    public function scopeActive($query): void
    {
        $query->where('status', true);
    }
}
