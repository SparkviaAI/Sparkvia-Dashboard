<?php

use Illuminate\Support\Facades\Route;

/////////////////////////////////// LANDING PAGE NAMESPACE START //////////////////////////////////
use App\Http\Controllers\LandingPageController;
/////////////////////////////////// LANDING PAGE NAMESPACE START //////////////////////////////////


/////////////////////////////////////// ADMIN NAMESPACE START /////////////////////////////////////
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\PromptController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\LocaleController;
use App\Http\Controllers\Admin\UsersController;
///////////////////////////////////// ADMIN NAMESPACE START ///////////////////////////////////////


////////////////////////////////////// USER NAMESPACE START ///////////////////////////////////////
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\HomeController as UHC;
use App\Http\Controllers\User\ToolsController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SubscriptionController;
////////////////////////////////////// USER NAMESPACE START ///////////////////////////////////////



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


///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// LANDING PAGE ROUTES START ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/', [LandingPageController::class, 'getHomePage'])->name('getHomePage');
//////// DARK OR LIGHT MODE STARTS ////////////
Route::post('landing-theme-data', [LandingPageController::class, 'getThemeDataLanding'])->name('getThemeDataLanding');
//////// DARK OR LIGHT MODE ENDS ////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// LANDING PAGE ROUTES END //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// ADMIN ROUTES START ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['setlocale']], function () {
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminAuthController::class, 'getLogin'])->name('login');
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('login');
    Route::post('/loginPost', [AdminAuthController::class, 'postLogin'])->name('loginPost');
    Route::get('/forgot-password', [AdminAuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password-post', [AdminAuthController::class, 'forgotPasswordPost'])->name('forgotPasswordPost');
    Route::get('/reset-password/{token}', [AdminAuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/update-password-post', [AdminAuthController::class, 'updatePasswordPost'])->name('updatePasswordPost');

    Route::group(['middleware' => 'auth'], function () {
        Route::post('logout', [AdminAuthController::class, 'adminLogout'])->name('adminlogout');
        Route::get('/', [HomeController::class, 'dashboard'])->name('adminDashboard');
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('adminDashboard');


        ////////////////// CATEGORY ROUTES STARTS ///////////////////
        Route::post('categories/list', [CategoryController::class, 'list'])->name('categories.list');
        Route::delete('categories/destroy', [CategoryController::class, 'massDestroy'])->name('categories.massDestroy');
        Route::resource('categories', CategoryController::class);
        ////////////////// CATEGORY ROUTES ENDS ///////////////////

        
        ////////////////// QUESTION ROUTES STARTS ///////////////////
        Route::post('questions/list',[QuestionController::class, 'list'])->name('questions.list');
        Route::delete('questions/destroy', [QuestionController::class, 'massDestroy'])->name('questions.massDestroy');
        Route::post('questions/new-question', [QuestionController::class, 'newQuestion'])->name('questions.new-question');
        Route::resource('questions', QuestionController::class);
        ////////////////// QUESTION ROUTES ENDS ///////////////////


        ////////////////// PROMPT ROUTES STARTS ///////////////////
        Route::post('prompts/list', [PromptController::class, 'list'])->name('prompts.list');
        Route::delete('prompts/destroy', [PromptController::class, 'massDestroy'])->name('prompts.massDestroy');
        Route::resource('prompts', PromptController::class);
        ////////////////// PROMPT ROUTES ENDS ///////////////////


        ////////////////// SETTING ROUTES STARTS ///////////////////
        Route::get('settings/ai-solutions', [SettingsController::class, 'aiSolutions'])->name('settings.ai-solutions');
        Route::get('settings/brand', [SettingsController::class, 'brand'])->name('settings.brand');
        // Route::put('settings-update-brand/{setting}', [SettingsController::class, 'updateBrand'])->name('settings.update-brand');
        Route::put('settings-update-brand', [SettingsController::class, 'updateBrand'])->name('settings.update-brand');

        Route::put('settings-colors', [SettingsController::class, 'store'])->name('settings.colors.update');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::get('settings/google', [SettingsController::class, 'google'])->name('settings.google');
        Route::get('settings/custom-header', [SettingsController::class, 'customHeader'])->name('settings.custom-header');
        Route::get('settings/payment-settings', [SettingsController::class, 'payment'])->name('settings.payment');
        Route::get('rewardful', [SettingsController::class, 'rewardful'])->name('rewardful');
        Route::post('settings/media', [SettingsController::class, 'storeMedia'])->name('settings.storeMedia');
        Route::put('settings/admin-wallet-key', [SettingsController::class, 'adminWalletKey'])->name('settings.admin-wallet-key');
        ////////////////// SETTING ROUTES ENDS ///////////////////


        ////////////////// THEME ROUTES STARTS ///////////////////
        Route::get('themes/activate/{theme}', [ThemeController::class, 'activate'])->name('themes.activate');
        Route::get('themes', [ThemeController::class, 'index'])->name('themes.index');
        Route::post('themes-activate-new', [ThemeController::class, 'themes_activate_new'])->name('themes.activate.new');
        ////////////////// THEME ROUTES ENDS ///////////////////


        ////////////////// LOCALE ROUTES STARTS ///////////////////
        Route::delete('locales/destroy', [LocaleController::class, 'massDestroy'])->name('locales.massDestroy');
        Route::get('locales/switch', [LocaleController::class, 'switchLang'])->name('locales.switch');
        Route::resource('locales', LocaleController::class);
        ////////////////// LOCALE ROUTES ENDS ///////////////////


        ////////////////// USERS ROUTES STARTS ///////////////////
        Route::post('users/list', [UsersController::class, 'list'])->name('users.list');
        Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
        Route::resource('users', UsersController::class);        
        // GET USER WALLET DETAILS 
        Route::get('users/walletDetails', [UsersController::class, 'walletDetails'])->name('users.walletDetails');
        Route::post('/save-tokens', [UsersController::class,'saveTokens'])->name('save-tokens');
        ////////////////// USERS ROUTES STARTS ///////////////////


        ////////////////// CHANGE-PASSWORD ROUTES STARTS ///////////////////
        Route::get('change-password', [HomeController::class, 'changePassword'])->name('changePassword');
        Route::post('profile-update', [HomeController::class,'profileUpdate'])->name('profileUpdate');
        Route::post('password-update', [HomeController::class,'passwordUpdate'])->name('passwordUpdate');
        ////////////////// CHANGE-PASSWORD ROUTES STARTS ///////////////////


    });
    });
});

