<?php

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

// Landing Page
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index']);
// Route::redirect('/', '/dashboard');
Route::redirect('/home', '/dashboard');

Auth::routes(['verify' => true]);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/greeting', [App\Http\Controllers\DashboardController::class, 'greeting'])->name('dashboard.greeting');
Route::get('/dashboard/feedback', [App\Http\Controllers\DashboardController::class, 'feedback'])->name('dashboard.feedback');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/invitation/{template_category_name}/{user_url}/preview/{template_id}', [App\Http\Controllers\InvitationController::class, 'invitation_preview'])->name('invitation.preview');
Route::get('/invitation/{template_category_name}/{user_url}', [App\Http\Controllers\InvitationController::class, 'invitation'])->name('invitation.index');
Route::put('/invitation/{template_category_name}/{user_url}/update_presence', [App\Http\Controllers\InvitationController::class,'update_presence'])->name('invitation.guest.update_presence');
Route::post('/invitation/{template_category_name}/{user_url}/store_greeting', [App\Http\Controllers\InvitationController::class,'store_greeting'])->name('invitation.guest.store_greeting');
Route::get('/greeting/{template_category_id}/{user_id}/{paginate}', [App\Http\Controllers\InvitationController::class, 'get_greeting'])->name('greeting.get');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/slideshow/{template_category_name}/{user_url}', [App\Http\Controllers\SlideshowController::class, 'index'])->name('slideshow.index');
    Route::resource('/dashboard/setting', App\Http\Controllers\SettingController::class);
    Route::resource('/dashboard/wedding/template', App\Http\Controllers\Wedding\TemplateController::class);
    Route::resource('/dashboard/wedding/music', App\Http\Controllers\Wedding\MusicController::class);
    Route::post('/dashboard/wedding/music/post', [App\Http\Controllers\Wedding\MusicController::class,'store'])->name('wedding.music.store');
    Route::put('/dashboard/wedding/music/updatemusic/{id}', [App\Http\Controllers\Wedding\MusicController::class,'updatemusic'])->name('wedding.music.updatemusic');
    Route::delete('/dashboard/wedding/music/destroy/{id}', [App\Http\Controllers\Wedding\MusicController::class,'destroy'])->name('wedding.music.destroy');
    Route::resource('/dashboard/user', App\Http\Controllers\UserController::class);
    Route::put('/dashboard/user/updateImage/{id}', [App\Http\Controllers\UserController::class, 'updateImage'])->name('updateImage');
    Route::put('/dashboard/user/updatePassword/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword');
    Route::resource('/dashboard/wedding/gallery', App\Http\Controllers\Wedding\GalleryController::class);
    Route::put('/dashboard/wedding/gallery/updatesampul/{id}', [App\Http\Controllers\Wedding\GalleryController::class,'updatesampul'])->name('wedding.gallery.updatesampul');
    Route::put('/dashboard/wedding/gallery/destroysampul/{id}', [App\Http\Controllers\Wedding\GalleryController::class,'destroysampul'])->name('wedding.gallery.destroysampul');
    Route::put('/dashboard/wedding/gallery/destroygalleries/{id}', [App\Http\Controllers\Wedding\GalleryController::class,'destroygalleries'])->name('wedding.gallery.destroygalleries');
    Route::resource('/dashboard/wedding/event', App\Http\Controllers\Wedding\EventController::class);
    Route::resource('/dashboard/wedding/bride', App\Http\Controllers\Wedding\BrideController::class);
    Route::post('/dashboard/wedding/bride/updatephotobride/{gender}', [App\Http\Controllers\Wedding\BrideController::class, 'updatephotobride'])->name('updatephotobride');
    Route::resource('/dashboard/wedding/story', App\Http\Controllers\Wedding\StoryController::class);
    Route::put('/dashboard/wedding/story/destroystories/{id}', [App\Http\Controllers\Wedding\StoryController::class,'destroystories'])->name('wedding.story.destroystories');
    Route::put('/dashboard/wedding/story/updatestoryimg/{id}', [App\Http\Controllers\Wedding\StoryController::class,'updatestoryimg'])->name('updatestoryimg');
    Route::get('/dashboard/feedback/create', [App\Http\Controllers\FeedbackController::class,'create'])->name('feedback.create');
    Route::post('/dashboard/feedback/post', [App\Http\Controllers\FeedbackController::class,'store'])->name('feedback.store');
    Route::resource('/dashboard/wedding/guest',App\Http\Controllers\Wedding\GuestController::class);
    Route::get('/dashboard/wedding/guest/message/get',[App\Http\Controllers\Wedding\GuestController::class, 'message'])->name('guest.message');
    Route::patch('/dashboard/wedding/guest/message/update',[App\Http\Controllers\Wedding\GuestController::class, 'message_update'])->name('guest.message_update');
    Route::get('/dashboard/wedding/guest/message/send',[App\Http\Controllers\Wedding\GuestController::class, 'message_send'])->name('guest.message_send');
    Route::post('/dashboard/wedding/guest/destroyguests', [App\Http\Controllers\Wedding\GuestController::class, 'destroyguests'])->name('guest.destroyguests');
    Route::get('/dashboard/wedding/guest/routehelper/{route_name}/{msg}/{msg_content}', [App\Http\Controllers\Wedding\GuestController::class, 'routehelper'])->name('guest.routehelper');
    Route::resource('/dashboard/{template_category_name}/guest_presence',App\Http\Controllers\GuestPresenceController::class);
    Route::get('/dashboard/{template_category_name}/guest_presence/not_shown/first', [App\Http\Controllers\GuestPresenceController::class,'not_shown_first'])->name('guest_presence.not_shown_first');
    Route::resource('/dashboard/{template_category_name}/greeting',App\Http\Controllers\GreetingController::class);
    Route::get('/dashboard/{template_category_name}/greeting/get/{stat}', [App\Http\Controllers\GreetingController::class,'get_by_stat'])->name('greeting.get_by_stat');
    Route::resource('/dashboard/wedding/subscribe', App\Http\Controllers\Wedding\SubscribeController::class);
    Route::get('/dashboard/wedding/subscribe/select_package/{package_id}', [App\Http\Controllers\Wedding\SubscribeController::class, 'redirect_index_page_with_session_package'])->name('subscribe.index.package_id');
    Route::get('/dashboard/wedding/subscribe/redirect_order/{package_name}/{tab}', [App\Http\Controllers\Wedding\SubscribeController::class, 'redirect_order_page'])->name('subscribe.redirect_order');
    Route::resource('/dashboard/wedding/order', App\Http\Controllers\Wedding\OrderController::class);
    Route::get('/dashboard/wedding/order/redirect/{tab}', [App\Http\Controllers\Wedding\OrderController::class, 'redirect_page'])->name('order.redirect');
    Route::get('/dashboard/wedding/order/invoice/print/{id}', [App\Http\Controllers\Wedding\OrderController::class, 'print_invoice'])->name('order.print_invoice');
    Route::resource('/dashboard/wedding/invoicepayment', App\Http\Controllers\Wedding\InvoicePaymentController::class);
});

