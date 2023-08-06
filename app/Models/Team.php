<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasAdvancedFilter;

    public $table = 'teams';

    public $orderable = [
        'id',
        'name',
        'image',
        'role',
        'description',
        'status',
        'language_id',
    ];

    public $filterable = [
        'id',
        'name',
        'image',
        'role',
        'description',
        'status',
        'language_id',
    ];

    protected $fillable = [
        'id',
        'name',
        'image',
        'role',
        'description',
        'status',
        'language_id',
    ];

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }
}
