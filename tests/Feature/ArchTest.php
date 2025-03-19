<?php
uses()->group('arch');

arch()->preset()->laravel();

arch('No debugging calls are used')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();

arch('Models extend Eloquent Model') 
    ->expect('App\Models')
    ->toExtend('Illuminate\Database\Eloquent\Model');