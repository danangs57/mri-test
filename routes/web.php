<?php

use App\Models\Role;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    if (auth()->user()->role->name == 'NormalUser') {
        $users= User::where('id',auth()->user()->id)->get();
    }else{

        $users= User::wherehas('position')->get();
    }
    

    return view('dashboard',compact('users'));


})->middleware(['auth'])->name('dashboard');



Route::prefix('user')->group(function () {

    Route::get('/', function () {
        $users= User::get();
        $roles= Role::get();
        return view('user',compact('users','roles'));
    })->middleware(['auth','admin'])->name('user');


    Route::get('/edit/{user}', function (User $user) {
      
        return view('user.edit',compact('user'));
    })->middleware(['auth'])->name('user.edit');

    Route::put('/update/{user}', function (User $user) {
            $salary= Salary::create([
                'gaji' =>  request()->gaji,
                'pajak' =>  request()->pajak,
            ]);

            $user->update([
                'name' => request()->name,
                'email' => request()->email,
                'salary_id' => $salary->id,
            ]);
        
        return redirect()->route('dashboard');


    })->middleware(['auth'])->name('user.update');


});















require __DIR__.'/auth.php';
