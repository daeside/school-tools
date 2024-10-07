<?php

return [
    'secret' => env('JWT_SECRET', 'your-secret-key'),
    'ttl' => 60, // Tiempo de vida del token en minutos
    'refresh_ttl' => 20160, // Tiempo de vida del token de refresco en minutos
    'algo' => 'HS256',
    'keys' => [
        'public' => '',
        'private' => '',
    ],
    'blacklist_grace_period' => 10, // Tiempo en minutos antes de que el token sea revocado
    'logging' => false,
    /*'providers' => [
        'user' => App\Models\User::class,
    ],*/
];
