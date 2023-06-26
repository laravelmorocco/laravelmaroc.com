<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasAdvancedFilter;

    public const BCATEGORY_ACITVE = 1;
    public const BCATEGORY_INACTIVE = 0;

    public $orderable = [
        'id',
        'name',
        'status',
        'language_id',
    ];

    public $filterable = [
        'id',
        'name',
        'status',
        'language_id',
    ];

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'meta_tag',
        'meta_description',
        'featured',
        'language_id',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }
}