///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// ADMIN ROUTES END //////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////





///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// USER ROUTES START //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('/discord-login', [UserAuthController::class, 'discordLogin'])->name('discordLogin');
Route::get('/oauth2/login/redirect',  [UserAuthController::class, 'handleDiscordCallback'])->name('discord.callback');

// NEW LOGIN AND REGISTER ROUTES STARTS 
Route::get('loggin',  [UserAuthController::class, 'handleLoggin'])->name('handleLoggin');
Route::get('registerr',  [UserAuthController::class, 'handleRegisterr'])->name('handleRegisterr');
Route::post('/user-login', [UserAuthController::class, 'userLogin'])->name('userLogin');
Route::post('/user-register', [UserAuthController::class, 'userRegister'])->name('userRegister');

Route::get('/forgot-password', [UserAuthController::class, 'userForgotPassword'])->name('userForgotPassword');
Route::post('/forgot-password-post', [UserAuthController::class, 'userForgotPasswordPost'])->name('userForgotPasswordPost');
Route::get('/reset-password/{token}', [UserAuthController::class, 'resetUserPassword'])->name('userPassword.reset');
Route::post('/update-password-post', [UserAuthController::class, 'updateUserPasswordPost'])->name('userUpdatePasswordPost');
    
// NEW LOGIN AND REGISTER ROUTES ENDS 


Route::group(['middleware' => 'auth.user'], function () {
    //////// DARK OR LIGHT MODE STARTS ////////////
    Route::post('user-theme-data', [UserAuthController::class, 'getThemeData'])->name('getThemeData');
    //////// DARK OR LIGHT MODE ENDS ////////////
    Route::post('user-logout', [UserAuthController::class, 'userLogout'])->name('userLogout');
    Route::get('user-dashboard', [UHC::class, 'userDashboard'])->name('userDashboard');

    //////////////////// TOOLS ROUTES STARTS ////////////////////
    Route::get('tools/{id}', [ToolsController::class, 'toolsIndex'])->name('tools.index');
    Route::get('tools-prompts/{id}', [ToolsController::class, 'toolsPromptsIndex'])->name('tools.prompt.index');
    Route::post('tools-prompts/store', [ToolsController::class, 'toolsPromptsStore'])->name('tools.prompt.store');
    Route::post('tools-prompts-image/store', [ToolsController::class, 'toolsPromptsStoreImage'])->name('tools.prompt.image.store');
    //////////////////// TOOLS ROUTES ENDS /////////////////////

    //////////////////// CHATS ROUTES STARTS ////////////////////
    Route::get('chat', [ChatController::class, 'chatIndex'])->name('chat.index');
    Route::post('chat-store', [ChatController::class, 'chatStore'])->name('chat.store');
    Route::post('chat-delete-single/{id}', [ChatController::class, 'chatDeleteSingle'])->name('chat.delete.single');
    Route::post('chat-delete-all', [ChatController::class, 'chatDeleteAll'])->name('chat.delete.all');
    // another response generation
    Route::post('chat-update', [ChatController::class, 'chatUpdate'])->name('chat.update');
    //////////////////// CHATS ROUTES ENDS //////////////////////


    //////////////////// PROFILE ROUTES STARTS ////////////////////
    Route::get('profile', [ProfileController::class, 'profileIndex'])->name('profile.index');
    Route::post('profile-update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile-upload', [ProfileController::class, 'profileUpload'])->name('profile.upload');
    Route::post('profile-delete', [ProfileController::class, 'profileDelete'])->name('profile.delete');
    //////////////////// PROFILE ROUTES ENDS //////////////////////


    //////////////////// SUBSCRIPTION ROUTES STARTS ////////////////////
    Route::get('subscription', [SubscriptionController::class, 'subscriptionIndex'])->name('subscription.index');
    Route::post('subscription/generate-address', [SubscriptionController::class, 'subscriptionGenerateAddress'])->name('subscription.generate.address');
    //////////////////// SUBSCRIPTION ROUTES ENDS //////////////////////


    //////////////////// MISECELLANOUS ROUTES STARTS ////////////////////
    Route::post('getUserWalletData', [UHC::class, 'getUserWalletData'])->name('getUserWalletData');
    //////////////////// MISECELLANOUS ROUTES ENDS //////////////////////
    

});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// USER ROUTES END ////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////