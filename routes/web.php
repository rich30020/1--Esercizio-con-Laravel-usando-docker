<?php

use App\Http\Controllers\ProvaController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AddCustomHeader;

Route::get('/', function () {
    return view('home', [
        'pageTitle' => 'Homepage',
        'metaTitle' => 'Homepage nel meta title'
    ]);
})->name('home')->middleware(AddCustomHeader::class . ':abbiamoquasifinito');

Route::get('/about', function () {
    return view('about', [
        'pageTitle' => 'About',
        'metaTitle' => 'About nel meta title'
    ]);
})->middleware('auth');

// Rotte spostate nel PostController per una migliore organizzazione
Route::controller(PostController::class)->group(function () {
    Route::get('/post/{post}', 'show')->name('post.show');
    Route::put('/post/{id}', 'update')->name('post.update');
    Route::delete('/post/{id}', 'destroy')->name('post.delete');
});


Route::post('/form', [ValidationController::class, 'validateForm'])->name('validateForm');


// _________________________________________________________________________________

// Route per la registrazione
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('showRegisterForm');
Route::post('/register', [UserController::class, 'register'])->name('registerUser');

// Route per il login
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('loginUser');

//Route per il logout
Route::post('/logout', [UserController::class, 'logout'])->name('logoutUser');










/*
Route::get('/esempio', function () {
    $items = ['Item 1', 'Item 2', 'Item 3'];
    $title = "Esempio di Blade";
    $numbers = [1, 2, 3, 4, 5];
    $emptyArray = [];
    $someValue = null;

    return view('esempio', compact('items', 'title', 'numbers', 'emptyArray', 'someValue'));
});

Route::get('/prova', [ProvaController::class, 'provaFunction']);
Route::post('/prova', [ProvaController::class, 'provaData']);

Route::get('/posts', function () {
    /* //Recupera tutti i post
    $posts = Post::all();

    //Mostra tutti i post
    return view('posts.index', ['posts' => $posts]); 
    $user = User::factory()->count(10)->unverified()->create();
    return $user;
})->name('posts.index');

Route::get('/posts/create', function() {
    //Crea un nuovo post con dati fittizi
    $post = Post::create([
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    //Mostra un messaggio di conferma con l'ID del post creato
    return view('posts.create', ['posts' => $post]);
})->name('post.create');

Route::get('/posts/delete/{id}', function($id) {
    //Recupera e elimina il post con l'ID specificato
    $post = Post::find($id);

    if ($post) {
        $post->delete();
        $message = "Il mio post con ID $id è stato eliminato.";
    } else {
        $message = "Il post con ID $id non è stato trovato.";
    }

    //Mostra un messaggio di conferma dall'eliminazine 
    return view('posts.delete', ['message' => $message]);
})->name('posts.delete');

/*
Route::post('/prova', function() {
    //Logica per gestire il form inviato
    return 'Form Inviato!';
});

Route::put('/prova', function() {
    //Logica per l'aggiornamento
    return 'Elemento aggiornato!';
});

Route::patch('/prova', function () {
    //Logica per l'aggiornamento parziale
    return 'Elemento parzialmente aggiornato!';
});

Route::delete('/prova', function (){
    //Logica per l'eliminazione
    return 'Elemento eliminato!';
});

Route::match(['get', 'post'], '/prova', function () {
    return 'Questa route risponde sia a GET che a POST';
});

Route::any('/prova', function () {
    return 'Questa route risponde a qualsiasi metodo HTTP';
});

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'Gestione Utenti';
    });

    Route::get('/settings', function () {
        return 'Impostazioni di amministrazione';
    });
});
*/
