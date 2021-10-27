<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    Route::get('test', function () {
        echo 'Hello from the test package!';
    });
