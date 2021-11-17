<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function() {
    Route::post('lock', [DrPeter\LockUser\LockUserController::class, 'lockUser'])->name('lock-user');
    Route::post('unlock', [DrPeter\LockUser\LockUserController::class, 'unlockUser'])->name('unlock-user');
});