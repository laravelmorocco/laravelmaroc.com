<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Page extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id', 'title', 'slug', 'language_id',
    ];

    protected $filterable = [
        'id', 'title', 'slug', 'language_id',
    ];

    protected $fillable = [
        'title', 'slug', 'description', 'meta_title', 'meta_description', 'language_id', 'image', 'status',
    ];

    protected $casts = [
        'satuts' => Status::class,
    ];

    public function scopeActive($query): void
    {
        $query->where('status', true);
    }
}
