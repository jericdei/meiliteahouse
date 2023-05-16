<?php

namespace App\Models\Investors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'investor_classifications';

    protected $guarded = [];

    protected $casts = [
        'freebies' => 'array'
    ];
}
