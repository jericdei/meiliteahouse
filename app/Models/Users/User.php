<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, SoftDeletes, HasUuids;

    protected $table = 'users';

    protected $guarded = [];

    protected $hidden = ['password'];

    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function getInitialsAttribute(): string
    {
        return "{$this->first_name[0]}{$this->last_name[0]}";
    }

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => bcrypt($value)
        );
    }
}
