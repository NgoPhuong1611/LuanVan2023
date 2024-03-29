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
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\FullTestController;
use App\Http\Controllers\ExamToeicRandom;
use App\Http\Controllers\ToForumController;
// route admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\PartExamController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuestionGroupController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ExamHistoryController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TransactionUserController;
use App\Http\Controllers\TransactionTeacherController;
use App\Models\ExamHistory;
use App\Http\Controllers\MissionTeacherController;

// use App\Http\Controllers\Admin\UserController;

Route::group([], function () {
    Route::get('',  [HomeController::class, 'index']);
    Route::get('Teacher',  [HomeController::class, 'index2']);
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/',[BlogController::class, 'index']) ;
        Route::get('detail/{any}', [BlogController::class, 'detail']);
    });
    Route::group(['prefix' => 'blogTeacher'], function () {
        Route::get('/',[BlogController::class, 'indexTeacher']) ;
        Route::get('detail/{any}', [BlogController::class, 'detailTeacher']);
    });

    Route::group(['prefix' => 'listExam'], function () {
        Route::get('listtoeic',[ListExamController::class, 'index'] );
        Route::get('listlisten',[ListExamController::class, 'listListen']);
        Route::get('listread',[ListExamController::class, 'listRead'] );
        Route::get('examrandom', [ListExamController::class, 'examRandom']);
        Route::POST('purchase-exam/{any}', [FullTestController::class, 'purchaseExam'])->name('purchase.exam');
    });

    Route::group(['prefix' => 'Exam'], function () {
        // Route::prefix('Exam')->middleware('User')->group(function () {
        Route::get('ExamToeic/{any}', [FullTestController::class, 'index']) ;
        Route::get('ExamListen', [FullTestController::class, 'testListen']);
        Route::get('ExamRead',[FullTestController::class, 'testRead'] );
        Route::get('ExamToeicRandom',[ExamToeicRandom::class, 'index']  );
        Route::POST('InsertWrongAnswer', [FullTestController::class, 'insertWrongAnswer'] );
        Route::POST('Score', [FullTestController::class, 'score'] );

    });
    // Route::prefix('Practice')->middleware('User')->group(function () {
    Route::group(['prefix' => 'Practice', 'as' => 'Practice.'], function () {
        Route::get('PracticeVocabulary', [PracticeController::class, 'PracticeVocabulary']);
        Route::get('PracticeGrammar', [PracticeController::class, 'PracticeGrammar']);

        Route::get('PracticeListen', [PracticeController::class, 'practiceListen']);
        Route::get('PracticeRead', [PracticeController::class, 'practiceRead']);
        Route::get('Listen/{any}', [PracticeController::class, 'listen']);
        Route::get('Read/{any}', [PracticeController::class, 'read']);

        Route::get('PracticeSpeaking', [PracticeController::class, 'practiceSpeaking']);
        Route::get('PracticeWriting', [PracticeController::class, 'practiceWriting']);
        Route::get('Speaking/{any}', [PracticeController::class, 'speaking']);
        Route::get('Writing/{any}', [PracticeController::class, 'writing']);

        Route::post('record', [PracticeController::class, 'uploadAudio']);
        Route::post('save', [PracticeController::class, 'save']);

    });

    Route::group(['prefix' => 'User'], function () {
        Route::get('Login', [UserController::class, 'index']);
        Route::post('userlogin', [UserController::class, 'userLogin']);
        Route::get('Infor',[UserController::class, 'showInforUser'] );
        Route::post('updateProfile', [UserController::class, 'updateProfile']);
        Route::get('EditPassWord', [UserController::class, 'editPassword']);
        Route::post('changePassword',[UserController::class, 'changePassword']);
        Route::get('Register', [UserController::class, 'register']);
        Route::post('save',[UserController::class, 'save']);
        Route::get('Logout', [UserController::class, 'logout']);
        //quên mật khẩu user
        Route::get('forgotpassword',[UserController::class, 'forgotpassword']);
        Route::post('recoverPass',[UserController::class, 'recoverPass']);
        Route::post('confirmToken',[UserController::class, 'confirmToken']);
        Route::get('resetPassword',[UserController::class, 'showResetPasswordForm']);
        Route::post('resetPassword',[UserController::class,'resetPassword']);
        

        Route::get('ExamHistory', [HistoryController::class, 'index']);
        Route::get('indexExamHistory/{id}', [HistoryController::class, 'indexExamHistory']);
        Route::get('deleteHistory/{id}',  [HistoryController::class, 'deleteHistory']);

        // Route::get('Ratings', [HistoryController::class, 'ratings']);

    });
    // thanh toán momo
    Route::get('transaction',[TransactionUserController::class,'index']);
    Route::get('transactionHistory',[TransactionUserController::class,'transactionHistory']);
    Route::post('momo_payment',[TransactionUserController::class,'momo_payment']);
    //số coin
  
    //

    Route::group(['prefix' => 'Teacher'], function () {
        Route::get('Infor',[TeacherController::class, 'showInforTeacher'] );
        //
        Route::get('Register', [TeacherController::class, 'registerTeacher']);
        Route::post('save',[TeacherController::class, 'saveTeacher']);

        Route::post('updateProfile', [TeacherController::class, 'updateProfile']);
        Route::get('EditPassWord', [TeacherController::class, 'editPassword']);
        Route::post('changePassword',[TeacherController::class, 'changePassword']);
        //
        Route::get('terms',[TeacherController::class, 'terms'] );
        Route::get('detail',[TeacherController::class, 'detail'] );
        

        //
        Route::get('coin',[TransactionTeacherController::class, 'index'] );
        Route::get('transactionHistory',[TransactionTeacherController::class, 'transactionHistory'] );
        Route::match(['get', 'post'], 'showTran',[TransactionTeacherController::class, 'showTransactionForm'] );
        Route::match(['get', 'post'], 'createRequest',[TransactionTeacherController::class, 'createRequest'] );
        //
        Route::get('mission',[MissionTeacherController::class, 'mission'] );
        Route::get('showDetail', [MissionTeacherController::class, 'showDetail']);
        // Route::get('Login', [UserController::class, 'index']);
        // Route::post('userlogin', [UserController::class, 'userLogin']);
        // Route::post('updateProfile', [UserController::class, 'updateProfile']);
        // Route::get('EditPassWord', [UserController::class, 'editPassword']);
        // Route::post('changePassword',[UserController::class, 'changePassword']);
        // Route::get('Result', [UserController::class, 'result']);
        // Route::get('Register', [UserController::class, 'register']);
        // Route::post('save',[UserController::class, 'save']);
        // Route::get('Logout', [UserController::class, 'logout']);
    });
    
    Route::group(['prefix' => 'ToForum'], function () {
        Route::get('/',[ToForumController::class, 'index'] );
    });




    Route::get('/chat', [ChatController::class, 'index']);
    Route::get('/chatTeacher', [ChatController::class, 'indexTeacher']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);

});



