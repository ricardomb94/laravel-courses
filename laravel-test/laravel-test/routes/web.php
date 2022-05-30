<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use League\CommonMark\Extension\FrontMatter\Data\LibYamlFrontMatterParser;

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

Route::get('/', function () {

    $files = File::files(resource_path('posts/'));

    $posts = collect($files)

    ->map(function ($file){
        $document = YamlFrontMatter::parseFile($file);

        return new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug,
        );
    }, $files);

    //ddd($posts[0]->body);

    return view('posts', ['posts' => $posts]);



    // return view('posts', [
    //     'posts' =>Post::all()
    // ]);
});

Route::get('posts/{post}', function($slug) {

    //Find a post by its slug and pass it to a view called "post"
    return view('post', [

       'post' => Post::find($slug)
    ]);

})->where('post', '[a-zA-Z_/-]+');
