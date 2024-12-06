<?php

use Illuminate\Support\Facades\Route;

use App\Models\Skill;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return 123;
});

route::get('/portfolio' , function() {
    $title = 'Портфолио Terricon';
    $jobs = [
        [
            'name' => 'Разработка сайта для ЖК',
            'price' => 1000,
            'val' => '$'

        ],
        [
            'name' => 'Разработка сайта для клиники',
            'price' => 1500,
            'val' => '$'

        ],
        [
            'name' => 'Разработка сайта для Terricon',
            'price' => 2000,
            'val' => '$'

        ]
    ];

    return view('portfolio')
        ->with('title',$title)
        ->with('jobs', $jobs);


}); 
Route::get('/skills/{category}', function($category) {
    $title = "Навыки в категории $category";

    $skills = skill::where('category', $category)->get();

   

  
    return view('skills')
        ->with('title', $title)
        ->with('skills', $skills);


});


Route::get('/skills', function(){
    $title = 'Навыки';

    $skills = skill::all();

  
    return view('skills')
        ->with('title', $title)
        ->with('skills', $skills);


});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
