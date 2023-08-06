<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class FeaturedBanner extends Model
{
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id', 'title', 'status', 'language_id',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title', 'description', 'image', 'embeded_video', 'status', 'featured', 'link', 'language_id',
    ];

    protected $casts = [
        'satuts' => Status::class,
    ];

    public function scopeActive($query): void
    {
        $query->where('status', true);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
