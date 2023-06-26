<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    public $table = 'contacts';

    public $orderable = [
        'id', 'name', 'email', 'phone_number', 'subject', 'message', 'created_at',
    ];

    public $filterable = [
        'id', 'name', 'email', 'phone_number', 'subject', 'message',
    ];

    protected $fillable = [
        'id', 'name', 'email', 'phone_number', 'subject', 'message',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
