<?php

use App\Models\author;
use App\Models\book;
use App\Models\Role;
use App\Models\User;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $books = book::orderby('created_at','DESC')->get();
    $authors = author::get();
    return view('dashboard',compact('books','authors'));
})->middleware(['auth'])->name('dashboard');


Route::prefix('book')->group(function () {

        Route::get('/', function () {
            return view('book');
        })->middleware(['auth'])->name('book');
        
        Route::post('/store', function () {

            book::create(request()->all());
            return redirect()->back();

        })->middleware(['auth','admin'])->name('book.store');


        Route::get('/edit/{book}',function(book $book){

            $authors = author::get();


            return view('book.edit',compact('book','authors'));


        })->middleware(['auth','admin'])->name('book.edit');

        Route::put('/{book}/update', function (book $book) {
                $book->update(request()->all());

             return redirect()->route('dashboard');

        })->middleware(['auth','admin'])->name('book.update');

        Route::delete('delete/{book}', function (book $book) {
            $book->delete();
            return redirect()->route('dashboard');


        })->middleware(['auth','admin'])->name('book.delete');
});



Route::prefix('user')->group(function () {
    Route::get('/', function () {


        $users= User::get();
        $roles= Role::get();
        return view('user',compact('users','roles'));
    
    })->middleware(['auth','admin'])->name('user');

    Route::post('/store', function () {


        $role = Role::where('name','Non-Admin')->first(['id']);
        User::create([
            'name'=> request()->name,
            'email'=> request()->email,
            'password' => Hash::make(request()->password),
            'role_id' => $role->id,
        ]);
        return redirect()->route('user');
     
    
    })->middleware(['auth','admin'])->name('user.store');
});















require __DIR__.'/auth.php';
