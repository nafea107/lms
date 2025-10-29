<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

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
    public function version(Request $request): ?string
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
        $user = null;
        if ($request->user()) {
            $user = [
                ...$request->user()->toArray(),
                'roles' => $request->user()?->getRoleNames()
            ];
            $notifications = Notification::whereUserId($request->user()->id)->latest()->limit(20)->get(['message']);
        }
        $data = [
            ...parent::share($request),
            'locale' => app()->getLocale(),
            'app_name' => Setting::where('key', 'app_name')->first()?->value,
            'current_route_name' => Route::currentRouteName(),
            'current_route_params' => Route::current()->parameters(),
            'auth' => [
                'user' => $user,
            ],
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'notifications' => auth()->check() ? $notifications : null,
        ];


        return $data;
    }
}
