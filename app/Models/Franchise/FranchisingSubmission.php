<?php

namespace App\Models\Franchise;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchisingSubmission extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'franchising_form_submissions';

    protected $guarded = [];
}
