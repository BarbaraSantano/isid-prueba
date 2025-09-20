<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('instructor', function () {
    $email = $this->ask('Introduce el email para hacer instructor:');

    $user = \App\Models\User::where('email', $email)->first();

    if (!$user) {
        $this->error("No se encontró un usuario con el email {$email}.");
        return;
    }

    $user->is_instructor = 1;
    $user->save();

    $this->info("El usuario {$email} ha sido promovido a instructor.");
})->describe('Hacer un usuario instructor');
