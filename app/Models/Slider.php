<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Slider extends Model
{
    use HasAdvancedFilter;

    public $table = 'sliders';

    public const ATTRIBUTES = [
        'id', 'title', 'status', 'language_id',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title', 'subtitle', 'description', 'embeded_video', 'image', 'featured', 'link', 'language_id', 'bg_color', 'status',
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

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
