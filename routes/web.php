<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('pages.index');
//});

Route::get('/', 'HelloController@index');

//Pages Routes are here
Route::get('/about', 'HelloController@Manush');
Route::get('/contact', 'BoloController@Bolo');

// Category curds are here
Route::get('/add.category', 'Category@AddCategory');
Route::post('/store.category', 'Category@StoreCategory');
Route::get('/all.category', 'Category@AllCategory') -> name('all.category');
Route::get('view/category/{id}', 'Category@ViewCategory');
Route::get('delete/category/{id}', 'Category@DeleteCategory');
Route::get('edit/category/{id}', 'Category@EditCategory');
Route::post('update/category/{id}', 'Category@UpdateCategory');

//Posts Crud are here
Route::get('/write.post', 'PostController@WritePost');
Route::post('/store.post', 'PostController@StorePost');
Route::get('/all.post', 'PostController@AllPost') -> name('all.post');
Route::get('/view/post/{id}', 'PostController@ViewPost');
Route::get('/edit/post/{id}', 'PostController@EditPost');
Route::post('/update/post/{id}', 'PostController@UpdatePost');
Route::get('/delete/post/{id}', 'PostController@DeletePost');

//Students------
/*Route::get('/students', 'StudentController@create') -> name('student');
Route::post('/store/student', 'StudentController@store') -> name('store.student');
Route::get('/all/student', 'StudentController@index') -> name('all.student');
Route::get('/view/student/{id}', 'StudentController@show');
Route::get('/delete/student/{id}', 'StudentController@destroy');
Route::get('/edit/student/{id}', 'StudentController@edit');
Route::post('/update/student/{id}', 'StudentController@update');*/

Route::resource('student', 'StudentController');