<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return array_merge(parent::share($request), [
            'user' => $user ? [
                'firstName' => $user->first_name,
                'middleName' => $user->middle_name,
                'lastName' => $user->last_name,
                'fullName' => $user->fullName,
                'initials' => $user->initials,
                'role' => $user->roles->pluck('name')[0],
                'photo' => $user->photo,
            ] : null,
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => function () use ($request) {
                $flashTypes = ['success', 'error', 'warning'];
                foreach ($request->session()->all() as $key => $value) {
                    if (in_array($key, $flashTypes)) {
                        return [
                            'severity' => $key === 'warning' ? 'warn' : $key,
                            'summary' => ucfirst($key).'!',
                            'detail' => $value,
                        ];
                    }
                }
            },
        ]);
    }
}
