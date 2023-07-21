<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\Status;

class Project extends Model
{
    use HasAdvancedFilter;
    use HasFactory;

    public $table = 'projects';

    public const ATTRIBUTES = [
        'id', 'title', 'status', 'slug',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'id', 'title', 'status', 'slug',
        'image', 'service_id', 'content', 'meta_title',
        'meta_description', 'gallery', 'link', 'language_id',
        'user_id',
    ];

    protected $casts = [
        'satuts' => Status::class,
    ];

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', true);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Tutorial::class, 'service_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
