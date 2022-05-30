<?php

use App\Http\Controllers\ExempleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

////////////////////////////// ROUTING ////////////////////////////////////////

#      get('url', [nom du controler::class, 'sa fonction'])->name('nom de la route')
Route::get('/', [ExempleController::class, 'home'])->name('home');
/*
    Routing avec paramètre
    La route ci-dessous attend un argument 'id' pour pouvoir afficher un plat.
*/
Route::get('/plat/{id}', [ExempleController::class, 'show'])->whereNumber('id')->name('plat.show');
Route::get('/plat/creer', [ExempleController::class, 'create'])->name('plat.create');

Route::get('/plat/supprimer/{id}', [ExempleController::class, 'delete'])->name('plat.delete');

//////////////////////////////// ROUTE POST //////////////////////////////////
    # La methode post() de la Facade Route permet de gérer les méthodes POST dans les requêtes HTTP/S
    # Laravel sait que l'url '/plat/creer' aura une methode GET et POST
    # On devra appeler la fonction dans le controller 'store'. =>
Route::post('/plat/creer', [ExempleController::class, 'store'])->name('plat.store');
//////////////////////////////////////////////////////////////////////////////
Route::get('/plat/modifier/{id}', [ExempleController::class, 'update'])->whereNumber('id')->name('plat.update');
Route::patch('/plat/modifier/{id}', [ExempleController::class, 'storeUpdate'])->whereNumber('id')->name('plat.store.update');


Route::get('/contact', [ExempleController::class, 'contact'])->name('contact');

///////////////////////////// END ROUTING /////////////////////////////////////


/////////////////////////////// EXEMPLES ///////////////////////////////////
/*
 Laravel vous permet plusieurs possibilités pour créer vos routes.
 Laravel est flexible et peu contraignant.
 On a la possiblité de retourner directement une chaine de caractères.
    A ce moment là, la string 'Voici le menu' est automatiquement parsé en HTML.
    Exemple :
*/
Route::get('/string', function() {
    return 'Voici le menu';
});

/*
 Laravel nous parmet de retourner une réponse en json également.
 Voici un exemple du comportement de Laravel :
    Laravel parse automatiquement le json (comme le HTML ci-dessus)
*/
Route::get('/json', function() {
    return response()->json([
        'titre' => 'Salade César',
        'contenu' => 'du poulet de la salade et plein de bonnes choses',
        'prix' => '10 €'
    ]);
});

/*
 Voyons maintenant la methode view().
    Lorsque la vue est inexistante (ou pas dans le bon dossier) le framework lance une erreur de type InvalidArgumentException
 Voici à quoi cela ressemble :
*/
Route::get('/view', function () {
    return view('view');
});

// DÉCOUVERTE DES CONTROLLERS À PRÉSENT !
// Car la façon que nous avons vu ci-dessus n'est pas vraiment optimisée, ni correcte dans une architecture MVC.
// Imainez que nous aillons une trentaine de routes, si nous devions coder la logique de chacune, le fichier web.php (routes) serait :
        // 1 - très long
        // 2 - difficile à lire
        // 3 - difficilement maintenable



//////////////////////////////////////// LES BONNES PRATIQUES //////////////////////////////////////
/*
 On appelle le controller ExempleController et on spécifie la fonction test() de cette manière (voir ci-dessous) avec le symbole '@'.
 ATTENTION : si vous oubliez le namespace, ou si mal écrit (case-sensitive), Laravel lance une erreur de type BindingResolutionException (Target class)
    la sensiblité à la case implique d'utiliser les backslashes '\' => sinon lance une erreur BindingResolutionException !
*/
# --------------- Première façon d'appeler notre controller et sa fonction 'test' ----------------- #
Route::get('/test', 'App\Http\Controllers\ExempleController@test');

 # --------------- Seconde façon d'appeler notre controller et sa fonction 'test' ----------------- #
// Pour se simplifier la tâche, on peut passer un array en second argument :
Route::get('/test2', [ExempleController::class, 'test'])->name('test'); // => IMPORTEZ votre class ExempleController / extension vs code : php namespace resolver

// Nous avons supprimé le ExempleController, car nous alons le recréer avec la CLI
// Grâce à la CLI, nous pourrons executer une ligne de commande : php artisan make:controller ExempleController
