<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Services;
use App\Http\Controllers\Admin\Home;
use App\Http\Controllers\Admin\LoginController;
// route user
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ListExamController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FullTestController;
use App\Http\Controllers\ExamToeicRandom;
// route admin

Route::group([], function () {
    Route::get('',  [HomeController::class, 'index']);

    Route::group(['prefix' => 'blog'], function () {
        Route::get('/',[BlogController::class, 'index']) ;
        Route::get('detail/{any}', [BlogController::class, 'detail']);
    });

    Route::group(['prefix' => 'listExam'], function () {
        Route::get('listtoeic',[ListExamController::class, 'index'] );
        Route::get('listlisten',[ListExamController::class, 'listListen']);
        Route::get('listread',[ListExamController::class, 'listRead'] );
        Route::get('examrandom', [ListExamController::class, 'examRandom']);
    });

    Route::group(['prefix' => 'Exam'], function () {
        Route::get('ExamToeic/{any}', [FullTestController::class, 'index']) ;
        Route::get('ExamListen', [FullTestController::class, 'testListen']);
        Route::get('ExamRead',[FullTestController::class, 'testRead'] );
        Route::get('ExamToeicRandom',[ExamToeicRandom::class, 'index']  );
        Route::post('InsertWrongAnswer', [FullTestController::class, 'insertWrongAnswer'] );
    });

    Route::group(['prefix' => 'Practice'], function () {
        Route::get('PracticeVocabulary', [PracticeController::class, 'PracticeVocabulary']);
        Route::get('PracticeGrammar', [PracticeController::class, 'PracticeGrammar']);

        Route::get('PracticeListen', [PracticeController::class, 'practiceListen']);
        Route::get('PracticeRead', [PracticeController::class, 'practiceRead']);
        Route::get('Listen/{any}', [PracticeController::class, 'listen']);
        Route::get('Read/{any}', [PracticeController::class, 'read']);

    });

    Route::group(['prefix' => 'User'], function () {
        Route::get('Login', [UserController::class, 'index']);
        Route::post('userlogin', [UserController::class, 'userLogin']);
        Route::get('Infor',[UserController::class, 'showInforUser'] );
        Route::post('updateProfile', [UserController::class, 'updateProfile']);
        Route::get('EditPassWord', [UserController::class, 'editPassword']);
        Route::post('changePassword',[UserController::class, 'changePassword']);
        Route::get('Result', [UserController::class, 'result']);
        Route::get('Register', [UserController::class, 'register']);
        Route::post('save',[UserController::class, 'save']);
        Route::get('Logout', [UserController::class, 'logout']);
    });
});



// Route::post('getWebhook', 'Hook::index');

// Route::get('/', [Home::class, 'index']);
// Route::get('/', 'Home::index');
// Route::get('admin-login',  [LoginController::class, 'index'])->name('admin-login');
// Route::post('admin-login', [oginController::class,'authLogin'])->name('admin-authLogin');
// Route::get('logout', [LoginController::class,'logout'])->name('admin-logout');
// Route::get('/', [Home::class, 'index'])->name('Home');
// Route::prefix('dashboard')->middleware('Admin')->group(function () {
     Route::prefix('dashboard')->group(function () {

    Route::get('', 'HomeController@index');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\AdminController@index');
        Route::get('detail', 'Admin\AdminController@detail');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'Admin\UserController@index');
        Route::get('detail', 'Admin\UserController@detail');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'Admin\CategoryController@index');
        Route::get('detail', 'Admin\CategoryController@detail');
        Route::post('save', 'Admin\CategoryController@save');

        Route::get('edit/{id}', 'Admin\CategoryController@edit');
        Route::post('update/{id}', 'Admin\CategoryController@update');
        Route::get('delete/{id}', 'Admin\CategoryController@delete');
    });

    Route::group(['prefix' => 'question'], function () {
        Route::get('/', 'Admin\QuestionController@index');
        Route::get('detail', 'Admin\QuestionController@detail');
        Route::get('detail/{id}', 'Admin\QuestionController@detail');
        Route::get('upload-excel', 'Admin\QuestionController@uploadExcel');

        Route::post('upload-excels', 'Admin\QuestionController@uploadExcelSave');

        Route::post('detail/{id}', 'Admin\QuestionController@detail');
        Route::post('save', 'Admin\QuestionController@save');
    });

    Route::group(['prefix' => 'question-group'], function () {
        Route::get('/', 'Admin\QuestionGroupController@index');
        Route::get('detail', 'Admin\QuestionGroupController@detail');
        Route::get('detail/{id}', 'Admin\QuestionGroupController@detail');

        Route::post('save', 'Admin\QuestionGroupController@save');
        Route::post('delete', 'Admin\QuestionGroupController@delete');
    });

    Route::group(['prefix' => 'exam'], function () {
        Route::get('/', 'Admin\ExamController@index');
        Route::get('detail', 'Admin\ExamController@detail');
        Route::post('save', 'Admin\ExamController@save');
        Route::post('update/{id}', 'Admin\ExamController@update');
        Route::get('edit/{id}', 'Admin\ExamController@edit');
        Route::get('delete/{id}', 'Admin\ExamController@delete');
        Route::get('part-exam', 'Admin\PartExamController@index');
        Route::get('part-exam/detail', 'Admin\PartExamController@detail');
    });

    Route::group(['prefix' => 'exam-part'], function () {
        Route::get('/', 'Admin\PartExamController@index');
        Route::get('detail', 'Admin\PartExamController@detail');
        Route::post('save', 'Admin\PartExamController@save');
        Route::get('edit/{id}', 'Admin\PartExamController@edit');
        Route::post('update/{id}', 'Admin\PartExamController@update');
        Route::get('delete/{id}', 'Admin\PartExamController@delete');
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', 'Admin\PostsController@index');
        Route::get('detail', 'Admin\PostsController@detail');
        Route::post('save', 'Admin\PostsController@save');

        Route::get('edit/{id}', 'Admin\PostsController@edit');
        Route::post('update/{id}', 'Admin\PostsController@update');
        Route::get('delete/{id}', 'Admin\PostsController@delete');
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based route is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $route object within that file without
 * needing to reload it.
 */

