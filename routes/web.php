<?php

use Illuminate\Support\Facades\Route;

// Ruta de inicio (home)
Route::get('/', function () {
    return view('welcome');
});

Route::get("/user", function() {
    return view('user');
});

Route::get("/secretary", function() {
    return view("secretary");
});


Route::get("/publicOfficer", function(){
    return view("publicOfficer");
});
