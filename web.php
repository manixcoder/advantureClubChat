<?php

use App\User;

Route::get('clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    Session::flash('success', 'All Clear');
    echo "DONE";
});

Route::get('update-site', function () {
    $data['content'] = 'errors.comming-soon';
    return view('layouts.content', compact('data'));
});
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('admin.admin-login');
    }
});
Route::get('add-partner', function () {
    $data['content'] = 'admin.partners.add_partner';
    return view('layouts.content', compact('data'));
});
Route::get('partner-details', function () {
    $data['content'] = 'admin.partners.view_partner';
    return view('layouts.content', compact('data'));
});

Auth::routes();
Route::get('user-profile', 'HomeController@UserProfile');
Route::any('edit-userprofile', 'HomeController@UpdateProfile');
Route::get('home', function () {
    return redirect('dashboard');
});
Route::get('dashboard', 'DashboardController@dashboard');
Route::post('update-profile-image/{id}', 'HomeController@update_profile_image');
Route::post('update-user-profile-image', 'HomeController@update_user_profile_image');

Route::get('/forgot-password', 'ForgotPasswordController@getEmail');
Route::post('/forgot-password', 'ForgotPasswordController@postEmail');

Route::get('/reset-password/{token}', 'ResetPasswordController@getPassword');
Route::post('/reset-password', 'ResetPasswordController@updatePassword');
/* users all routes start */
Route::any('users', 'HomeController@user_view');
Route::any('add-user', 'HomeController@add_user');
Route::any('user-edit/{id}', 'HomeController@user_edit');
Route::any('user-view/{id}', 'HomeController@view_user');
Route::any('delete-user/{id}', 'HomeController@user_delete');
Route::any('vendor-request', 'HomeController@vendor_requests');
Route::any('vendor-request-decline/{id}', 'HomeController@vendor_notapprove');
Route::any('user-approve/{id}', 'HomeController@vendor_approve');
Route::any('update-user-password/{id}', 'HomeController@update_user_password');
Route::any('update-user-new-password', 'HomeController@update_user_newpassword');
/* users all routes End */
/* users all routes start */
Route::any('customers', 'HomeController@customer_view');
Route::any('delete-customer/{id}', 'HomeController@customer_delete');
Route::any('delete-user/{id}', 'HomeController@user_delete');
/* users all routes End */
/* Locations starts */
Route::get('countries/{id?}', 'LocationController@getCountries')->where(['id' => '[0-9]+']);
Route::get('countries/add/{id?}', 'LocationController@addCountry')->where(['id' => '[0-9]+']);
Route::post('countries/add/{id?}', 'LocationController@addCountry')->where(['id' => '[0-9]+']);
Route::get('countries/delete/{id}', 'LocationController@deleteCountries');

Route::get('cities/{id?}', 'LocationController@getCities')->where(['id' => '[0-9]+']);
Route::get('cities/add/{id?}', 'LocationController@addCities')->where(['id' => '[0-9]+']);
Route::post('cities/add/{id?}', 'LocationController@addCities')->where(['id' => '[0-9]+']);
Route::get('cities/delete/{id}', 'LocationController@deleteCities');

Route::get('regions/{id?}', 'LocationController@getRegions')->where(['id' => '[0-9]+']);
Route::get('regions/add/{id?}', 'LocationController@addRegions')->where(['id' => '[0-9]+']);
Route::post('regions/add/{id?}', 'LocationController@addRegions')->where(['id' => '[0-9]+']);
Route::get('regions/delete/{id}', 'LocationController@deleteRegions');
/* Locations ends */

/* AdventureUsersController all routes start */
Route::any('list-adventure-users', 'AdventureUsersController@list_adventure_users');
Route::get('add-adventure-users', function () {
    $data['content'] = 'admin.adventure_users.add_adventure_users';
    return view('layouts.content', compact('data'));
});
Route::any('view-adventure-user/{id}', 'AdventureUsersController@view_adventure_user');
Route::any('add-adventure-user', 'AdventureUsersController@add_adventure_user');
Route::get('delete-adventure-user/delete/{id}', 'AdventureUsersController@deleteUser')->where(['id' => '[0-9]+']);
Route::any('delete-customer/{id}', 'HomeController@customer_delete');
Route::any('delete-user/{id}', 'HomeController@user_delete');
Route::any('update-user-status/{id}', 'AdventureUsersController@update_user_status');
Route::any('notify-user/{id}', 'AdventureUsersController@notify-user');

Route::any('update-partner-status/{id}', 'AdventurePartnersController@update_partner_status');
/* AdventureUsersController all routes End */
/*Admin users*/
Route::any('list-admin-users', 'AdminUsersController@list_admin_users');
Route::any('view-admin-user/{id}', 'AdminUsersController@view_admin_user');
Route::any('add-admin-user', 'AdminUsersController@add_admin_user');
Route::any('delete-adminuser/{id}', 'AdminUsersController@adminuser_delete');


/*transactions*/
Route::any('transactions', 'TransactionsController@list_transactions');
Route::any('delete-transaction/{id}', 'TransactionsController@transaction_delete');
Route::any('roleaccess', 'UsersController@role_access');
Route::any('get-roles', 'UsersController@get_roles');

Route::any('save-country-session', 'UsersController@save_country_session');

/*Announcement*/
Route::any('announcement', 'TransactionsController@list_announcement');
Route::any('delete-announcement/{id}', 'TransactionsController@announcement_delete');

/*Question Reports*/
Route::any('questionreport', 'TransactionsController@list_questionreport');
Route::any('question_report/{id}', 'TransactionsController@questionreport_delete');