Route::middleware(['auth', 'role:Admin', 'verified'])->group(function () {
    Route::resource('/dashboard/master/template', App\Http\Controllers\TemplateController::class);
    Route::resource('/dashboard/master/template_category', App\Http\Controllers\TemplatecategoryController::class);
    Route::post('/dashboard/master/template_category/post', [App\Http\Controllers\TemplatecategoryController::class,'UpdatePost'])->name('template_category.UpdatePost');
    Route::delete('/dashboard/master/template_category/delall', [App\Http\Controllers\TemplatecategoryController::class, 'destroyMany'])->name('delall');
    Route::get('/dashboard/master/music', [App\Http\Controllers\MusicController::class,'index'])->name('music.index');
    Route::post('/dashboard/master/music/post', [App\Http\Controllers\MusicController::class,'store'])->name('music.store');
    Route::post('/dashboard/master/music/update', [App\Http\Controllers\MusicController::class,'update'])->name('music.update');
    Route::delete('/dashboard/master/music/destroy/{id}', [App\Http\Controllers\MusicController::class,'destroy'])->name('music.destroy');
    Route::get('/dashboard/master/feedback', [App\Http\Controllers\FeedbackController::class,'index'])->name('feedback.index');
    Route::get('/dashboard/master/feedback/edit/{id}',[App\Http\Controllers\FeedbackController::class,'edit'])->name('feedback.edit');
    Route::patch('/dashboard/master/feedback/update/{id}',[App\Http\Controllers\FeedbackController::class,'update'])->name('feedback.update');
    Route::patch('/dashboard/master/feedback/update_status/{id}',[App\Http\Controllers\FeedbackController::class,'update_status'])->name('feedback.update_status');
    Route::delete('/dashboard/master/feedback/destroy/{id}', [App\Http\Controllers\FeedbackController::class,'destroy'])->name('feedback.destroy');
    Route::delete('/dashboard/master/feedback/delete_all', [App\Http\Controllers\FeedbackController::class, 'deleteall'])->name('feedback.deleteall');
    Route::resource('/dashboard/master/admininvoicepayment', App\Http\Controllers\InvoicePaymentController::class);
});