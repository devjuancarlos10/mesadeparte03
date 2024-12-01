<?php

use Illuminate\Support\Facades\Route;

<<<<<<< Updated upstream
Route::get('/', function () {
    return view('welcome');
=======
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
>>>>>>> Stashed changes
});
