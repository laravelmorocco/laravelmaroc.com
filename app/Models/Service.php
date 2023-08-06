<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasAdvancedFilter;
    use HasFactory;

    public const ATTRIBUTES = [
        'id',
        'title',
        'status',
        'type',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title',
        'image',
        'content',
        'features',
        'options',
        'slug',
        'status',
        'language_id',
        'type',
    ];

    protected $casts = [
        'options'  => 'json',
        'features' => 'json',
        'satuts'   => Status::class,
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
        return $this->belongsTo(Language::class);
    }
}
