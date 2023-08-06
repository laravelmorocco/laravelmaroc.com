<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Language extends Model
{
    use HasAdvancedFilter;

    public $table = 'languages';

    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 0;

    public const IS_DEFAULT = 1;

    public const IS_NOT_DEFAULT = 0;

    public const ATTRIBUTES = [
        'id',
        'name',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'code',
        'status',
        'is_default',
    ];
}
