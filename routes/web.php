<?php
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin', 301)->name('home');
