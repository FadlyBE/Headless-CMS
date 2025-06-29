<?php

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;

use App\Http\Middleware\CheckPermission; // middleware custom kamu

return [

    'web' => [
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        ShareErrorsFromSession::class,
        ValidateCsrfToken::class,
        SubstituteBindings::class,
    ],

    'api' => [
        SubstituteBindings::class,
    ],

    'middlewareAliases' => [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'permission' => CheckPermission::class, // ← tambahkan alias ini
    ],

];
