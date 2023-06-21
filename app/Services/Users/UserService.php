<?php

namespace App\Services\Users;

use App\Http\Requests\Users\UserStoreRequest;
use App\Models\Users\User;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function store(array $attributes): User
    {
        $validator = Validator::make($attributes, (new UserStoreRequest())->rules());

        return User::create($validator->validated());
    }
}
