<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Section extends Model
{
    use HasAdvancedFilter;

    public $table = 'sections';

    public const ATTRIBUTES = [
        'id',
        'title',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'language_id',
        'page_id',
        'title',
        'featured_title',
        'subtitle',
        'text',
        'main_color',
        'button',
        'position',
        'label',
        'link',
        'description',
        'embeded_video',
        'status',
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
        return $this->belongsTo(Language::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
