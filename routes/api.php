<?php

//use App\Http\Controllers\Api\V1\CommentController;

use App\Http\Controllers\Api\V1\TagController;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentIndexResource;
use App\Http\Resources\User\UserResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'posts' => PostController::class,
    //'posts.comments' => CommentController::class,
    'tags' => TagController::class,
    'categories' => CategoryController::class,
    //'filter' => FilterFController::class,
]);

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'jwt.auth'], function() {
        Route::apiResources([
            'posts.comments' => CommentController::class,
        ]);
    });

});

Route::get('/filter', 'FilterController@search');
Route::get('/category/{category}', 'FilterController@category');




//Test:

Route::get('/user/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});

Route::get('/cat/{id}', function ($id) {
    //return new CategoryResource(Category::findOrFail($id));
    return CategoryResource::collection(Category::all());
});

Route::get('/comm/{id}', function ($id) {
    //return new CommentIndexResource(Comment::findOrFail($id));
    //return new UserResource($this->users);
    //return new CommentIndexResource($this->comments);
    //return UserResource::collection(User::all());
    //return new UserResource(User::findOrFail($id));
});

// Route::apiResources([
//     'posts.comments' => CommentController::class,
// ]);


