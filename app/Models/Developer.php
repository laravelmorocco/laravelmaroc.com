<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Developer extends Model
{
    use HasAdvancedFilter;
    use HasFactory;

    public $table = 'developers';

    public const ATTRIBUTES = [
        'id',
        'name',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'id',
        'name',
        'image',
        'link',
        'content',
        'status',
        'language_id',
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
