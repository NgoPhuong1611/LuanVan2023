<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Services;
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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Home;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\PartExamController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuestionGroupController;
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

    Route::get('/',[App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\AdminController@index');
        Route::get('detail', 'Admin\AdminController@detail');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'Admin\UserController@index');
        Route::get('detail', 'Admin\UserController@detail');
    });



    Route::group(['prefix' => 'question'], function () {
        Route::get('/',  [QuestionController::class, 'index']);
        Route::get('detail',  [QuestionController::class, 'detail']);
        Route::get('detail/{id}', [QuestionController::class, 'detail']);
        Route::post('save', [QuestionController::class, 'save']);
    });

    Route::group(['prefix' => 'question-group'], function () {
        Route::get('/', [QuestionGroupController::class, 'index'])->name('dashboard.question-group.index');
        Route::get('detail/{id}', [QuestionGroupController::class, 'detail']);

        Route::post('save',[QuestionGroupController::class, 'save']);
        Route::post('delete', [QuestionGroupController::class, 'delete']);
    });

    Route::group(['prefix' => 'exam'], function () {
        Route::get('/', [ExamController::class, 'index']);
        Route::get('detail', [ExamController::class, 'detail']);
        Route::post('save', [ExamController::class, 'save']);
        Route::post('update/{id}', [ExamController::class, 'update']);
        Route::get('edit/{id}', [ExamController::class, 'edit']);
        Route::get('delete/{id}', [ExamController::class, 'delete']);


    });

    Route::group(['prefix' => 'exam-part'], function () {
        Route::get('/',[PartExamController::class, 'index']);
        Route::get('detail', [PartExamController::class, 'detail']);
        Route::post('save', [PartExamController::class, 'save']);
        Route::get('edit/{id}', [PartExamController::class, 'edit']);
        Route::post('update/{id}', [PartExamController::class, 'update']);
        Route::get('delete/{id}', [PartExamController::class, 'delete']);
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('detail', [CategoryController::class, 'detail']);
        Route::post('save', [CategoryController::class, 'save']);

        Route::get('edit/{id}', [CategoryController::class, 'edit']);
        Route::post('update/{id}', [CategoryController::class, 'update']);
        Route::get('delete/{id}', [CategoryController::class, 'delete']);
    });
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostsController::class, 'index']);
        Route::get('detail',[PostsController::class, 'detail'] );
        Route::post('save', [PostsController::class, 'save']);

        Route::get('edit/{id}', [PostsController::class, 'edit']);
        Route::post('update/{id}',[PostsController::class, 'update']);
        Route::get('delete/{id}',[PostsController::class, 'delete']);
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