// Route::post('getWebhook', 'Hook::index');

Route::get('/dashboard', [Home::class, 'index']);
// Route::get('/dashboard', 'Home::index');
Route::get('admin-login',  [LoginController::class, 'index'])->name('admin-login');
Route::post('admin-login', [loginController::class,'authLogin'])->name('admin-authLogin');
Route::get('logout', [LoginController::class,'logout'])->name('admin-logout');
Route::get('dashboard', [Home::class, 'index'])->name('Home');
//quên mật khẩu admin
Route::get('forgotpasswordAd',[LoginController::class, 'forgotpassword']);
Route::post('recoverPassAd',[LoginController::class, 'recoverPass']);
Route::get('confirmTokenAd', [LoginController::class, 'showConfirmTokenForm'])->name('showConfirmTokenForm');
Route::post('confirmTokenAd',[LoginController::class, 'confirmToken']);
Route::get('resetPasswordAd',[LoginController::class, 'showResetPasswordForm'])->name('showResetPasswordForm');
Route::post('resetPasswordAd',[loginController::class,'resetPassword']);


//
//1 trong 2 dòng dòng 2 trường hợp chức năng đăng nhập admin
Route::prefix('dashboard')->middleware('Admin')->group(function () {
    //  Route::prefix('dashboard')->group(function () {

    Route::get('/',[App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/',  [AdminController::class, 'index']);
        Route::get('detail',  [AdminController::class, 'detail']);
        Route::post('save', [AdminController::class, 'save']);

        Route::get('edit/{id}', [AdminController::class, 'edit']);
        Route::post('update/{id}', [AdminController::class, 'update']);
        Route::get('delete/{id}', [AdminController::class, 'delete']);




    });
    
    Route::group(['prefix' => 'user'], function () {
        Route::get('/',  [UserAdminController::class, 'index']);
        Route::get('detail',  [UserAdminController::class, 'detail']);
        Route::post('save', [UserAdminController::class, 'save']);

        Route::get('edit/{id}', [UserAdminController::class, 'edit']);
        Route::post('update/{id}', [UserAdminController::class, 'update']);
        Route::get('delete/{id}', [UserAdminController::class, 'delete']);

        Route::get('indexteacher',  [UserAdminController::class, 'indexteacher']);
        Route::get('detailteacher',  [UserAdminController::class, 'detailteacher']);
        Route::post('saveteacher', [UserAdminController::class, 'saveteacher']);
        Route::get('editteacher/{id}', [UserAdminController::class, 'editteacher']);
        Route::post('updateteacher/{id}', [UserAdminController::class, 'updateteacher']);
        Route::get('deleteteacher/{id}', [UserAdminController::class, 'deleteteacher']);
    });

    Route::group(['prefix' => 'question'], function () {
        Route::get('/',  [QuestionController::class, 'index']);
        Route::get('detail',  [QuestionController::class, 'detail']);
        Route::get('edit/{id}',  [QuestionController::class, 'edit']);
        Route::get('delete/{id}',  [QuestionController::class, 'delete']);
        Route::post('save', [QuestionController::class, 'save']);
        Route::post('update/{id}',  [QuestionController::class, 'update']);

         // Route::get('detail/{id}', [QuestionController::class, 'detail']);
        // Route::post('detail/{id}', [QuestionController::class, 'detail']);
    });

    Route::group(['prefix' => 'question-group'], function () {
        Route::get('/', [QuestionGroupController::class, 'index'])->name('dashboard.question-group.index');
        Route::get('edit/{id}', [QuestionGroupController::class, 'edit'])->name('dashboard.question-group.edit');
        Route::get('detail', [QuestionGroupController::class, 'detail']);
        Route::post('update/{id}',[QuestionGroupController::class, 'update']);

        Route::post('save',[QuestionGroupController::class, 'save']);
        Route::get('delete/{id}', [QuestionGroupController::class, 'delete']);
    });

    Route::group(['prefix' => 'exam'], function () {
        Route::get('/', [ExamController::class, 'index']);
        Route::get('detail',  [ExamController::class, 'detail']);
        Route::get('detailradom',  [ExamController::class, 'detailradom']);
        Route::post('save',  [ExamController::class, 'save']);
        Route::post('saver',  [ExamController::class, 'saver']);
        Route::post('update/{id}',  [ExamController::class, 'update']);
        Route::get('edit/{id}', [ExamController::class, 'edit']);
        Route::get('delete/{id}',  [ExamController::class, 'delete']);
        Route::get('part-exam', [PartExamController::class, 'index']);
        Route::get('part-exam/detail', [PartExamController::class, 'detail']);


        Route::get('/questions/{part}',  [PartExamController::class, 'getQuestionsByPart']);
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
        Route::get('/', [PostsController::class, 'index']);//index():
        Route::get('detail',[PostsController::class, 'detail'] );// create()
        Route::post('save', [PostsController::class, 'save']);//store()

        Route::get('edit/{id}', [PostsController::class, 'edit']);//edit()
        Route::post('update/{id}',[PostsController::class, 'update']);//update()
        Route::get('delete/{id}',[PostsController::class, 'delete']);//destroy()
    });
    Route::group(['prefix' => 'chat'], function () {
        Route::get('/',[ChatController::class, 'index']);
    });
    Route::group(['prefix' => 'forum'], function () {
        Route::get('/',[ForumController::class, 'index']);
        Route::get('destroy/{id}',[ForumController::class, 'destroy']);
        Route::get('detail',[ForumController::class, 'detail']);
        Route::post('save', [ForumController::class, 'save']);



    });
    Route::group(['prefix' => 'mission'], function () {
        Route::get('/',[MissionController::class, 'index']);
    });
    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/',[TransactionController::class, 'index']);
        Route::get('/detail/{id}', [TransactionController::class, 'showDetail']);
        Route::post('/update', [TransactionController::class, 'updateTransaction']);
    });
    Route::group(['prefix' => 'banner'], function () {
        Route::get('/',[BannerController::class, 'index']);
        Route::post('save', [BannerController::class, 'save']);
    });
    Route::group(['prefix' => 'history'], function () {
        Route::get('/',[ExamHistory::class, 'index']);
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
