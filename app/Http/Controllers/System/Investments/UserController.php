<?php

namespace App\Http\Controllers\System\Investments;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        $resource = UserResource::collection(
            User::query()
                ->latest()
                ->paginate($request->input('perPage', 15))
        )->response()->getData(true);

        return inertia('System/Investments/Users/Index', [
            'users' => getPaginatedResourceData($resource),
        ]);
    }
}