/* AdventurePartnersController all routes start */
Route::any('list-adventure-partners', 'AdventurePartnersController@list_adventure_partners');
Route::get('add-adventure-partners', function () {
    $data['content'] = 'admin.adventure_partners.add_adventure_partners';
    return view('layouts.content', compact('data'));
});
Route::any('add-adventure-partner', 'AdventurePartnersController@add_adventure_partner');
Route::any('view-adventure-partner/{id}', 'AdventurePartnersController@view_adventure_partner');
Route::get('delete-adventure-partner/delete/{id}', 'AdventurePartnersController@deleteUser')->where(['id' => '[0-9]+']);
/* AdventurePartnersController all routes ends */


Route::get('banners/{id?}', 'BannersController@index')->where(['id' => '[0-9]+']);
Route::get('banners/add', 'BannersController@add')->where(['id' => '[0-9]+']);
Route::post('banners/add/{id?}', 'BannersController@add')->where(['id' => '[0-9]+']);
Route::get('banners/delete/{id}', 'BannersController@delete')->where(['id' => '[0-9]+']);

Route::get('services/{type?}', 'ServicesController@get')->where(['type' => '[0-9]+']);
Route::get('services/add/{id?}', 'ServicesController@add')->where(['id' => '[0-9]+']);
Route::post('services/add/{id?}', 'ServicesController@add')->where(['id' => '[0-9]+']);
Route::get('service/detele/{id}', 'ServicesController@deleteService')->where(['id' => '[0-9]+']);
Route::get('service/view/{id?}', 'ServicesController@viewService')->where(['id' => '[0-9]+']);
Route::get('service/accept/{id}', 'ServicesController@acceptService')->where(['id' => '[0-9]+']);
Route::get('service/decline/{id}', 'ServicesController@declineService')->where(['id' => '[0-9]+']);
Route::get('service/participant/{id}', 'ServicesController@participant')->where(['id' => '[0-9]+']);
Route::get('requests/vendors/{id?}', 'UsersController@vendors')->where(['id' => '[0-9]+']);
Route::get('requests/adventures/{id?}', 'ServicesController@adventures')->where(['id' => '[0-9]+']);
Route::get('requests/adventures/view/{id?}', 'ServicesController@viewRequests')->where(['id' => '[0-9]+']);


Route::get('partner-requests/view/{id?}', 'ServicesController@viewPartnerRequests')->where(['id' => '[0-9]+']);


/*Service Offer starts*/
Route::get('list-service-offers/{id?}', 'ServiceOffersController@listServiceOffers');
Route::any('add-service-offer/{id?}', 'ServiceOffersController@addServiceOffers');
Route::get('list-reviews', 'ServicesController@listServiceReviews');
Route::get('delete-review/{id}', 'ServicesController@deleteServiceReviews')->where(['id' => '[0-9]+']);
Route::any('update-offer-status/{id}', 'ServiceOffersController@update_offer_status');
Route::get('service-offer/delete/{id}', 'ServiceOffersController@deleteServiceOffer')->where(['id' => '[0-9]+']);
/* Service Offer ends*/

/*Promocode starts */
Route::any('list-promocode', 'PromocodeController@list_promocode');
Route::get('add-promocodes', function () {
    $data['content'] = 'admin.promocode.add_promocodes';
    return view('layouts.content', compact('data'));
});
Route::any('add-promocode', 'PromocodeController@add_promocode');
Route::any('add-promocode/{id}', 'PromocodeController@edit_promocode');
Route::any('/promocode/delete/{id}', 'PromocodeController@delete_promo')->where(['id' => '[0-9]+']);
Route::any('update-promo-status/{id}', 'PromocodeController@update_promo_status');
/* Promocode ends*/

Route::get('selections/{id?}', 'SelectionsController@get')->where(['id' => '[0-9]+']);
Route::get('selections/add', 'SelectionsController@add');
Route::post('selections/add', 'SelectionsController@add');
Route::get('selections/delete/{tab_id?}/{item_id}', 'SelectionsController@delete')->where(['id' => '[0-9]+'])->where(['id' => '[0-9]+']);

Route::get('booking/detail/{id}', 'BookingsController@detail')->where(['id' => '[0-9]+']);
Route::get('booking/accept/{id}', 'BookingsController@accept')->where(['id' => '[0-9]+']);
Route::get('booking/decline/{id}', 'BookingsController@decline')->where(['id' => '[0-9]+']);

Route::get('terms-conditions', 'PagesController@termsConditions');
Route::get('terms-conditions/add', 'PagesController@addTermsConditions');
Route::post('terms-conditions/add', 'PagesController@addTermsConditions');

Route::get('privacy-policy', 'PagesController@privacyPolicies');
Route::get('privacy-policy/add', 'PagesController@addPrivacyPolicy');
Route::post('privacy-policy/add', 'PagesController@addPrivacyPolicy');

Route::get('about-us', 'PagesController@aboutUs');
Route::get('about-us/add', 'PagesController@addAboutUs');
Route::post('about-us/add', 'PagesController@addAboutUs');
//Route::get('transactions', 'PagesController@transactions');
Route::get('sub-packages', 'PackagesController@get');
Route::get('sub-packages/add', 'PackagesController@add');
Route::post('sub-packages/add', 'PackagesController@add');
Route::any('update-pkg-status/{id}', 'PackagesController@update_pkg_status');
Route::get('sub-packages/delete/{id}', 'PackagesController@delete_sub_pkg')->where(['id' => '[0-9]+']);

Route::post('/get_regions/{id}', 'ServicesController@getRegions')->where(['id' => '[0-9]+']);
Route::post('/get_city/{id}', 'ServicesController@getCity')->where(['id' => '[0-9]+']);
