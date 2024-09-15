<?php

use Illuminate\Support\Facades\Route;
use App\Models\CarStatus;

    Route::group([
    'prefix'     => 'admin',
    'namespace'  => 'Admin',
    'as'         => 'admin.',
    'middleware' => ['web-cors'],
], function () {

    Route::get('/lang/{lang}', 'AuthController@SetLanguage');

    Route::get('login', 'AuthController@showLoginForm')->name('show.login')->middleware('guest:admin');
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('logout', 'AuthController@logout')->name('logout');
    
    Route::get('forget-password', 'AuthController@showForgetPasswordForm')->name('show.forget-password');
    Route::post('forget-password', 'AuthController@forgetPassword')->name('forget-password');


    Route::get('resert-password/{admin}', 'AuthController@showResetPasswordForm')->name('show.reset-password');
    Route::post('reset-password', 'AuthController@resetPassword')->name('reset-password');

    Route::post('getCities', 'CityController@getCities')->name('getCities');

    Route::get('user_complaints/{id}', [
        'uses'  => 'ClientController@showfinancial',
        'as'    => 'user_complaints.show',
        'title' => 'the_resolution_of_complaining_or_proposal',
    ]);

    Route::get('user_orders/{id}', [
        'uses'  => 'ClientController@showorders',
        'as'    => 'user_orders.show',
        'title' => 'orders',
    ]);

    Route::group(['middleware' => ['admin', 'check-role', 'admin-lang']], function () {
        /*------------ start Of profile----------*/
        Route::get('profile', [
            'uses'      => 'HomeController@profile',
            'as'        => 'profile',
            'title'     => 'profile',
            'sub_route' => true,
            'type'      => 'parent',
            'child'     => ['profile.update_password', 'profile.update'],
        ]);

        Route::put('profile-update', [
            'uses'  => 'HomeController@updateProfile',
            'as'    => 'profile.update',
            'title' => 'update_profile',
        ]);
        Route::put('profile-update-password', [
            'uses'  => 'HomeController@updatePassword',
            'as'    => 'profile.update_password',
            'title' => 'update_password',
        ]);
        /*------------ end Of profile----------*/

        /*------------ start Of Dashboard----------*/
        Route::get('dashboard', [
            'uses'      => 'HomeController@dashboard',
            'as'        => 'dashboard',
            'icon'      => '<i class="feather icon-home"></i>',
            'title'     => 'main_page',
            'sub_route' => false,
            'type'      => 'parent',
        ]);
        /*------------ end Of dashboard ----------*/

        /*------------ start Of intro site  ----------*/
        // Route::get('intro-site', [
        //     'as'        => 'intro_site',
        //     'icon'      => '<i class="feather icon-map"></i>',
        //     'title'     => 'introductory_site',
        //     'type'      => 'parent',
        //     'sub_route' => true,
        //     'child'     => [
        //         'intro_settings.index', 'introsliders.show', 'introsliders.index', 'introsliders.store', 'introsliders.update', 'introsliders.delete', 'introsliders.deleteAll', 'introsliders.create', 'introsliders.edit',
        //         'introservices.show', 'introservices.index', 'introservices.create', 'introservices.store', 'introservices.edit', 'introservices.update', 'introservices.delete', 'introservices.deleteAll',
        //         'introfqscategories.show', 'introfqscategories.index', 'introfqscategories.store', 'introfqscategories.create', 'introfqscategories.edit', 'introfqscategories.update', 'introfqscategories.delete', 'introfqscategories.deleteAll',
        //         'introfqs.show', 'introfqs.index', 'introfqs.store', 'introfqs.update', 'introfqs.delete', 'introfqs.deleteAll', 'introfqs.edit', 'introfqs.create',
        //         'introparteners.create', 'introparteners.show', 'introparteners.index', 'introparteners.store', 'introparteners.update', 'introparteners.delete', 'introparteners.deleteAll',
        //         'intromessages.index', 'intromessages.delete', 'intromessages.deleteAll', 'intromessages.show',
        //         'introsocials.show', 'introsocials.index', 'introsocials.store', 'introsocials.update', 'introsocials.delete', 'introsocials.deleteAll', 'introsocials.edit', 'introsocials.create',
        //         'introparteners.edit', 'introhowworks.show', 'introhowworks.index', 'introhowworks.store', 'introhowworks.update', 'introhowworks.delete', 'introhowworks.deleteAll', 'introhowworks.create', 'introhowworks.edit',
        //     ],
        // ]);

        Route::get('intro-settings', [
            'uses'  => 'IntroSetting@index',
            'as'    => 'intro_settings.index',
            'title' => 'introductory_site_setting',
            'icon'  => '<i class="feather icon-settings"></i>',

        ]);

        /*------------ start Of introsliders ----------*/
        Route::get('introsliders', [
            'uses'  => 'IntroSliderController@index',
            'as'    => 'introsliders.index',
            'title' => 'insolder',
            'icon'  => '<i class="feather icon-image"></i>',
        ]);

        # introsliders update
        Route::get('introsliders/{id}/Show', [
            'uses'  => 'IntroSliderController@show',
            'as'    => 'introsliders.show',
            'title' => 'view_of_banner_page',
        ]);

        # socials store
        Route::get('introsliders/create', [
            'uses'  => 'IntroSliderController@create',
            'as'    => 'introsliders.create',
            'title' => 'add_of_banner_page',
        ]);

        # introsliders store
        Route::post('introsliders/store', [
            'uses'  => 'IntroSliderController@store',
            'as'    => 'introsliders.store',
            'title' => 'add_a_banner',
        ]);

        # socials update
        Route::get('introsliders/{id}/edit', [
            'uses'  => 'IntroSliderController@edit',
            'as'    => 'introsliders.edit',
            'title' => 'edit_of_banner_page',
        ]);

        # introsliders update
        Route::put('introsliders/{id}', [
            'uses'  => 'IntroSliderController@update',
            'as'    => 'introsliders.update',
            'title' => 'modification_of_banner',
        ]);

        # introsliders delete
        Route::delete('introsliders/{id}', [
            'uses'  => 'IntroSliderController@destroy',
            'as'    => 'introsliders.delete',
            'title' => 'delete_a_banner',
        ]);

        #delete all introsliders
        Route::post('delete-all-introsliders', [
            'uses'  => 'IntroSliderController@destroyAll',
            'as'    => 'introsliders.deleteAll',
            'title' => 'delete_multible_banner',
        ]);
        /*------------ end Of introsliders ----------*/

        /*------------ start Of introservices ----------*/
        Route::get('introservices', [
            'uses'  => 'IntroServiceController@index',
            'as'    => 'introservices.index',
            'title' => 'our_services',
            'icon'  => '<i class="la la-map"></i>',
        ]);
        # introservices update
        Route::get('introservices/{id}/Show', [
            'uses'  => 'IntroServiceController@show',
            'as'    => 'introservices.show',
            'title' => 'view_services',
        ]);
        # socials store
        Route::get('introservices/create', [
            'uses'  => 'IntroServiceController@create',
            'as'    => 'introservices.create',
            'title' => 'add_services',
        ]);
        # introservices store
        Route::post('introservices/store', [
            'uses'  => 'IntroServiceController@store',
            'as'    => 'introservices.store',
            'title' => 'add_services',
        ]);

        # socials update
        Route::get('introservices/{id}/edit', [
            'uses'  => 'IntroServiceController@edit',
            'as'    => 'introservices.edit',
            'title' => 'edit_services',
        ]);

        # introservices update
        Route::put('introservices/{id}', [
            'uses'  => 'IntroServiceController@update',
            'as'    => 'introservices.update',
            'title' => 'edit_services',
        ]);

        # introservices delete
        Route::delete('introservices/{id}', [
            'uses'  => 'IntroServiceController@destroy',
            'as'    => 'introservices.delete',
            'title' => 'delete_services',
        ]);

        #delete all introservices
        Route::post('delete-all-introservices', [
            'uses'  => 'IntroServiceController@destroyAll',
            'as'    => 'introservices.deleteAll',
            'title' => 'delete_multible_services',
        ]);
        /*------------ end Of introservices ----------*/

        /*------------ start Of introfqscategories ----------*/
        Route::get('introfqscategories', [
            'uses'  => 'IntroFqsCategoryController@index',
            'as'    => 'introfqscategories.index',
            'title' => 'Common-questions_sections',
            'icon'  => '<i class="la la-list"></i>',
        ]);
        # socials store
        Route::get('introfqscategories/create', [
            'uses'  => 'IntroFqsCategoryController@create',
            'as'    => 'introfqscategories.create',
            'title' => ' صفحة اضافة قسم',
        ]);
        # introfqscategories store
        Route::post('introfqscategories/store', [
            'uses'  => 'IntroFqsCategoryController@store',
            'as'    => 'introfqscategories.store',
            'title' => 'add_section',
        ]);
        # introfqscategories update
        Route::get('introfqscategories/{id}/edit', [
            'uses'  => 'IntroFqsCategoryController@edit',
            'as'    => 'introfqscategories.edit',
            'title' => 'edit_section_page',
        ]);
        # introfqscategories update
        Route::put('introfqscategories/{id}', [
            'uses'  => 'IntroFqsCategoryController@update',
            'as'    => 'introfqscategories.update',
            'title' => 'edit_section',
        ]);

        # introfqscategories update
        Route::get('introfqscategories/{id}/Show', [
            'uses'  => 'IntroFqsCategoryController@show',
            'as'    => 'introfqscategories.show',
            'title' => 'view_section_page',
        ]);

        # introfqscategories delete
        Route::delete('introfqscategories/{id}', [
            'uses'  => 'IntroFqsCategoryController@destroy',
            'as'    => 'introfqscategories.delete',
            'title' => 'delete_section',
        ]);

        #delete all introfqscategories
        Route::post('delete-all-introfqscategories', [
            'uses'  => 'IntroFqsCategoryController@destroyAll',
            'as'    => 'introfqscategories.deleteAll',
            'title' => 'delete_multible_section ',
        ]);
        /*------------ end Of introfqscategories ----------*/

        /*------------ start Of introfqs ----------*/
        Route::get('introfqs', [
            'uses'  => 'IntroFqsController@index',
            'as'    => 'introfqs.index',
            'title' => 'questions_sections',
            'icon'  => '<i class="la la-bullhorn"></i>',
        ]);

        # socials store
        Route::get('introfqs/create', [
            'uses'  => 'IntroFqsController@create',
            'as'    => 'introfqs.create',
            'title' => 'add_question',
        ]);

        # introfqs store
        Route::post('introfqs/store', [
            'uses'  => 'IntroFqsController@store',
            'as'    => 'introfqs.store',
            'title' => 'add_question',
        ]);
        # introfqscategories update
        Route::get('introfqs/{id}/edit', [
            'uses'  => 'IntroFqsController@edit',
            'as'    => 'introfqs.edit',
            'title' => 'edit_question',
        ]);
        # introfqscategories update
        Route::get('introfqs/{id}/Show', [
            'uses'  => 'IntroFqsController@show',
            'as'    => 'introfqs.show',
            'title' => 'view_question',
        ]);

        # introfqs update
        Route::put('introfqs/{id}', [
            'uses'  => 'IntroFqsController@update',
            'as'    => 'introfqs.update',
            'title' => 'edit_question',
        ]);

        # introfqs delete
        Route::delete('introfqs/{id}', [
            'uses'  => 'IntroFqsController@destroy',
            'as'    => 'introfqs.delete',
            'title' => 'delete_question',
        ]);

        #delete all introfqs
        Route::post('delete-all-introfqs', [
            'uses'  => 'IntroFqsController@destroyAll',
            'as'    => 'introfqs.deleteAll',
            'title' => 'delete_multible_question',
        ]);
        /*------------ end Of introfqs ----------*/

        /*------------ start Of introparteners ----------*/
        Route::get('introparteners', [
            'uses'  => 'IntroPartenerController@index',
            'as'    => 'introparteners.index',
            'title' => 'Success_Partners',
            'icon'  => '<i class="la la-list"></i>',
        ]);

        # introparteners update
        Route::get('introparteners/{id}/Show', [
            'uses'  => 'IntroPartenerController@show',
            'as'    => 'introparteners.show',
            'title' => 'view_partner_success',
        ]);

        # socials store
        Route::get('introparteners/create', [
            'uses'  => 'IntroPartenerController@create',
            'as'    => 'introparteners.create',
            'title' => 'add_partner',
        ]);

        # introparteners store
        Route::post('introparteners/store', [
            'uses'  => 'IntroPartenerController@store',
            'as'    => 'introparteners.store',
            'title' => 'add_partner',
        ]);

        # introparteners update
        Route::get('introparteners/{id}/edit', [
            'uses'  => 'IntroPartenerController@edit',
            'as'    => 'introparteners.edit',
            'title' => 'edit_partner',
        ]);

        # introparteners update
        Route::put('introparteners/{id}', [
            'uses'  => 'IntroPartenerController@update',
            'as'    => 'introparteners.update',
            'title' => 'edit_partner',
        ]);

        # introparteners delete
        Route::delete('introparteners/{id}', [
            'uses'  => 'IntroPartenerController@destroy',
            'as'    => 'introparteners.delete',
            'title' => 'delete_partner',
        ]);

        #delete all introparteners
        Route::post('delete-all-introparteners', [
            'uses'  => 'IntroPartenerController@destroyAll',
            'as'    => 'introparteners.deleteAll',
            'title' => 'delete_multible_partner',
        ]);
        /*------------ end Of introparteners ----------*/

        /*------------ start Of intromessages ----------*/
        Route::get('intromessages', [
            'uses'  => 'IntroMessagesController@index',
            'as'    => 'intromessages.index',
            'title' => 'Customer_messages',
            'icon'  => '<i class="la la-envelope-square"></i>',
        ]);

        # socials update
        Route::get('intromessages/{id}', [
            'uses'  => 'IntroMessagesController@show',
            'as'    => 'intromessages.show',
            'title' => 'view_message',
        ]);

        # intromessages delete
        Route::delete('intromessages/{id}', [
            'uses'  => 'IntroMessagesController@destroy',
            'as'    => 'intromessages.delete',
            'title' => 'delete_message',
        ]);

        #delete all intromessages
        Route::post('delete-all-intromessages', [
            'uses'  => 'IntroMessagesController@destroyAll',
            'as'    => 'intromessages.deleteAll',
            'title' => 'delete_multible_message',
        ]);
        /*------------ end Of intromessages ----------*/

        /*------------ start Of introsocials ----------*/
        Route::get('introsocials', [
            'uses'  => 'IntroSocialController@index',
            'as'    => 'introsocials.index',
            'title' => 'socials',
            'icon'  => '<i class="la la-facebook"></i>',
        ]);

        # introsocials update
        Route::get('introsocials/{id}/Show', [
            'uses'  => 'IntroSocialController@show',
            'as'    => 'introsocials.show',
            'title' => 'view_socials',
        ]);
        # introsocials store
        Route::get('introsocials/create', [
            'uses'  => 'IntroSocialController@create',
            'as'    => 'introsocials.create',
            'title' => 'add_socials',
        ]);

        # introsocials store
        Route::post('introsocials/store', [
            'uses'  => 'IntroSocialController@store',
            'as'    => 'introsocials.store',
            'title' => 'add_socials',
        ]);
        # introsocials update
        Route::get('introsocials/{id}/edit', [
            'uses'  => 'IntroSocialController@edit',
            'as'    => 'introsocials.edit',
            'title' => 'edit_socials',
        ]);

        # introsocials update
        Route::put('introsocials/{id}', [
            'uses'  => 'IntroSocialController@update',
            'as'    => 'introsocials.update',
            'title' => 'edit_socials',
        ]);

        # introsocials delete
        Route::delete('introsocials/{id}', [
            'uses'  => 'IntroSocialController@destroy',
            'as'    => 'introsocials.delete',
            'title' => 'delete_socials',
        ]);

        #delete all introsocials
        Route::post('delete-all-introsocials', [
            'uses'  => 'IntroSocialController@destroyAll',
            'as'    => 'introsocials.deleteAll',
            'title' => 'delete_multible_socials',
        ]);
        /*------------ end Of introsocials ----------*/

        /*------------ start Of introhowworks ----------*/
        Route::get('introhowworks', [
            'uses'  => 'IntroHowWorkController@index',
            'as'    => 'introhowworks.index',
            'title' => 'how_the_site_works',
            'icon'  => '<i class="la la-calendar-check-o"></i>',
        ]);

        # introhowworks store
        Route::get('introhowworks/create', [
            'uses'  => 'IntroHowWorkController@create',
            'as'    => 'introhowworks.create',
            'title' => 'add_a_way_to_work',
        ]);
        # introfqscategories update
        Route::get('introhowworks/{id}/Show', [
            'uses'  => 'IntroHowWorkController@show',
            'as'    => 'introhowworks.show',
            'title' => 'view_a_way_to_work',
        ]);

        # introhowworks update
        Route::get('introhowworks/{id}/edit', [
            'uses'  => 'IntroHowWorkController@edit',
            'as'    => 'introhowworks.edit',
            'title' => 'edit_a_way_to_work',
        ]);

        # introhowworks store
        Route::post('introhowworks/store', [
            'uses'  => 'IntroHowWorkController@store',
            'as'    => 'introhowworks.store',
            'title' => ' اضافة خطوه',
        ]);

        # introhowworks update
        Route::put('introhowworks/{id}', [
            'uses'  => 'IntroHowWorkController@update',
            'as'    => 'introhowworks.update',
            'title' => 'تحديث خطوه',
        ]);

        # introhowworks delete
        Route::delete('introhowworks/{id}', [
            'uses'  => 'IntroHowWorkController@destroy',
            'as'    => 'introhowworks.delete',
            'title' => 'حذف خطوه',
        ]);

        #delete all introhowworks
        Route::post('delete-all-introhowworks', [
            'uses'  => 'IntroHowWorkController@destroyAll',
            'as'    => 'introhowworks.deleteAll',
            'title' => 'حذف مجموعه من كيف نعمل',
        ]);
        /*------------ end Of introhowworks ----------*/

        /*------------ end Of intro site ----------*/

        /*------------ start Of users Controller ----------*/

        Route::get('all-users', [
            'as'        => 'all_users',
            'icon'      => '<i class="feather icon-users"></i>',
            'title'     => 'users',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => [
                'clients.index','clients.show', 'clients.block', 'clients.store', 'clients.update', 'clients.delete', 'clients.notify', 'clients.deleteAll', 'clients.create', 'clients.edit','clients.importFile','clients.updateBalance',
                'admins.index','admins.block', 'admins.store', 'admins.update', 'admins.edit','admins.delete', 'admins.deleteAll', 'admins.create', 'admins.edit', 'admins.notifications','admins.notifications.delete', 'admins.show',
            ],
        ]);

        Route::get('clients-show/{id?}', [
            'uses'  => 'ClientController@index',
            'as'    => 'clients.index',
            'icon'  => '<i class="feather icon-users"></i>',
            'title' => 'clients',
            // 'type'  => 'parent',
            // 'child' => ['clients.show', 'clients.block', 'clients.store', 'clients.update', 'clients.delete', 'clients.notify', 'clients.deleteAll', 'clients.create', 'clients.edit','clients.importFile','clients.updateBalance'],
        ]);

        # clients store
        Route::get('clients/create', [
            'uses'  => 'ClientController@create',
            'as'    => 'clients.create', 'clients.edit',
            'title' => 'add_client',
        ]);
        
        # clients update
        Route::get('clients/{id}/edit', [
            'uses'  => 'ClientController@edit',
            'as'    => 'clients.edit',
            'title' => 'edit_client',
        ]);
        #store
        Route::post('clients/store', [
            'uses'  => 'ClientController@store',
            'as'    => 'clients.store',
            'title' => 'add_client',
        ]);
        #block
        Route::post('clients/block', [
            'uses'  => 'ClientController@block',
            'as'    => 'clients.block',
            'title' => 'block_client',
        ]);

        #update
        Route::put('clients/{id}', [
            'uses'  => 'ClientController@update',
            'as'    => 'clients.update',
            'title' => 'edit_client',
        ]);

        #add or deduct balance
        Route::post('clients/update-balance', [
            'uses'  => 'ClientController@updateBalance',
            'as'    => 'clients.updateBalance',
            'title' => 'update_balance',
        ]);
        Route::get('clients/{id}/show', [
            'uses'  => 'ClientController@show',
            'as'    => 'clients.show',
            'title' => 'view_user',
        ]);

        #delete
        Route::delete('clients/{id}', [
            'uses'  => 'ClientController@destroy',
            'as'    => 'clients.delete',
            'title' => 'delete_user',
        ]);

        #delete
        Route::post('delete-all-clients', [
            'uses'  => 'ClientController@destroyAll',
            'as'    => 'clients.deleteAll',
            'title' => 'delete_multible_user',
        ]);

        #notify
        Route::post('admins/clients/notify', [
            'uses'  => 'ClientController@notify',
            'as'    => 'clients.notify',
            'title' => 'Send_user_notification',
        ]);
        #import
        Route::post('clients/importFile', [
            'uses'  => 'ClientController@importFile',
            'as'    => 'clients.importFile',
            'title' => 'importfile',
        ]); 
        /************ #Clients ************/
        /*------------ end Of users Controller ----------*/

        /************ Admins ************/
        #index
        Route::get('admins', [
            'uses'  => 'AdminController@index',
            'as'    => 'admins.index',
            'title' => 'admins',
            'icon'  => '<i class="feather icon-users"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'admins.block', 'admins.index', 'admins.store', 'admins.update', 'admins.edit',
            //     'admins.delete', 'admins.deleteAll', 'admins.create', 'admins.edit', 'admins.notifications',
            //     'admins.notifications.delete', 'admins.show',
            // ],
        ]);

        # admins store
        Route::get('show-notifications', [
            'uses'  => 'AdminController@notifications',
            'as'    => 'admins.notifications',
            'title' => 'notification_page',
        ]);

        #block
        Route::post('admins/block', [
            'uses'  => 'AdminController@block',
            'as'    => 'admins.block',
            'title' => 'block_admin',
        ]);

        # admins store
        Route::post('delete-notifications', [
            'uses'  => 'AdminController@deleteNotifications',
            'as'    => 'admins.notifications.delete',
            'title' => 'delete_notification',
        ]);

        # admins store
        Route::get('admins/create', [
            'uses'  => 'AdminController@create',
            'as'    => 'admins.create',
            'title' => 'add_admin',
        ]);

        #store
        Route::post('admins/store', [
            'uses'  => 'AdminController@store',
            'as'    => 'admins.store',
            'title' => 'add_admin',
        ]);

        # admins update
        Route::get('admins/{id}/edit', [
            'uses'  => 'AdminController@edit',
            'as'    => 'admins.edit',
            'title' => 'edit_admin',
        ]);
        #update
        Route::put('admins/{id}', [
            'uses'  => 'AdminController@update',
            'as'    => 'admins.update',
            'title' => 'edit_admin',
        ]);

        Route::get('admins/{id}/show', [
            'uses'  => 'AdminController@show',
            'as'    => 'admins.show',
            'title' => 'view_admin',
        ]);

        #delete
        Route::delete('admins/{id}', [
            'uses'  => 'AdminController@destroy',
            'as'    => 'admins.delete',
            'title' => 'delete_admin',
        ]);

        #delete
        Route::post('delete-all-admins', [
            'uses'  => 'AdminController@destroyAll',
            'as'    => 'admins.deleteAll',
            'title' => 'delete_multible_admin',
        ]);

        /************ #Admins ************/

        Route::get('project', [
            'as'        => 'project',
            'icon'      => '<i class="feather icon-list"></i>',
            'title'     => 'noor_alwahda',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => [
                // 'adminreports.index','adminreports.create', 'adminreports.store', 'adminreports.edit', 'adminreports.update', 'adminreports.show', 'adminreports.delete', 'adminreports.deleteAll',
                'categories.index','categories.export', 'categories.create', 'categories.store', 'categories.edit', 'categories.update', 'categories.delete', 'categories.deleteAll', 'categories.show',
                // 'settlements.index','settlements.show','settlements.changeStatus',
                'pricecategories.index','pricecategories.create', 'pricecategories.store','pricecategories.edit', 'pricecategories.update', 'pricecategories.show', 'pricecategories.delete'  ,'pricecategories.deleteAll' ,
                'pricetypes.index','pricetypes.create', 'pricetypes.store','pricetypes.edit', 'pricetypes.update', 'pricetypes.show', 'pricetypes.delete'  ,'pricetypes.deleteAll' ,
                'shippngpricelists.index','shippngpricelists.create', 'shippngpricelists.store','shippngpricelists.edit', 'shippngpricelists.update', 'shippngpricelists.show', 'shippngpricelists.delete'  ,'shippngpricelists.deleteAll' ,
                'news.index','news.create', 'news.store','news.edit', 'news.update', 'news.show', 'news.delete'  ,'news.deleteAll' ,
            ],
        ]);

       
        /*------------ start Of adminreports ----------*/
        Route::get('adminreports', [
            'uses'      => 'adminReportsController@AdminFinancial',
            'as'        => 'adminreports.index',
            'title'     => 'admin_financial_reports',
            'icon'      => '<i class="feather icon-dollar-sign"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['adminreports.create', 'adminreports.store', 'adminreports.edit', 'adminreports.update', 'adminreports.show', 'adminreports.delete', 'adminreports.deleteAll'],
        ]);

        # adminreports store
        Route::get('adminreports/create', [
            'uses'  => 'adminReportsController@create',
            'as'    => 'adminreports.create',
            'title' => ' صفحة اضافة تقرير',
        ]);

        # adminreports store
        Route::post('adminreports/store', [
            'uses'  => 'adminReportsController@store',
            'as'    => 'adminreports.store',
            'title' => ' اضافة تقرير',
        ]);

        # adminreports update
        Route::get('adminreports/{id}/edit', [
            'uses'  => 'adminReportsController@edit',
            'as'    => 'adminreports.edit',
            'title' => 'صفحه تحديث تقرير',
        ]);

        # adminreports update
        Route::put('adminreports/{id}', [
            'uses'  => 'adminReportsController@update',
            'as'    => 'adminreports.update',
            'title' => 'تحديث تقرير',
        ]);

        # adminreports show
        Route::get('adminreports/{id}/Show', [
            'uses'  => 'adminReportsController@show',
            'as'    => 'adminreports.show',
            'title' => 'صفحه عرض  تقرير  ',
        ]);

        # adminreports delete
        Route::delete('adminreports/{id}', [
            'uses'  => 'adminReportsController@destroy',
            'as'    => 'adminreports.delete',
            'title' => 'حذف تقرير',
        ]);
        #delete all adminreports
        Route::post('delete-all-adminreports', [
            'uses'  => 'adminReportsController@destroyAll',
            'as'    => 'adminreports.deleteAll',
            'title' => 'حذف مجموعه من التقارير',
        ]);
        /*------------ end Of adminreports ----------*/
    /*------------ start Of categories ----------*/
        Route::get('categories-show/{id?}', [
            'uses'      => 'CategoryController@index',
            'as'        => 'categories.index',
            'title'     => 'sections',
            'icon'      => '<i class="feather icon-list"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['categories.export', 'categories.create', 'categories.store', 'categories.edit', 'categories.update', 'categories.delete', 'categories.deleteAll', 'categories.show'],
        ]);

        # categories store
        Route::get('categories/export', [
            'uses'  => 'CategoryController@export',
            'as'    => 'categories.export',
            'title' => 'export',
        ]);
        # categories store
        Route::get('categories/create/{id?}', [
            'uses'  => 'CategoryController@create',
            'as'    => 'categories.create',
            'title' => 'add_section',
        ]);

        # categories store
        Route::post('categories/store', [
            'uses'  => 'CategoryController@store',
            'as'    => 'categories.store',
            'title' => 'add_section',
        ]);

        # categories update
        Route::get('categories/{id}/edit', [
            'uses'  => 'CategoryController@edit',
            'as'    => 'categories.edit',
            'title' => 'edit_section_page',
        ]);

        # categories update
        Route::put('categories/{id}', [
            'uses'  => 'CategoryController@update',
            'as'    => 'categories.update',
            'title' => 'edit_section',
        ]);

        Route::get('categories/{id}/show', [
            'uses'  => 'CategoryController@show',
            'as'    => 'categories.show',
            'title' => 'view_section',
        ]);

        # categories delete
        Route::delete('categories/{id}', [
            'uses'  => 'CategoryController@destroy',
            'as'    => 'categories.delete',
            'title' => 'delete_section',
        ]);
        #delete all categories
        Route::post('delete-all-categories', [
            'uses'  => 'CategoryController@destroyAll',
            'as'    => 'categories.deleteAll',
            'title' => 'delete_multible_section',
        ]);
        /*------------ end Of categories ----------*/
        /*------------ start Of Settlements----------*/
        Route::get('settlements', [
            'uses'      => 'SettlementController@index',
            'as'        => 'settlements.index',
            'title'     => 'Settlement_requests',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => [
            //     'settlements.show',
            //     'settlements.changeStatus',
            // ],
        ]);

        #Show Settlement
        Route::get('settlements/show/{id}', [
            'uses'  => 'SettlementController@show',
            'as'    => 'settlements.show',
            'title' => 'view_Settlement_order',
        ]);

        #Change Settlement Status
        Route::post('settlements/change-status', [
            'uses'  => 'SettlementController@settlementChangeStatus',
            'as'    => 'settlements.changeStatus',
            'title' => 'تغير حالة طلبات التسوية',
        ]);
        /*------------ end Of Settlements ----------*/
                /*------------ start Of notifications ----------*/
                Route::get('marketing', [
                    'as'        => 'marketing',
                    'icon'      => '<i class="feather icon-flag"></i>',
                    'title'     => 'marketing',
                    'type'      => 'parent',
                    'sub_route' => true,
                    'child'     => [
                        'notifications.index','notifications.send',
                        // 'coupons.index','coupons.show', 'coupons.create', 'coupons.store', 'coupons.edit', 'coupons.update', 'coupons.delete', 'coupons.deleteAll', 'coupons.renew',
                        'images.index','images.show', 'images.create', 'images.store', 'images.edit', 'images.update', 'images.delete', 'images.deleteAll',
                        'socials.index','socials.show', 'socials.create', 'socials.store', 'socials.show', 'socials.update', 'socials.edit', 'socials.delete', 'socials.deleteAll',
                        'intros.index','intros.show', 'intros.create', 'intros.store', 'intros.edit', 'intros.update', 'intros.delete', 'intros.deleteAll',
                        // 'seos.index','seos.show', 'seos.create', 'seos.edit', 'seos.index', 'seos.store', 'seos.update', 'seos.delete', 'seos.deleteAll',
                        // 'statistics.index',
                    ],
                ]);
        
                Route::get('notifications', [
                    'uses'      => 'NotificationController@index',
                    'as'        => 'notifications.index',
                    'title'     => 'notifications',
                    'icon'      => '<i class="ficon feather icon-bell"></i>',
                    // 'type'      => 'parent',
                    // 'sub_route' => false,
                    // 'child'     => ['notifications.send'],
                ]);
        
                # coupons store
                Route::post('send-notifications', [
                    'uses'  => 'NotificationController@sendNotifications',
                    'as'    => 'notifications.send',
                    'title' => 'send_notification_email_to_client',
                ]);
                /*------------ end Of notifications ----------*/
               /*------------ start Of coupons ----------*/
                Route::get('coupons', [
                    'uses'      => 'CouponController@index',
                    'as'        => 'coupons.index',
                    'title'     => 'coupons',
                    'icon'      => '<i class="fa fa-gift"></i>',
                    // 'type'      => 'parent',
                    // 'sub_route' => false,
                    // 'child'     => ['coupons.show', 'coupons.create', 'coupons.store', 'coupons.edit', 'coupons.update', 'coupons.delete', 'coupons.deleteAll', 'coupons.renew'],
                ]);
        
                Route::get('coupons/{id}/show', [
                    'uses'  => 'CouponController@show',
                    'as'    => 'coupons.show',
                    'title' => 'view_coupons',
                ]);
        
                # coupons store
                Route::get('coupons/create', [
                    'uses'  => 'CouponController@create',
                    'as'    => 'coupons.create',
                    'title' => 'add_coupons',
                ]);
        
                # coupons store
                Route::post('coupons/store', [
                    'uses'  => 'CouponController@store',
                    'as'    => 'coupons.store',
                    'title' => 'add_coupons',
                ]);
        
                # coupons update
                Route::get('coupons/{id}/edit', [
                    'uses'  => 'CouponController@edit',
                    'as'    => 'coupons.edit',
                    'title' => 'edit_coupons',
                ]);
        
                # coupons update
                Route::put('coupons/{id}', [
                    'uses'  => 'CouponController@update',
                    'as'    => 'coupons.update',
                    'title' => 'edit_coupons',
                ]);
        
                # renew coupon
                Route::post('coupons/renew', [
                    'uses'  => 'CouponController@renew',
                    'as'    => 'coupons.renew',
                    'title' => 'update_coupon_status',
                ]);
        
                # coupons delete
                Route::delete('coupons/{id}', [
                    'uses'  => 'CouponController@destroy',
                    'as'    => 'coupons.delete',
                    'title' => 'delete_coupons',
                ]);
                #delete all coupons
                Route::post('delete-all-coupons', [
                    'uses'  => 'CouponController@destroyAll',
                    'as'    => 'coupons.deleteAll',
                    'title' => 'delete_multible_coupons',
                ]);
                /*------------ end Of coupons ----------*/

                /*------------ start Of images ----------*/
                Route::get('images', [
                    'uses'      => 'ImageController@index',
                    'as'        => 'images.index',
                    'title'     => 'advertising_banners',
                    'icon'      => '<i class="feather icon-image"></i>',
                    // 'type'      => 'parent',
                    // 'sub_route' => false,
                    // 'child'     => ['images.show', 'images.create', 'images.store', 'images.edit', 'images.update', 'images.delete', 'images.deleteAll'],
                ]);
                Route::get('images/{id}/show', [
                    'uses'  => 'ImageController@show',
                    'as'    => 'images.show',
                    'title' => 'view_of_banner',
                ]);
                # images store
                Route::get('images/create', [
                    'uses'  => 'ImageController@create',
                    'as'    => 'images.create',
                    'title' => 'add_a_banner',
                ]);
        
                # images store
                Route::post('images/store', [
                    'uses'  => 'ImageController@store',
                    'as'    => 'images.store',
                    'title' => 'add_a_banner',
                ]);
        
                # images update
                Route::get('images/{id}/edit', [
                    'uses'  => 'ImageController@edit',
                    'as'    => 'images.edit',
                    'title' => 'modification_of_banner',
                ]);
        
                # images update
                Route::put('images/{id}', [
                    'uses'  => 'ImageController@update',
                    'as'    => 'images.update',
                    'title' => 'modification_of_banner',
                ]);
        
                # images delete
                Route::delete('images/{id}', [
                    'uses'  => 'ImageController@destroy',
                    'as'    => 'images.delete',
                    'title' => 'delete_a_banner',
                ]);
                #delete all images
                Route::post('delete-all-images', [
                    'uses'  => 'ImageController@destroyAll',
                    'as'    => 'images.deleteAll',
                    'title' => 'delete_multible_banner',
                ]);
                /*------------ end Of images ----------*/
        
                /*------------ start Of socials ----------*/
                Route::get('socials', [
                    'uses'      => 'SocialController@index',
                    'as'        => 'socials.index',
                    'title'     => 'socials',
                    'icon'      => '<i class="feather icon-message-circle"></i>',
                    // 'type'      => 'parent',
                    // 'sub_route' => false,
                    // 'child'     => ['socials.show', 'socials.create', 'socials.store', 'socials.show', 'socials.update', 'socials.edit', 'socials.delete', 'socials.deleteAll'],
                ]);
                # socials update
                Route::get('socials/{id}/Show', [
                    'uses'  => 'SocialController@show',
                    'as'    => 'socials.show',
                    'title' => 'view_socials',
                ]);
                # socials store
                Route::get('socials/create', [
                    'uses'  => 'SocialController@create',
                    'as'    => 'socials.create',
                    'title' => 'add_socials',
                ]);
        
                # socials store
                Route::post('socials', [
                    'uses'  => 'SocialController@store',
                    'as'    => 'socials.store',
                    'title' => 'add_socials',
                ]);
                # socials update
                Route::get('socials/{id}/edit', [
                    'uses'  => 'SocialController@edit',
                    'as'    => 'socials.edit',
                    'title' => 'edit_socials',
                ]);
                # socials update
                Route::put('socials/{id}', [
                    'uses'  => 'SocialController@update',
                    'as'    => 'socials.update',
                    'title' => 'edit_socials',
                ]);
        
                # socials delete
                Route::delete('socials/{id}', [
                    'uses'  => 'SocialController@destroy',
                    'as'    => 'socials.delete',
                    'title' => 'delete_socials',
                ]);
        
                #delete all socials
                Route::post('delete-all-socials', [
                    'uses'  => 'SocialController@destroyAll',
                    'as'    => 'socials.deleteAll',
                    'title' => 'delete_multible_socials',
                ]);
                /*------------ end Of socials ----------*/
        /*------------ start Of intros ----------*/
        Route::get('intros', [
            'uses'      => 'IntroController@index',
            'as'        => 'intros.index',
            'title'     => 'definition_pages',
            'icon'      => '<i class="feather icon-loader"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['intros.show', 'intros.create', 'intros.store', 'intros.edit', 'intros.update', 'intros.delete', 'intros.deleteAll'],
        ]);

        # intros update
        Route::get('intros/{id}/Show', [
            'uses'  => 'IntroController@show',
            'as'    => 'intros.show',
            'title' => 'view_a_profile_page',
        ]);

        # intros store
        Route::get('intros/create', [
            'uses'  => 'IntroController@create',
            'as'    => 'intros.create',
            'title' => 'add_a_profile_page',
        ]);

        # intros store
        Route::post('intros/store', [
            'uses'  => 'IntroController@store',
            'as'    => 'intros.store',
            'title' => 'add_a_profile_page',
        ]);

        # intros update
        Route::get('intros/{id}/edit', [
            'uses'  => 'IntroController@edit',
            'as'    => 'intros.edit',
            'title' => 'edit_a_profile_page',
        ]);

        # intros update
        Route::put('intros/{id}', [
            'uses'  => 'IntroController@update',
            'as'    => 'intros.update',
            'title' => 'edit_a_profile_page',
        ]);

        # intros delete
        Route::delete('intros/{id}', [
            'uses'  => 'IntroController@destroy',
            'as'    => 'intros.delete',
            'title' => 'delete_a_profile_page',
        ]);
        #delete all intros
        Route::post('delete-all-intros', [
            'uses'  => 'IntroController@destroyAll',
            'as'    => 'intros.deleteAll',
            'title' => 'delete_amultible_profile_page',
        ]);
        /*------------ end Of intros ----------*/

        /*------------ start Of seos ----------*/
        Route::get('seos', [
            'uses'  => 'SeoController@index',
            'as'    => 'seos.index',
            'title' => 'seo',
            'icon'  => '<i class="feather icon-list"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'seos.show', 'seos.create', 'seos.edit', 'seos.index', 'seos.store', 'seos.update', 'seos.delete', 'seos.deleteAll',
            // ],
        ]);
        # seos update
        Route::get('seos/{id}/Show', [
            'uses'  => 'SeoController@show',
            'as'    => 'seos.show',
            'title' => 'view_seo',
        ]);

        # seos store
        Route::get('seos/create', [
            'uses'  => 'SeoController@create',
            'as'    => 'seos.create',
            'title' => 'add_seo',
        ]);

        # seos update
        Route::get('seos/{id}/edit', [
            'uses'  => 'SeoController@edit',
            'as'    => 'seos.edit',
            'title' => 'edit_seo',
        ]);

        #store
        Route::post('seos/store', [
            'uses'  => 'SeoController@store',
            'as'    => 'seos.store',
            'title' => 'add_seo',
        ]);

        #update
        Route::put('seos/{id}', [
            'uses'  => 'SeoController@update',
            'as'    => 'seos.update',
            'title' => 'edit_seo',
        ]);

        #deletّe
        Route::delete('seos/{id}', [
            'uses'  => 'SeoController@destroy',
            'as'    => 'seos.delete',
            'title' => 'delete_seo',
        ]);
        #delete
        Route::post('delete-all-seos', [
            'uses'  => 'SeoController@destroyAll',
            'as'    => 'seos.deleteAll',
            'title' => 'delete_multible_seo',
        ]);
        /*------------ end Of seos ----------*/


        /*------------ start Of statistics ----------*/
        Route::get('statistics', [
            'uses'  => 'StatisticsController@index',
            'as'    => 'statistics.index',
            'title' => 'Statistics',
            'icon'  => '<i class="feather icon-activity"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'statistics.index',
            // ],
        ]);
        /*------------ end Of statistics ----------*/        
        /*------------ start Of countries ----------*/
        Route::get('countries-cities', [
            'as'        => 'countries_cities',
            'icon'      => '<i class="fa fa-map-marker"></i>',
            'title'     => 'countries_cities',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => [
                'countries.index','countries.show', 'countries.create', 'countries.store', 'countries.edit', 'countries.update', 'countries.delete', 'countries.deleteAll',
                'regions.index','regions.create', 'regions.store', 'regions.edit', 'regions.update', 'regions.show', 'regions.delete', 'regions.deleteAll',
                'cities.index','cities.create', 'cities.store', 'cities.edit', 'cities.show', 'cities.update', 'cities.delete', 'cities.deleteAll','cities.get-country-regions' 
            ],
        ]);

        Route::get('countries', [
            'uses'      => 'CountryController@index',
            'as'        => 'countries.index',
            'title'     => 'countries',
            'icon'      => '<i class="feather icon-flag"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['countries.show', 'countries.create', 'countries.store', 'countries.edit', 'countries.update', 'countries.delete', 'countries.deleteAll'],
        ]);

        Route::get('countries/{id}/show', [
            'uses'  => 'CountryController@show',
            'as'    => 'countries.show',
            'title' => 'view_country',
        ]);

        # countries store
        Route::get('countries/create', [
            'uses'  => 'CountryController@create',
            'as'    => 'countries.create',
            'title' => 'add_country',
        ]);

        # countries store
        Route::post('countries/store', [
            'uses'  => 'CountryController@store',
            'as'    => 'countries.store',
            'title' => 'add_country',
        ]);

        # countries update
        Route::get('countries/{id}/edit', [
            'uses'  => 'CountryController@edit',
            'as'    => 'countries.edit',
            'title' => 'edit_country',
        ]);

        # countries update
        Route::put('countries/{id}', [
            'uses'  => 'CountryController@update',
            'as'    => 'countries.update',
            'title' => 'edit_country',
        ]);

        # countries delete
        Route::delete('countries/{id}', [
            'uses'  => 'CountryController@destroy',
            'as'    => 'countries.delete',
            'title' => 'delete_country',
        ]);
        #delete all countries
        Route::post('delete-all-countries', [
            'uses'  => 'CountryController@destroyAll',
            'as'    => 'countries.deleteAll',
            'title' => 'delete_multible_country',
        ]);
        /*------------ end Of countries ----------*/

        /*------------ start Of regions ----------*/
        Route::get('regions', [
            'uses'      => 'RegionController@index',
            'as'        => 'regions.index',
            'title'     => 'regions',
            'icon'      => '<i class="fa fa-map-marker"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['regions.create', 'regions.store', 'regions.edit', 'regions.update', 'regions.show', 'regions.delete', 'regions.deleteAll'],
        ]);

        # regions store
        Route::get('regions/create', [
            'uses'  => 'RegionController@create',
            'as'    => 'regions.create',
            'title' => 'add_region_page',
        ]);

        # regions store
        Route::post('regions/store', [
            'uses'  => 'RegionController@store',
            'as'    => 'regions.store',
            'title' => 'add_region',
        ]);

        # regions update
        Route::get('regions/{id}/edit', [
            'uses'  => 'RegionController@edit',
            'as'    => 'regions.edit',
            'title' => 'update_region_page',
        ]);

        # regions update
        Route::put('regions/{id}', [
            'uses'  => 'RegionController@update',
            'as'    => 'regions.update',
            'title' => 'update_region',
        ]);

        # regions show
        Route::get('regions/{id}/Show', [
            'uses'  => 'RegionController@show',
            'as'    => 'regions.show',
            'title' => 'show_region_page',
        ]);

        # regions delete
        Route::delete('regions/{id}', [
            'uses'  => 'RegionController@destroy',
            'as'    => 'regions.delete',
            'title' => 'delete_region',
        ]);
        #delete all regions
        Route::post('delete-all-regions', [
            'uses'  => 'RegionController@destroyAll',
            'as'    => 'regions.deleteAll',
            'title' => 'delete_group_of_regions',
        ]);
/*------------ end Of regions ----------*/

        /*------------ start Of cities ----------*/
        Route::get('cities', [
            'uses'      => 'CityController@index',
            'as'        => 'cities.index',
            'title'     => 'cities',
            'icon'      => '<i class="feather icon-globe"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['cities.create', 'cities.store', 'cities.edit', 'cities.show', 'cities.update', 'cities.delete', 'cities.deleteAll'],
        ]);

        # cities store
        Route::get('cities/create', [
            'uses'  => 'CityController@create',
            'as'    => 'cities.create',
            'title' => 'add_city',
        ]);

        # cities store
        Route::post('cities/store', [
            'uses'  => 'CityController@store',
            'as'    => 'cities.store',
            'title' => 'add_city',
        ]);

        # cities update
        Route::get('cities/{id}/edit', [
            'uses'  => 'CityController@edit',
            'as'    => 'cities.edit',
            'title' => 'edit_city',
        ]);

        # cities update
        Route::put('cities/{id}', [
            'uses'  => 'CityController@update',
            'as'    => 'cities.update',
            'title' => 'edit_city',
        ]);

        Route::get('cities/{id}/show', [
            'uses'  => 'CityController@show',
            'as'    => 'cities.show',
            'title' => 'view_city',
        ]);

        # cities delete
        Route::delete('cities/{id}', [
            'uses'  => 'CityController@destroy',
            'as'    => 'cities.delete',
            'title' => 'delete_city',
        ]);
        #delete all cities
        Route::post('delete-all-cities', [
            'uses'  => 'CityController@destroyAll',
            'as'    => 'cities.deleteAll',
            'title' => 'delete_multible_city',
        ]);

        Route::get('get-country-regions', [
            'uses'  => 'CityController@getCountryRegions',
            'as'    => 'cities.get-country-regions',
            'title' => 'get_country_regions'
        ]); 
        /*------------ end Of cities ----------*/
        /*------------ start Of Settings----------*/
        Route::get('all-settings', [
            'as'        => 'all_settings',
            'icon'      => '<i class="feather icon-settings"></i>',
            'title'     => 'all_settings',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => [
                'fqs.index','fqs.show', 'fqs.create', 'fqs.store', 'fqs.edit', 'fqs.update', 'fqs.delete', 'fqs.deleteAll',
                'all_complaints','complaints.delete', 'complaints.deleteAll', 'complaints.show', 'complaint.replay',
                // 'sms.index','sms.update', 'sms.change',
                'roles.index', 'roles.create', 'roles.store', 'roles.edit', 'roles.update', 'roles.delete',
                'reports.index','reports.delete', 'reports.deleteAll', 'reports.show',
                'settings.index', 'settings.update', 'settings.message.all', 'settings.message.one', 'settings.send_email',
                // 'apphomes.index','apphomes.create', 'apphomes.store','apphomes.edit', 'apphomes.update', 'apphomes.show', 'apphomes.delete'  ,'apphomes.deleteAll' ,'apphomes.get-records-by-type',
            ],
        ]);
        /*------------ start Of fqs ----------*/
        Route::get('fqs', [
            'uses'      => 'FqsController@index',
            'as'        => 'fqs.index',
            'title'     => 'questions_sections',
            'icon'      => '<i class="feather icon-alert-circle"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['fqs.show', 'fqs.create', 'fqs.store', 'fqs.edit', 'fqs.update', 'fqs.delete', 'fqs.deleteAll'],
        ]);

        Route::get('fqs/{id}/show', [
            'uses'  => 'FqsController@show',
            'as'    => 'fqs.show',
            'title' => 'view_question',
        ]);

        # fqs store
        Route::get('fqs/create', [
            'uses'  => 'FqsController@create',
            'as'    => 'fqs.create',
            'title' => 'add_question',
        ]);

        # fqs store
        Route::post('fqs/store', [
            'uses'  => 'FqsController@store',
            'as'    => 'fqs.store',
            'title' => 'add_question',
        ]);

        # fqs update
        Route::get('fqs/{id}/edit', [
            'uses'  => 'FqsController@edit',
            'as'    => 'fqs.edit',
            'title' => 'edit_question',
        ]);

        # fqs update
        Route::put('fqs/{id}', [
            'uses'  => 'FqsController@update',
            'as'    => 'fqs.update',
            'title' => 'edit_question',
        ]);

        # fqs delete
        Route::delete('fqs/{id}', [
            'uses'  => 'FqsController@destroy',
            'as'    => 'fqs.delete',
            'title' => 'delete_question',
        ]);
        #delete all fqs
        Route::post('delete-all-fqs', [
            'uses'  => 'FqsController@destroyAll',
            'as'    => 'fqs.deleteAll',
            'title' => 'delete_multible_question',
        ]);
        /*------------ end Of fqs ----------*/
        /*------------ start Of complaints ----------*/
        Route::get('all-complaints', [
            'as'        => 'all_complaints',
            'uses'      => 'ComplaintController@index',
            'icon'      => '<i class="feather icon-mail"></i>',
            'title'     => 'complaints_and_proposals',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => [
            //     'complaints.delete', 'complaints.deleteAll', 'complaints.show', 'complaint.replay',
            // ],
        ]);

        # complaint replay
        Route::post('complaints-replay/{id}', [
            'uses'  => 'ComplaintController@replay',
            'as'    => 'complaint.replay',
            'title' => 'the_replay_of_complaining_or_proposal',
        ]);
        # socials update
        Route::get('complaints/{id}', [
            'uses'  => 'ComplaintController@show',
            'as'    => 'complaints.show',
            'title' => 'the_resolution_of_complaining_or_proposal',
        ]);

        # complaints delete
        Route::delete('complaints/{id}', [
            'uses'  => 'ComplaintController@destroy',
            'as'    => 'complaints.delete',
            'title' => 'delete_complaining',
        ]);

        #delete all complaints
        Route::post('delete-all-complaints', [
            'uses'  => 'ComplaintController@destroyAll',
            'as'    => 'complaints.deleteAll',
            'title' => 'delete_multibles_complaining',
        ]);
        /*------------ end Of complaints ----------*/
         /*------------ start Of sms ----------*/
         Route::get('sms', [
            'uses'      => 'SMSController@index',
            'as'        => 'sms.index',
            'title'     => 'message_packages',
            'icon'      => '<i class="feather icon-smartphone"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['sms.update', 'sms.change'],
        ]);
        # sms change
        Route::post('sms-change', [
            'uses'  => 'SMSController@change',
            'as'    => 'sms.change',
            'title' => 'message_update',
        ]);
        # sms update
        Route::put('sms/{id}', [
            'uses'  => 'SMSController@update',
            'as'    => 'sms.update',
            'title' => 'message_update',
        ]);
        /*------------ end Of sms ----------*/
        /*------------ start Of Roles----------*/
        Route::get('roles', [
            'uses'  => 'RoleController@index',
            'as'    => 'roles.index',
            'title' => 'Validities_list',
            'icon'  => '<i class="feather icon-eye"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'roles.index', 'roles.create', 'roles.store', 'roles.edit', 'roles.update', 'roles.delete',
            // ],
        ]);

        #add role page
        Route::get('roles/create', [
            'uses'  => 'RoleController@create',
            'as'    => 'roles.create',
            'title' => 'add_role',

        ]);

        #store role
        Route::post('roles/store', [
            'uses'  => 'RoleController@store',
            'as'    => 'roles.store',
            'title' => 'add_role',
        ]);

        #edit role page
        Route::get('roles/{id}/edit', [
            'uses'  => 'RoleController@edit',
            'as'    => 'roles.edit',
            'title' => 'edit_role',
        ]);

        #update role
        Route::put('roles/{id}', [
            'uses'  => 'RoleController@update',
            'as'    => 'roles.update',
            'title' => 'edit_role',
        ]);

        #delete role
        Route::delete('roles/{id}', [
            'uses'  => 'RoleController@destroy',
            'as'    => 'roles.delete',
            'title' => 'delete_role',
        ]);
        /*------------ end Of Roles----------*/
        /*------------ start Of reports----------*/
        Route::get('reports', [
            'uses'      => 'ReportController@index',
            'as'        => 'reports.index',
            'icon'      => '<i class="feather icon-edit-2"></i>',
            'title'     => 'reports',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['reports.delete', 'reports.deleteAll', 'reports.show'],
        ]);

        # reports show
        Route::get('reports/{id}', [
            'uses'  => 'ReportController@show',
            'as'    => 'reports.show',
            'title' => 'show_report',
        ]);
        # reports delete
        Route::delete('reports/{id}', [
            'uses'  => 'ReportController@destroy',
            'as'    => 'reports.delete',
            'title' => 'delete_report',
        ]);

        #delete all reports
        Route::post('delete-all-reports', [
            'uses'  => 'ReportController@destroyAll',
            'as'    => 'reports.deleteAll',
            'title' => 'delete_multible_report',
        ]);
        /*------------ end Of reports ----------*/
        Route::get('settings', [
            'uses'  => 'SettingController@index',
            'as'    => 'settings.index',
            'title' => 'setting',
            'icon'  => '<i class="feather icon-settings"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'settings.index', 'settings.update', 'settings.message.all', 'settings.message.one', 'settings.send_email',
            // ],
        ]);

        #update
        Route::put('settings', [
            'uses'  => 'SettingController@update',
            'as'    => 'settings.update',
            'title' => 'edit_setting',
        ]);

        #message all
        Route::post('settings/{type}/message-all', [
            'uses'  => 'SettingController@messageAll',
            'as'    => 'settings.message.all',
            'title' => 'message_all',
        ])->where('type', 'email|sms|notification');

        #message one
        Route::post('settings/{type}/message-one', [
            'uses'  => 'SettingController@messageOne',
            'as'    => 'settings.message.one',
            'title' => 'message_one',
        ])->where('type', 'email|sms|notification');

        #send email
        Route::post('settings/send-email', [
            'uses'  => 'SettingController@sendEmail',
            'as'    => 'settings.send_email',
            'title' => 'send_email',
        ]);
        /*------------ end Of Settings ----------*/
       /*------------ start Of apphomes ----------*/
       Route::get('apphomes', [
        'uses'      => 'AppHomeController@index',
        'as'        => 'apphomes.index',
        'title'     => 'apphomes',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['apphomes.create', 'apphomes.store','apphomes.edit', 'apphomes.update', 'apphomes.show', 'apphomes.delete'  ,'apphomes.deleteAll' ,'apphomes.get-records-by-type']
    ]);

    Route::get('get-records-by-type', [
        'uses'  => 'AppHomeController@getRecordsByType',
        'as'    => 'apphomes.get-records-by-type',
        'title' => 'get_records_by_type'
    ]); 

    # apphomes store
    Route::get('apphomes/create', [
        'uses'  => 'AppHomeController@create',
        'as'    => 'apphomes.create',
        'title' => 'add_apphome_page'
    ]);


    # apphomes store
    Route::post('apphomes/store', [
        'uses'  => 'AppHomeController@store',
        'as'    => 'apphomes.store',
        'title' => 'add_apphome'
    ]);

    # apphomes update
    Route::get('apphomes/{id}/edit', [
        'uses'  => 'AppHomeController@edit',
        'as'    => 'apphomes.edit',
        'title' => 'update_apphome_page'
    ]);

    # apphomes update
    Route::put('apphomes/{id}', [
        'uses'  => 'AppHomeController@update',
        'as'    => 'apphomes.update',
        'title' => 'update_apphome'
    ]);

    # apphomes show
    Route::get('apphomes/{id}/Show', [
        'uses'  => 'AppHomeController@show',
        'as'    => 'apphomes.show',
        'title' => 'show_apphome_page'
    ]);

    # apphomes delete
    Route::delete('apphomes/{id}', [
        'uses'  => 'AppHomeController@destroy',
        'as'    => 'apphomes.delete',
        'title' => 'delete_apphome'
    ]);
    #delete all apphomes
    Route::post('delete-all-apphomes', [
        'uses'  => 'AppHomeController@destroyAll',
        'as'    => 'apphomes.deleteAll',
        'title' => 'delete_group_of_apphomes'
    ]);
/*------------ end Of apphomes ----------*/
        
    /*------------ start Of cars ----------*/
    $childs = ['cars.index','cars.create', 'cars.store','cars.edit', 'cars.update', 'cars.show', 'cars.delete'  ,'cars.deleteAll' ];
    $statuses = CarStatus::orderBy('sort','ASC')->get();
    $i = 0;
    foreach($statuses as $status){
        Route::get('cars/status/'.$status->id, [
            'uses'  => 'CarController@carsByStatus',
            'as'    => 'cars.carsByStatus.'.$status->id,
            'title' => $status->name,
            'icon'      => '<i class="feather icon-image"></i>',
        ]);
        $childs[] = 'cars.carsByStatus.'.$status->id;
       
        // if($i > 0){
            Route::get('cars/change-status/'.$status->id, [
                'uses'  => 'CarController@changeStatus',
                'as'    => 'cars.carsChangeStatus.'.$status->id,
                'title' => $status->name,
            ]);
            $childs[] = 'cars.carsChangeStatus.'.$status->id;
        // }
        $i++;
    }

        Route::get('all-cars', [
            'uses'      => 'CarController@index',
            'as'        => 'all_cars',
            'title'     => 'cars',
            'icon'      => '<i class="feather icon-truck"></i>',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => $childs
        ]);
        
        Route::get('cars', [
            'uses'      => 'CarController@index',
            'as'        => 'cars.index',
            'title'     => 'all_cars',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['cars.create', 'cars.store','cars.edit', 'cars.update', 'cars.show', 'cars.delete'  ,'cars.deleteAll' ,]
        ]);

        # cars store
        Route::get('cars/create', [
            'uses'  => 'CarController@create',
            'as'    => 'cars.create',
            'title' => 'add_car_page'
        ]);


        # cars store
        Route::post('cars/store', [
            'uses'  => 'CarController@store',
            'as'    => 'cars.store',
            'title' => 'add_car'
        ]);

        # cars update
        Route::get('cars/{id}/edit', [
            'uses'  => 'CarController@edit',
            'as'    => 'cars.edit',
            'title' => 'update_car_page'
        ]);

        # cars update
        Route::put('cars/{id}', [
            'uses'  => 'CarController@update',
            'as'    => 'cars.update',
            'title' => 'update_car'
        ]);

        # cars show
        Route::get('cars/{id}/Show', [
            'uses'  => 'CarController@show',
            'as'    => 'cars.show',
            'title' => 'show_car_page'
        ]);

        # cars delete
        Route::delete('cars/{id}', [
            'uses'  => 'CarController@destroy',
            'as'    => 'cars.delete',
            'title' => 'delete_car'
        ]);
        #delete all cars
        Route::post('delete-all-cars', [
            'uses'  => 'CarController@destroyAll',
            'as'    => 'cars.deleteAll',
            'title' => 'delete_group_of_cars'
        ]);
    /*------------ end Of cars ----------*/
    
    /*------------ start Of carstatuses ----------*/
        Route::get('carstatuses', [
            'uses'      => 'CarStatusController@index',
            'as'        => 'carstatuses.index',
            'title'     => 'carstatuses',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['carstatuses.create', 'carstatuses.store','carstatuses.edit', 'carstatuses.update', 'carstatuses.show', 'carstatuses.delete'  ,'carstatuses.deleteAll' ,]
        ]);

        # carstatuses store
        Route::get('carstatuses/create', [
            'uses'  => 'CarStatusController@create',
            'as'    => 'carstatuses.create',
            'title' => 'add_carstatus_page'
        ]);


        # carstatuses store
        Route::post('carstatuses/store', [
            'uses'  => 'CarStatusController@store',
            'as'    => 'carstatuses.store',
            'title' => 'add_carstatus'
        ]);

        # carstatuses update
        Route::get('carstatuses/{id}/edit', [
            'uses'  => 'CarStatusController@edit',
            'as'    => 'carstatuses.edit',
            'title' => 'update_carstatus_page'
        ]);

        # carstatuses update
        Route::put('carstatuses/{id}', [
            'uses'  => 'CarStatusController@update',
            'as'    => 'carstatuses.update',
            'title' => 'update_carstatus'
        ]);

        # carstatuses show
        Route::get('carstatuses/{id}/Show', [
            'uses'  => 'CarStatusController@show',
            'as'    => 'carstatuses.show',
            'title' => 'show_carstatus_page'
        ]);

        # carstatuses delete
        Route::delete('carstatuses/{id}', [
            'uses'  => 'CarStatusController@destroy',
            'as'    => 'carstatuses.delete',
            'title' => 'delete_carstatus'
        ]);
        #delete all carstatuses
        Route::post('delete-all-carstatuses', [
            'uses'  => 'CarStatusController@destroyAll',
            'as'    => 'carstatuses.deleteAll',
            'title' => 'delete_group_of_carstatuses'
        ]);
    /*------------ end Of carstatuses ----------*/
    
    /*------------ start Of damagetypes ----------*/
        Route::get('damagetypes', [
            'uses'      => 'DamageTypesController@index',
            'as'        => 'damagetypes.index',
            'title'     => 'damagetypes',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['damagetypes.create', 'damagetypes.store','damagetypes.edit', 'damagetypes.update', 'damagetypes.show', 'damagetypes.delete'  ,'damagetypes.deleteAll' ,]
        ]);

        # damagetypes store
        Route::get('damagetypes/create', [
            'uses'  => 'DamageTypesController@create',
            'as'    => 'damagetypes.create',
            'title' => 'add_damagetypes_page'
        ]);


        # damagetypes store
        Route::post('damagetypes/store', [
            'uses'  => 'DamageTypesController@store',
            'as'    => 'damagetypes.store',
            'title' => 'add_damagetypes'
        ]);

        # damagetypes update
        Route::get('damagetypes/{id}/edit', [
            'uses'  => 'DamageTypesController@edit',
            'as'    => 'damagetypes.edit',
            'title' => 'update_damagetypes_page'
        ]);

        # damagetypes update
        Route::put('damagetypes/{id}', [
            'uses'  => 'DamageTypesController@update',
            'as'    => 'damagetypes.update',
            'title' => 'update_damagetypes'
        ]);

        # damagetypes show
        Route::get('damagetypes/{id}/Show', [
            'uses'  => 'DamageTypesController@show',
            'as'    => 'damagetypes.show',
            'title' => 'show_damagetypes_page'
        ]);

        # damagetypes delete
        Route::delete('damagetypes/{id}', [
            'uses'  => 'DamageTypesController@destroy',
            'as'    => 'damagetypes.delete',
            'title' => 'delete_damagetypes'
        ]);
        #delete all damagetypes
        Route::post('delete-all-damagetypes', [
            'uses'  => 'DamageTypesController@destroyAll',
            'as'    => 'damagetypes.deleteAll',
            'title' => 'delete_group_of_damagetypes'
        ]);
    /*------------ end Of damagetypes ----------*/
    /*------------ start Of pricecategories ----------*/
    Route::get('pricecategories', [
        'uses'      => 'PriceCategoriesController@index',
        'as'        => 'pricecategories.index',
        'title'     => 'pricecategories',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['pricecategories.create', 'pricecategories.store','pricecategories.edit', 'pricecategories.update', 'pricecategories.show', 'pricecategories.delete'  ,'pricecategories.deleteAll' ,]
    ]);

    # pricecategories store
    Route::get('pricecategories/create', [
        'uses'  => 'PriceCategoriesController@create',
        'as'    => 'pricecategories.create',
        'title' => 'add_pricecategories_page'
    ]);


    # pricecategories store
    Route::post('pricecategories/store', [
        'uses'  => 'PriceCategoriesController@store',
        'as'    => 'pricecategories.store',
        'title' => 'add_pricecategories'
    ]);

    # pricecategories update
    Route::get('pricecategories/{id}/edit', [
        'uses'  => 'PriceCategoriesController@edit',
        'as'    => 'pricecategories.edit',
        'title' => 'update_pricecategories_page'
    ]);

    # pricecategories update
    Route::put('pricecategories/{id}', [
        'uses'  => 'PriceCategoriesController@update',
        'as'    => 'pricecategories.update',
        'title' => 'update_pricecategories'
    ]);

    # pricecategories show
    Route::get('pricecategories/{id}/Show', [
        'uses'  => 'PriceCategoriesController@show',
        'as'    => 'pricecategories.show',
        'title' => 'show_pricecategories_page'
    ]);

    # pricecategories delete
    Route::delete('pricecategories/{id}', [
        'uses'  => 'PriceCategoriesController@destroy',
        'as'    => 'pricecategories.delete',
        'title' => 'delete_pricecategories'
    ]);
    #delete all pricecategories
    Route::post('delete-all-pricecategories', [
        'uses'  => 'PriceCategoriesController@destroyAll',
        'as'    => 'pricecategories.deleteAll',
        'title' => 'delete_group_of_pricecategories'
    ]);
/*------------ end Of pricecategories ----------*/
    /*------------ start Of pricetypes ----------*/
        Route::get('pricetypes', [
            'uses'      => 'PriceTypesController@index',
            'as'        => 'pricetypes.index',
            'title'     => 'pricetypes',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['pricetypes.create', 'pricetypes.store','pricetypes.edit', 'pricetypes.update', 'pricetypes.show', 'pricetypes.delete'  ,'pricetypes.deleteAll' ,]
        ]);

        # pricetypes store
        Route::get('pricetypes/create', [
            'uses'  => 'PriceTypesController@create',
            'as'    => 'pricetypes.create',
            'title' => 'add_pricetypes_page'
        ]);


        # pricetypes store
        Route::post('pricetypes/store', [
            'uses'  => 'PriceTypesController@store',
            'as'    => 'pricetypes.store',
            'title' => 'add_pricetypes'
        ]);

        # pricetypes update
        Route::get('pricetypes/{id}/edit', [
            'uses'  => 'PriceTypesController@edit',
            'as'    => 'pricetypes.edit',
            'title' => 'update_pricetypes_page'
        ]);

        # pricetypes update
        Route::put('pricetypes/{id}', [
            'uses'  => 'PriceTypesController@update',
            'as'    => 'pricetypes.update',
            'title' => 'update_pricetypes'
        ]);

        # pricetypes show
        Route::get('pricetypes/{id}/Show', [
            'uses'  => 'PriceTypesController@show',
            'as'    => 'pricetypes.show',
            'title' => 'show_pricetypes_page'
        ]);

        # pricetypes delete
        Route::delete('pricetypes/{id}', [
            'uses'  => 'PriceTypesController@destroy',
            'as'    => 'pricetypes.delete',
            'title' => 'delete_pricetypes'
        ]);
        #delete all pricetypes
        Route::post('delete-all-pricetypes', [
            'uses'  => 'PriceTypesController@destroyAll',
            'as'    => 'pricetypes.deleteAll',
            'title' => 'delete_group_of_pricetypes'
        ]);
    /*------------ end Of pricetypes ----------*/
    
    /*------------ start Of carbrands ----------*/
        Route::get('carbrands', [
            'uses'      => 'CarBrandsController@index',
            'as'        => 'carbrands.index',
            'title'     => 'carbrands',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['carbrands.create', 'carbrands.store','carbrands.edit', 'carbrands.update', 'carbrands.show', 'carbrands.delete'  ,'carbrands.deleteAll' ,]
        ]);

        # carbrands store
        Route::get('carbrands/create', [
            'uses'  => 'CarBrandsController@create',
            'as'    => 'carbrands.create',
            'title' => 'add_carbrands_page'
        ]);


        # carbrands store
        Route::post('carbrands/store', [
            'uses'  => 'CarBrandsController@store',
            'as'    => 'carbrands.store',
            'title' => 'add_carbrands'
        ]);

        # carbrands update
        Route::get('carbrands/{id}/edit', [
            'uses'  => 'CarBrandsController@edit',
            'as'    => 'carbrands.edit',
            'title' => 'update_carbrands_page'
        ]);

        # carbrands update
        Route::put('carbrands/{id}', [
            'uses'  => 'CarBrandsController@update',
            'as'    => 'carbrands.update',
            'title' => 'update_carbrands'
        ]);

        # carbrands show
        Route::get('carbrands/{id}/Show', [
            'uses'  => 'CarBrandsController@show',
            'as'    => 'carbrands.show',
            'title' => 'show_carbrands_page'
        ]);

        # carbrands delete
        Route::delete('carbrands/{id}', [
            'uses'  => 'CarBrandsController@destroy',
            'as'    => 'carbrands.delete',
            'title' => 'delete_carbrands'
        ]);
        #delete all carbrands
        Route::post('delete-all-carbrands', [
            'uses'  => 'CarBrandsController@destroyAll',
            'as'    => 'carbrands.deleteAll',
            'title' => 'delete_group_of_carbrands'
        ]);
        #import carbrands file
        Route::post('carbrands/importFile', [
            'uses'  => 'CarBrandsController@importFile',
            'as'    => 'carbrands.importFile',
            'title' => 'import_file'
        ]); 
    /*------------ end Of carbrands ----------*/
    
    /*------------ start Of carmodels ----------*/
        Route::get('carmodels', [
            'uses'      => 'CarModelsController@index',
            'as'        => 'carmodels.index',
            'title'     => 'carmodels',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['carmodels.create', 'carmodels.store','carmodels.edit', 'carmodels.update', 'carmodels.show', 'carmodels.delete'  ,'carmodels.deleteAll' ,]
        ]);

        # carmodels store
        Route::get('carmodels/create', [
            'uses'  => 'CarModelsController@create',
            'as'    => 'carmodels.create',
            'title' => 'add_carmodels_page'
        ]);


        # carmodels store
        Route::post('carmodels/store', [
            'uses'  => 'CarModelsController@store',
            'as'    => 'carmodels.store',
            'title' => 'add_carmodels'
        ]);

        # carmodels update
        Route::get('carmodels/{id}/edit', [
            'uses'  => 'CarModelsController@edit',
            'as'    => 'carmodels.edit',
            'title' => 'update_carmodels_page'
        ]);

        # carmodels update
        Route::put('carmodels/{id}', [
            'uses'  => 'CarModelsController@update',
            'as'    => 'carmodels.update',
            'title' => 'update_carmodels'
        ]);

        # carmodels show
        Route::get('carmodels/{id}/Show', [
            'uses'  => 'CarModelsController@show',
            'as'    => 'carmodels.show',
            'title' => 'show_carmodels_page'
        ]);

        # carmodels delete
        Route::delete('carmodels/{id}', [
            'uses'  => 'CarModelsController@destroy',
            'as'    => 'carmodels.delete',
            'title' => 'delete_carmodels'
        ]);
        #delete all carmodels
        Route::post('delete-all-carmodels', [
            'uses'  => 'CarModelsController@destroyAll',
            'as'    => 'carmodels.deleteAll',
            'title' => 'delete_group_of_carmodels'
        ]);
        #import carbrands file
        Route::post('carmodels/importFile', [
            'uses'  => 'CarModelsController@importFile',
            'as'    => 'carmodels.importFile',
            'title' => 'import_file'
        ]); 
    /*------------ end Of carmodels ----------*/
    
    /*------------ start Of carcolors ----------*/
    Route::get('carcolors', [
        'uses'      => 'CarColorsController@index',
        'as'        => 'carcolors.index',
        'title'     => 'carcolors',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['carcolors.create', 'carcolors.store','carcolors.edit', 'carcolors.update', 'carcolors.show', 'carcolors.delete'  ,'carcolors.deleteAll' ,]
    ]);

    # carcolors store
    Route::get('carcolors/create', [
        'uses'  => 'CarColorsController@create',
        'as'    => 'carcolors.create',
        'title' => 'add_carcolor_page'
    ]);


    # carcolors store
    Route::post('carcolors/store', [
        'uses'  => 'CarColorsController@store',
        'as'    => 'carcolors.store',
        'title' => 'add_carcolor'
    ]);

    # carcolors update
    Route::get('carcolors/{id}/edit', [
        'uses'  => 'CarColorsController@edit',
        'as'    => 'carcolors.edit',
        'title' => 'update_carcolor_page'
    ]);

    # carcolors update
    Route::put('carcolors/{id}', [
        'uses'  => 'CarColorsController@update',
        'as'    => 'carcolors.update',
        'title' => 'update_carcolor'
    ]);

    # carcolors show
    Route::get('carcolors/{id}/Show', [
        'uses'  => 'CarColorsController@show',
        'as'    => 'carcolors.show',
        'title' => 'show_carcolor_page'
    ]);

    # carcolors delete
    Route::delete('carcolors/{id}', [
        'uses'  => 'CarColorsController@destroy',
        'as'    => 'carcolors.delete',
        'title' => 'delete_carcolor'
    ]);
    #delete all carcolors
    Route::post('delete-all-carcolors', [
        'uses'  => 'CarColorsController@destroyAll',
        'as'    => 'carcolors.deleteAll',
        'title' => 'delete_group_of_carcolors'
    ]);
/*------------ end Of carcolors ----------*/
    
    /*------------ start Of caryears ----------*/
        Route::get('caryears', [
            'uses'      => 'CarYearsController@index',
            'as'        => 'caryears.index',
            'title'     => 'caryears',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['caryears.create', 'caryears.store','caryears.edit', 'caryears.update', 'caryears.show', 'caryears.delete'  ,'caryears.deleteAll' ,]
        ]);

        # caryears store
        Route::get('caryears/create', [
            'uses'  => 'CarYearsController@create',
            'as'    => 'caryears.create',
            'title' => 'add_caryears_page'
        ]);


        # caryears store
        Route::post('caryears/store', [
            'uses'  => 'CarYearsController@store',
            'as'    => 'caryears.store',
            'title' => 'add_caryears'
        ]);

        # caryears update
        Route::get('caryears/{id}/edit', [
            'uses'  => 'CarYearsController@edit',
            'as'    => 'caryears.edit',
            'title' => 'update_caryears_page'
        ]);

        # caryears update
        Route::put('caryears/{id}', [
            'uses'  => 'CarYearsController@update',
            'as'    => 'caryears.update',
            'title' => 'update_caryears'
        ]);

        # caryears show
        Route::get('caryears/{id}/Show', [
            'uses'  => 'CarYearsController@show',
            'as'    => 'caryears.show',
            'title' => 'show_caryears_page'
        ]);

        # caryears delete
        Route::delete('caryears/{id}', [
            'uses'  => 'CarYearsController@destroy',
            'as'    => 'caryears.delete',
            'title' => 'delete_caryears'
        ]);
        #delete all caryears
        Route::post('delete-all-caryears', [
            'uses'  => 'CarYearsController@destroyAll',
            'as'    => 'caryears.deleteAll',
            'title' => 'delete_group_of_caryears'
        ]);
    /*------------ end Of caryears ----------*/
    
    /*------------ start Of bodytypes ----------*/
        Route::get('bodytypes', [
            'uses'      => 'BodyTypesController@index',
            'as'        => 'bodytypes.index',
            'title'     => 'bodytypes',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['bodytypes.create', 'bodytypes.store','bodytypes.edit', 'bodytypes.update', 'bodytypes.show', 'bodytypes.delete'  ,'bodytypes.deleteAll' ,]
        ]);

        # bodytypes store
        Route::get('bodytypes/create', [
            'uses'  => 'BodyTypesController@create',
            'as'    => 'bodytypes.create',
            'title' => 'add_bodytypes_page'
        ]);


        # bodytypes store
        Route::post('bodytypes/store', [
            'uses'  => 'BodyTypesController@store',
            'as'    => 'bodytypes.store',
            'title' => 'add_bodytypes'
        ]);

        # bodytypes update
        Route::get('bodytypes/{id}/edit', [
            'uses'  => 'BodyTypesController@edit',
            'as'    => 'bodytypes.edit',
            'title' => 'update_bodytypes_page'
        ]);

        # bodytypes update
        Route::put('bodytypes/{id}', [
            'uses'  => 'BodyTypesController@update',
            'as'    => 'bodytypes.update',
            'title' => 'update_bodytypes'
        ]);

        # bodytypes show
        Route::get('bodytypes/{id}/Show', [
            'uses'  => 'BodyTypesController@show',
            'as'    => 'bodytypes.show',
            'title' => 'show_bodytypes_page'
        ]);

        # bodytypes delete
        Route::delete('bodytypes/{id}', [
            'uses'  => 'BodyTypesController@destroy',
            'as'    => 'bodytypes.delete',
            'title' => 'delete_bodytypes'
        ]);
        #delete all bodytypes
        Route::post('delete-all-bodytypes', [
            'uses'  => 'BodyTypesController@destroyAll',
            'as'    => 'bodytypes.deleteAll',
            'title' => 'delete_group_of_bodytypes'
        ]);
    /*------------ end Of bodytypes ----------*/
    
    /*------------ start Of enginetypes ----------*/
        Route::get('enginetypes', [
            'uses'      => 'EngineTypesController@index',
            'as'        => 'enginetypes.index',
            'title'     => 'enginetypes',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['enginetypes.create', 'enginetypes.store','enginetypes.edit', 'enginetypes.update', 'enginetypes.show', 'enginetypes.delete'  ,'enginetypes.deleteAll' ,]
        ]);

        # enginetypes store
        Route::get('enginetypes/create', [
            'uses'  => 'EngineTypesController@create',
            'as'    => 'enginetypes.create',
            'title' => 'add_enginetypes_page'
        ]);


        # enginetypes store
        Route::post('enginetypes/store', [
            'uses'  => 'EngineTypesController@store',
            'as'    => 'enginetypes.store',
            'title' => 'add_enginetypes'
        ]);

        # enginetypes update
        Route::get('enginetypes/{id}/edit', [
            'uses'  => 'EngineTypesController@edit',
            'as'    => 'enginetypes.edit',
            'title' => 'update_enginetypes_page'
        ]);

        # enginetypes update
        Route::put('enginetypes/{id}', [
            'uses'  => 'EngineTypesController@update',
            'as'    => 'enginetypes.update',
            'title' => 'update_enginetypes'
        ]);

        # enginetypes show
        Route::get('enginetypes/{id}/Show', [
            'uses'  => 'EngineTypesController@show',
            'as'    => 'enginetypes.show',
            'title' => 'show_enginetypes_page'
        ]);

        # enginetypes delete
        Route::delete('enginetypes/{id}', [
            'uses'  => 'EngineTypesController@destroy',
            'as'    => 'enginetypes.delete',
            'title' => 'delete_enginetypes'
        ]);
        #delete all enginetypes
        Route::post('delete-all-enginetypes', [
            'uses'  => 'EngineTypesController@destroyAll',
            'as'    => 'enginetypes.deleteAll',
            'title' => 'delete_group_of_enginetypes'
        ]);
    /*------------ end Of enginetypes ----------*/
    
    /*------------ start Of enginecylinders ----------*/
        Route::get('enginecylinders', [
            'uses'      => 'EngineCylindersController@index',
            'as'        => 'enginecylinders.index',
            'title'     => 'enginecylinders',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['enginecylinders.create', 'enginecylinders.store','enginecylinders.edit', 'enginecylinders.update', 'enginecylinders.show', 'enginecylinders.delete'  ,'enginecylinders.deleteAll' ,]
        ]);

        # enginecylinders store
        Route::get('enginecylinders/create', [
            'uses'  => 'EngineCylindersController@create',
            'as'    => 'enginecylinders.create',
            'title' => 'add_enginecylinders_page'
        ]);


        # enginecylinders store
        Route::post('enginecylinders/store', [
            'uses'  => 'EngineCylindersController@store',
            'as'    => 'enginecylinders.store',
            'title' => 'add_enginecylinders'
        ]);

        # enginecylinders update
        Route::get('enginecylinders/{id}/edit', [
            'uses'  => 'EngineCylindersController@edit',
            'as'    => 'enginecylinders.edit',
            'title' => 'update_enginecylinders_page'
        ]);

        # enginecylinders update
        Route::put('enginecylinders/{id}', [
            'uses'  => 'EngineCylindersController@update',
            'as'    => 'enginecylinders.update',
            'title' => 'update_enginecylinders'
        ]);

        # enginecylinders show
        Route::get('enginecylinders/{id}/Show', [
            'uses'  => 'EngineCylindersController@show',
            'as'    => 'enginecylinders.show',
            'title' => 'show_enginecylinders_page'
        ]);

        # enginecylinders delete
        Route::delete('enginecylinders/{id}', [
            'uses'  => 'EngineCylindersController@destroy',
            'as'    => 'enginecylinders.delete',
            'title' => 'delete_enginecylinders'
        ]);
        #delete all enginecylinders
        Route::post('delete-all-enginecylinders', [
            'uses'  => 'EngineCylindersController@destroyAll',
            'as'    => 'enginecylinders.deleteAll',
            'title' => 'delete_group_of_enginecylinders'
        ]);
    /*------------ end Of enginecylinders ----------*/
    
    /*------------ start Of transmissiontypes ----------*/
        Route::get('transmissiontypes', [
            'uses'      => 'transmissionTypesController@index',
            'as'        => 'transmissiontypes.index',
            'title'     => 'transmissiontypes',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['transmissiontypes.create', 'transmissiontypes.store','transmissiontypes.edit', 'transmissiontypes.update', 'transmissiontypes.show', 'transmissiontypes.delete'  ,'transmissiontypes.deleteAll' ,]
        ]);

        # transmissiontypes store
        Route::get('transmissiontypes/create', [
            'uses'  => 'transmissionTypesController@create',
            'as'    => 'transmissiontypes.create',
            'title' => 'add_transmissiontypes_page'
        ]);


        # transmissiontypes store
        Route::post('transmissiontypes/store', [
            'uses'  => 'transmissionTypesController@store',
            'as'    => 'transmissiontypes.store',
            'title' => 'add_transmissiontypes'
        ]);

        # transmissiontypes update
        Route::get('transmissiontypes/{id}/edit', [
            'uses'  => 'transmissionTypesController@edit',
            'as'    => 'transmissiontypes.edit',
            'title' => 'update_transmissiontypes_page'
        ]);

        # transmissiontypes update
        Route::put('transmissiontypes/{id}', [
            'uses'  => 'transmissionTypesController@update',
            'as'    => 'transmissiontypes.update',
            'title' => 'update_transmissiontypes'
        ]);

        # transmissiontypes show
        Route::get('transmissiontypes/{id}/Show', [
            'uses'  => 'transmissionTypesController@show',
            'as'    => 'transmissiontypes.show',
            'title' => 'show_transmissiontypes_page'
        ]);

        # transmissiontypes delete
        Route::delete('transmissiontypes/{id}', [
            'uses'  => 'transmissionTypesController@destroy',
            'as'    => 'transmissiontypes.delete',
            'title' => 'delete_transmissiontypes'
        ]);
        #delete all transmissiontypes
        Route::post('delete-all-transmissiontypes', [
            'uses'  => 'transmissionTypesController@destroyAll',
            'as'    => 'transmissiontypes.deleteAll',
            'title' => 'delete_group_of_transmissiontypes'
        ]);
    /*------------ end Of transmissiontypes ----------*/
    
    /*------------ start Of drivetypes ----------*/
        Route::get('drivetypes', [
            'uses'      => 'DriveTypesController@index',
            'as'        => 'drivetypes.index',
            'title'     => 'drivetypes',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['drivetypes.create', 'drivetypes.store','drivetypes.edit', 'drivetypes.update', 'drivetypes.show', 'drivetypes.delete'  ,'drivetypes.deleteAll' ,]
        ]);

        # drivetypes store
        Route::get('drivetypes/create', [
            'uses'  => 'DriveTypesController@create',
            'as'    => 'drivetypes.create',
            'title' => 'add_drivetypes_page'
        ]);


        # drivetypes store
        Route::post('drivetypes/store', [
            'uses'  => 'DriveTypesController@store',
            'as'    => 'drivetypes.store',
            'title' => 'add_drivetypes'
        ]);

        # drivetypes update
        Route::get('drivetypes/{id}/edit', [
            'uses'  => 'DriveTypesController@edit',
            'as'    => 'drivetypes.edit',
            'title' => 'update_drivetypes_page'
        ]);

        # drivetypes update
        Route::put('drivetypes/{id}', [
            'uses'  => 'DriveTypesController@update',
            'as'    => 'drivetypes.update',
            'title' => 'update_drivetypes'
        ]);

        # drivetypes show
        Route::get('drivetypes/{id}/Show', [
            'uses'  => 'DriveTypesController@show',
            'as'    => 'drivetypes.show',
            'title' => 'show_drivetypes_page'
        ]);

        # drivetypes delete
        Route::delete('drivetypes/{id}', [
            'uses'  => 'DriveTypesController@destroy',
            'as'    => 'drivetypes.delete',
            'title' => 'delete_drivetypes'
        ]);
        #delete all drivetypes
        Route::post('delete-all-drivetypes', [
            'uses'  => 'DriveTypesController@destroyAll',
            'as'    => 'drivetypes.deleteAll',
            'title' => 'delete_group_of_drivetypes'
        ]);
    /*------------ end Of drivetypes ----------*/
    
    /*------------ start Of fueltypes ----------*/
        Route::get('fueltypes', [
            'uses'      => 'FuelTypesController@index',
            'as'        => 'fueltypes.index',
            'title'     => 'fueltypes',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['fueltypes.create', 'fueltypes.store','fueltypes.edit', 'fueltypes.update', 'fueltypes.show', 'fueltypes.delete'  ,'fueltypes.deleteAll' ,]
        ]);

        # fueltypes store
        Route::get('fueltypes/create', [
            'uses'  => 'FuelTypesController@create',
            'as'    => 'fueltypes.create',
            'title' => 'add_fueltypes_page'
        ]);


        # fueltypes store
        Route::post('fueltypes/store', [
            'uses'  => 'FuelTypesController@store',
            'as'    => 'fueltypes.store',
            'title' => 'add_fueltypes'
        ]);

        # fueltypes update
        Route::get('fueltypes/{id}/edit', [
            'uses'  => 'FuelTypesController@edit',
            'as'    => 'fueltypes.edit',
            'title' => 'update_fueltypes_page'
        ]);

        # fueltypes update
        Route::put('fueltypes/{id}', [
            'uses'  => 'FuelTypesController@update',
            'as'    => 'fueltypes.update',
            'title' => 'update_fueltypes'
        ]);

        # fueltypes show
        Route::get('fueltypes/{id}/Show', [
            'uses'  => 'FuelTypesController@show',
            'as'    => 'fueltypes.show',
            'title' => 'show_fueltypes_page'
        ]);

        # fueltypes delete
        Route::delete('fueltypes/{id}', [
            'uses'  => 'FuelTypesController@destroy',
            'as'    => 'fueltypes.delete',
            'title' => 'delete_fueltypes'
        ]);
        #delete all fueltypes
        Route::post('delete-all-fueltypes', [
            'uses'  => 'FuelTypesController@destroyAll',
            'as'    => 'fueltypes.deleteAll',
            'title' => 'delete_group_of_fueltypes'
        ]);
    /*------------ end Of fueltypes ----------*/
    
    /*------------ start Of shippngpricelists ----------*/
        Route::get('shippngpricelists', [
            'uses'      => 'ShippngPriceListController@index',
            'as'        => 'shippngpricelists.index',
            'title'     => 'shippngpricelists',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['shippngpricelists.create', 'shippngpricelists.store','shippngpricelists.edit', 'shippngpricelists.update', 'shippngpricelists.show', 'shippngpricelists.delete'  ,'shippngpricelists.deleteAll' ,]
        ]);

        # shippngpricelists store
        Route::get('shippngpricelists/create', [
            'uses'  => 'ShippngPriceListController@create',
            'as'    => 'shippngpricelists.create',
            'title' => 'add_shippngpricelist_page'
        ]);


        # shippngpricelists store
        Route::post('shippngpricelists/store', [
            'uses'  => 'ShippngPriceListController@store',
            'as'    => 'shippngpricelists.store',
            'title' => 'add_shippngpricelist'
        ]);

        # shippngpricelists update
        Route::get('shippngpricelists/{id}/edit', [
            'uses'  => 'ShippngPriceListController@edit',
            'as'    => 'shippngpricelists.edit',
            'title' => 'update_shippngpricelist_page'
        ]);

        # shippngpricelists update
        Route::put('shippngpricelists/{id}', [
            'uses'  => 'ShippngPriceListController@update',
            'as'    => 'shippngpricelists.update',
            'title' => 'update_shippngpricelist'
        ]);

        # shippngpricelists show
        Route::get('shippngpricelists/{id}/Show', [
            'uses'  => 'ShippngPriceListController@show',
            'as'    => 'shippngpricelists.show',
            'title' => 'show_shippngpricelist_page'
        ]);

        # shippngpricelists delete
        Route::delete('shippngpricelists/{id}', [
            'uses'  => 'ShippngPriceListController@destroy',
            'as'    => 'shippngpricelists.delete',
            'title' => 'delete_shippngpricelist'
        ]);
        #delete all shippngpricelists
        Route::post('delete-all-shippngpricelists', [
            'uses'  => 'ShippngPriceListController@destroyAll',
            'as'    => 'shippngpricelists.deleteAll',
            'title' => 'delete_group_of_shippngpricelists'
        ]);
    /*------------ end Of shippngpricelists ----------*/
    
    /*------------ start Of news ----------*/
        Route::get('news', [
            'uses'      => 'NewsController@index',
            'as'        => 'news.index',
            'title'     => 'news',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['news.create', 'news.store','news.edit', 'news.update', 'news.show', 'news.delete'  ,'news.deleteAll' ,]
        ]);

        # news store
        Route::get('news/create', [
            'uses'  => 'NewsController@create',
            'as'    => 'news.create',
            'title' => 'add_news_page'
        ]);


        # news store
        Route::post('news/store', [
            'uses'  => 'NewsController@store',
            'as'    => 'news.store',
            'title' => 'add_news'
        ]);

        # news update
        Route::get('news/{id}/edit', [
            'uses'  => 'NewsController@edit',
            'as'    => 'news.edit',
            'title' => 'update_news_page'
        ]);

        # news update
        Route::put('news/{id}', [
            'uses'  => 'NewsController@update',
            'as'    => 'news.update',
            'title' => 'update_news'
        ]);

        # news show
        Route::get('news/{id}/Show', [
            'uses'  => 'NewsController@show',
            'as'    => 'news.show',
            'title' => 'show_news_page'
        ]);

        # news delete
        Route::delete('news/{id}', [
            'uses'  => 'NewsController@destroy',
            'as'    => 'news.delete',
            'title' => 'delete_news'
        ]);
        #delete all news
        Route::post('delete-all-news', [
            'uses'  => 'NewsController@destroyAll',
            'as'    => 'news.deleteAll',
            'title' => 'delete_group_of_news'
        ]);
    /*------------ end Of news ----------*/
    
    
    
    /*------------ start Of carfinances ----------*/
        Route::get('carfinances', [
            'uses'      => 'CarFinanceController@index',
            'as'        => 'carfinances.index',
            'title'     => 'carfinances',
            'icon'      => '<i class="feather icon-dollar-sign"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['carfinances.create', 'carfinances.store','carfinances.edit', 'carfinances.update', 'carfinances.show', 'carfinances.delete'  ,'carfinances.deleteAll' ,]
        ]);

        # carfinances store
        Route::get('carfinances/create', [
            'uses'  => 'CarFinanceController@create',
            'as'    => 'carfinances.create',
            'title' => 'add_carfinance_page'
        ]);


        # carfinances store
        Route::post('carfinances/store', [
            'uses'  => 'CarFinanceController@store',
            'as'    => 'carfinances.store',
            'title' => 'add_carfinance'
        ]);

        # carfinances update
        Route::get('carfinances/{id}/edit', [
            'uses'  => 'CarFinanceController@edit',
            'as'    => 'carfinances.edit',
            'title' => 'update_carfinance_page'
        ]);

        # carfinances update
        Route::put('carfinances/{id}', [
            'uses'  => 'CarFinanceController@update',
            'as'    => 'carfinances.update',
            'title' => 'update_carfinance'
        ]);

        # carfinances show
        Route::get('carfinances/{id}/Show', [
            'uses'  => 'CarFinanceController@show',
            'as'    => 'carfinances.show',
            'title' => 'show_carfinance_page'
        ]);

        # carfinances delete
        Route::delete('carfinances/{id}', [
            'uses'  => 'CarFinanceController@destroy',
            'as'    => 'carfinances.delete',
            'title' => 'delete_carfinance'
        ]);
        #delete all carfinances
        Route::post('delete-all-carfinances', [
            'uses'  => 'CarFinanceController@destroyAll',
            'as'    => 'carfinances.deleteAll',
            'title' => 'delete_group_of_carfinances'
        ]);
    /*------------ end Of carfinances ----------*/
    
    /*------------ start Of carfinanceoperations ----------*/
        Route::get('carfinanceoperations', [
            'uses'      => 'CarFinanceOperationsController@index',
            'as'        => 'carfinanceoperations.index',
            'title'     => 'carfinanceoperations',
            'icon'      => '<i class="feather icon-dollar-sign"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['carfinanceoperations.create', 'carfinanceoperations.store','carfinanceoperations.edit', 'carfinanceoperations.update', 'carfinanceoperations.show', 'carfinanceoperations.delete'  ,'carfinanceoperations.deleteAll' ,'carfinanceoperations.get-car-outstanding-finances','carfinanceoperations.print']
        ]);

        Route::get('get-car-outstanding-finances', [
            'uses'  => 'CarFinanceOperationsController@getCarOutstandingFinances',
            'as'    => 'carfinanceoperations.get-car-outstanding-finances',
            'title' => 'get_car_outstanding_finances'
        ]); 

        Route::get('carfinanceoperations/{id}/print', [
            'uses'  => 'CarFinanceOperationsController@print',
            'as'    => 'carfinanceoperations.print',
            'title' => 'print'
        ]); 

        # carfinanceoperations store
        Route::get('carfinanceoperations/create', [
            'uses'  => 'CarFinanceOperationsController@create',
            'as'    => 'carfinanceoperations.create',
            'title' => 'add_carfinanceoperations_page'
        ]);


        # carfinanceoperations store
        Route::post('carfinanceoperations/store', [
            'uses'  => 'CarFinanceOperationsController@store',
            'as'    => 'carfinanceoperations.store',
            'title' => 'add_carfinanceoperations'
        ]);

        # carfinanceoperations update
        Route::get('carfinanceoperations/{id}/edit', [
            'uses'  => 'CarFinanceOperationsController@edit',
            'as'    => 'carfinanceoperations.edit',
            'title' => 'update_carfinanceoperations_page'
        ]);

        # carfinanceoperations update
        Route::put('carfinanceoperations/{id}', [
            'uses'  => 'CarFinanceOperationsController@update',
            'as'    => 'carfinanceoperations.update',
            'title' => 'update_carfinanceoperations'
        ]);

        # carfinanceoperations show
        Route::get('carfinanceoperations/{id}/Show', [
            'uses'  => 'CarFinanceOperationsController@show',
            'as'    => 'carfinanceoperations.show',
            'title' => 'show_carfinanceoperations_page'
        ]);

        # carfinanceoperations delete
        Route::delete('carfinanceoperations/{id}', [
            'uses'  => 'CarFinanceOperationsController@destroy',
            'as'    => 'carfinanceoperations.delete',
            'title' => 'delete_carfinanceoperations'
        ]);
        #delete all carfinanceoperations
        Route::post('delete-all-carfinanceoperations', [
            'uses'  => 'CarFinanceOperationsController@destroyAll',
            'as'    => 'carfinanceoperations.deleteAll',
            'title' => 'delete_group_of_carfinanceoperations'
        ]);
    /*------------ end Of carfinanceoperations ----------*/
    
    /*------------ start Of cargalleries ----------*/
        Route::get('cargalleries', [
            'uses'      => 'CarGalleryController@index',
            'as'        => 'cargalleries.index',
            'title'     => 'cargalleries',
            'icon'      => '<i class="feather icon-image"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['cargalleries.create', 'cargalleries.store','cargalleries.edit', 'cargalleries.update', 'cargalleries.show', 'cargalleries.delete'  ,'cargalleries.deleteAll' ,'cargalleries.delete.image']
        ]);

        # cargalleries store
        Route::get('cargalleries/create', [
            'uses'  => 'CarGalleryController@create',
            'as'    => 'cargalleries.create',
            'title' => 'add_cargallery_page'
        ]);


        # cargalleries store
        Route::post('cargalleries/store', [
            'uses'  => 'CarGalleryController@store',
            'as'    => 'cargalleries.store',
            'title' => 'add_cargallery'
        ]);

        # cargalleries update
        Route::get('cargalleries/{id}/edit', [
            'uses'  => 'CarGalleryController@edit',
            'as'    => 'cargalleries.edit',
            'title' => 'update_cargallery_page'
        ]);

        # cargalleries update
        Route::put('cargalleries/{id}', [
            'uses'  => 'CarGalleryController@update',
            'as'    => 'cargalleries.update',
            'title' => 'update_cargallery'
        ]);

        # cargalleries show
        Route::get('cargalleries/{id}/Show', [
            'uses'  => 'CarGalleryController@show',
            'as'    => 'cargalleries.show',
            'title' => 'show_cargallery_page'
        ]);

        # cargalleries delete
        Route::delete('cargalleries/{id}', [
            'uses'  => 'CarGalleryController@destroy',
            'as'    => 'cargalleries.delete',
            'title' => 'delete_cargallery'
        ]);
        #delete all cargalleries
        Route::post('delete-all-cargalleries', [
            'uses'  => 'CarGalleryController@destroyAll',
            'as'    => 'cargalleries.deleteAll',
            'title' => 'delete_group_of_cargalleries'
        ]);
        Route::post('cargalleryimages/delete-image', [
            'uses'  => 'CarGalleryController@deleteImage',
            'as'    => 'cargalleries.delete.image',
            'title' => 'delete_image'
        ]);
    /*------------ end Of cargalleries ----------*/
        /*------------ start Of carattachments ----------*/
        Route::get('carattachments', [
            'uses'      => 'CarAttachmentController@index',
            'as'        => 'carattachments.index',
            'title'     => 'carattachments',
            'icon'      => '<i class="feather icon-file"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['carattachments.create', 'carattachments.store','carattachments.edit', 'carattachments.update', 'carattachments.show', 'carattachments.delete'  ,'carattachments.deleteAll' ,'carattachments.delete.image']
        ]);

        # carattachments store
        Route::get('carattachments/create', [
            'uses'  => 'CarAttachmentController@create',
            'as'    => 'carattachments.create',
            'title' => 'add_carattachment_page'
        ]);


        # carattachments store
        Route::post('carattachments/store', [
            'uses'  => 'CarAttachmentController@store',
            'as'    => 'carattachments.store',
            'title' => 'add_carattachment'
        ]);

        # carattachments update
        Route::get('carattachments/{id}/edit', [
            'uses'  => 'CarAttachmentController@edit',
            'as'    => 'carattachments.edit',
            'title' => 'update_carattachment_page'
        ]);

        # carattachments update
        Route::put('carattachments/{id}', [
            'uses'  => 'CarAttachmentController@update',
            'as'    => 'carattachments.update',
            'title' => 'update_carattachment'
        ]);

        # carattachments show
        Route::get('carattachments/{id}/Show', [
            'uses'  => 'CarAttachmentController@show',
            'as'    => 'carattachments.show',
            'title' => 'show_carattachment_page'
        ]);

        # carattachments delete
        Route::delete('carattachments/{id}', [
            'uses'  => 'CarAttachmentController@destroy',
            'as'    => 'carattachments.delete',
            'title' => 'delete_carattachment'
        ]);
        #delete all carattachments
        Route::post('delete-all-carattachments', [
            'uses'  => 'CarAttachmentController@destroyAll',
            'as'    => 'carattachments.deleteAll',
            'title' => 'delete_group_of_carattachments'
        ]);
        Route::post('carattachments/delete-image', [
            'uses'  => 'CarAttachmentController@deleteImage',
            'as'    => 'carattachments.delete.image',
            'title' => 'delete_image'
        ]);
    /*------------ end Of carattachments ----------*/
    Route::get('cars-settings', [
        'as'        => 'cars_settings',
        'title'     => 'cars_settings',
        'icon'      => '<i class="feather icon-settings"></i>',
        'type'      => 'parent',
        'sub_route' => true,
        'child'     => [
            'carstatuses.index','carstatuses.create', 'carstatuses.store','carstatuses.edit', 'carstatuses.update', 'carstatuses.show', 'carstatuses.delete'  ,'carstatuses.deleteAll' ,
            'damagetypes.index','damagetypes.create', 'damagetypes.store','damagetypes.edit', 'damagetypes.update', 'damagetypes.show', 'damagetypes.delete'  ,'damagetypes.deleteAll' ,
            'carbrands.index','carbrands.create', 'carbrands.store','carbrands.edit', 'carbrands.update', 'carbrands.show', 'carbrands.delete'  ,'carbrands.deleteAll','carbrands.importFile' ,
            'carmodels.index','carmodels.create', 'carmodels.store','carmodels.edit', 'carmodels.update', 'carmodels.show', 'carmodels.delete'  ,'carmodels.deleteAll','carmodels.importFile' ,
            'carcolors.index','carcolors.create', 'carcolors.store','carcolors.edit', 'carcolors.update', 'carcolors.show', 'carcolors.delete'  ,'carcolors.deleteAll' ,
            'caryears.index','caryears.create', 'caryears.store','caryears.edit', 'caryears.update', 'caryears.show', 'caryears.delete'  ,'caryears.deleteAll' ,
            'bodytypes.index','bodytypes.create', 'bodytypes.store','bodytypes.edit', 'bodytypes.update', 'bodytypes.show', 'bodytypes.delete'  ,'bodytypes.deleteAll' ,
            'enginetypes.index','enginetypes.create', 'enginetypes.store','enginetypes.edit', 'enginetypes.update', 'enginetypes.show', 'enginetypes.delete'  ,'enginetypes.deleteAll' ,
            'enginecylinders.index','enginecylinders.create', 'enginecylinders.store','enginecylinders.edit', 'enginecylinders.update', 'enginecylinders.show', 'enginecylinders.delete'  ,'enginecylinders.deleteAll' ,
            'transmissiontypes.index','transmissiontypes.create', 'transmissiontypes.store','transmissiontypes.edit', 'transmissiontypes.update', 'transmissiontypes.show', 'transmissiontypes.delete'  ,'transmissiontypes.deleteAll' ,
            'drivetypes.index','drivetypes.create', 'drivetypes.store','drivetypes.edit', 'drivetypes.update', 'drivetypes.show', 'drivetypes.delete'  ,'drivetypes.deleteAll' ,
            'fueltypes.index','fueltypes.create', 'fueltypes.store','fueltypes.edit', 'fueltypes.update', 'fueltypes.show', 'fueltypes.delete'  ,'fueltypes.deleteAll' ,
        ],
    ]);
    
    /*------------ start Of carstatushistories ----------*/
        // Route::get('carstatushistories', [
        //     'uses'      => 'CarStatusHistoryController@index',
        //     'as'        => 'carstatushistories.index',
        //     'title'     => 'carstatushistories',
        //     'icon'      => '<i class="feather icon-image"></i>',
        //     'type'      => 'parent',
        //     'sub_route' => false,
        //     'child'     => ['carstatushistories.create', 'carstatushistories.store','carstatushistories.edit', 'carstatushistories.update', 'carstatushistories.show', 'carstatushistories.delete'  ,'carstatushistories.deleteAll' ,]
        // ]);

        // # carstatushistories store
        // Route::get('carstatushistories/create', [
        //     'uses'  => 'CarStatusHistoryController@create',
        //     'as'    => 'carstatushistories.create',
        //     'title' => 'add_carstatushistory_page'
        // ]);


        // # carstatushistories store
        // Route::post('carstatushistories/store', [
        //     'uses'  => 'CarStatusHistoryController@store',
        //     'as'    => 'carstatushistories.store',
        //     'title' => 'add_carstatushistory'
        // ]);

        // # carstatushistories update
        // Route::get('carstatushistories/{id}/edit', [
        //     'uses'  => 'CarStatusHistoryController@edit',
        //     'as'    => 'carstatushistories.edit',
        //     'title' => 'update_carstatushistory_page'
        // ]);

        // # carstatushistories update
        // Route::put('carstatushistories/{id}', [
        //     'uses'  => 'CarStatusHistoryController@update',
        //     'as'    => 'carstatushistories.update',
        //     'title' => 'update_carstatushistory'
        // ]);

        // # carstatushistories show
        // Route::get('carstatushistories/{id}/Show', [
        //     'uses'  => 'CarStatusHistoryController@show',
        //     'as'    => 'carstatushistories.show',
        //     'title' => 'show_carstatushistory_page'
        // ]);

        // # carstatushistories delete
        // Route::delete('carstatushistories/{id}', [
        //     'uses'  => 'CarStatusHistoryController@destroy',
        //     'as'    => 'carstatushistories.delete',
        //     'title' => 'delete_carstatushistory'
        // ]);
        // #delete all carstatushistories
        // Route::post('delete-all-carstatushistories', [
        //     'uses'  => 'CarStatusHistoryController@destroyAll',
        //     'as'    => 'carstatushistories.deleteAll',
        //     'title' => 'delete_group_of_carstatushistories'
        // ]);
    /*------------ end Of carstatushistories ----------*/
    
    /*------------ start Of auctions ----------*/
        Route::get('auctions', [
            'uses'      => 'AuctionController@index',
            'as'        => 'auctions.index',
            'title'     => 'auctions',
            'icon'      => '<i class="feather icon-activity"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['auctions.create', 'auctions.store','auctions.edit', 'auctions.update', 'auctions.show', 'auctions.delete'  ,'auctions.deleteAll' ,]
        ]);

        # auctions store
        Route::get('auctions/create', [
            'uses'  => 'AuctionController@create',
            'as'    => 'auctions.create',
            'title' => 'add_auction_page'
        ]);


        # auctions store
        Route::post('auctions/store', [
            'uses'  => 'AuctionController@store',
            'as'    => 'auctions.store',
            'title' => 'add_auction'
        ]);

        # auctions update
        Route::get('auctions/{id}/edit', [
            'uses'  => 'AuctionController@edit',
            'as'    => 'auctions.edit',
            'title' => 'update_auction_page'
        ]);

        # auctions update
        Route::put('auctions/{id}', [
            'uses'  => 'AuctionController@update',
            'as'    => 'auctions.update',
            'title' => 'update_auction'
        ]);

        # auctions show
        Route::get('auctions/{id}/Show', [
            'uses'  => 'AuctionController@show',
            'as'    => 'auctions.show',
            'title' => 'show_auction_page'
        ]);

        # auctions delete
        Route::delete('auctions/{id}', [
            'uses'  => 'AuctionController@destroy',
            'as'    => 'auctions.delete',
            'title' => 'delete_auction'
        ]);
        #delete all auctions
        Route::post('delete-all-auctions', [
            'uses'  => 'AuctionController@destroyAll',
            'as'    => 'auctions.deleteAll',
            'title' => 'delete_group_of_auctions'
        ]);
    /*------------ end Of auctions ----------*/
    
    /*------------ start Of warehouses ----------*/
        Route::get('warehouses', [
            'uses'      => 'WarehouseController@index',
            'as'        => 'warehouses.index',
            'title'     => 'warehouses',
            'icon'      => '<i class="feather icon-home"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['warehouses.create', 'warehouses.store','warehouses.edit', 'warehouses.update', 'warehouses.show', 'warehouses.delete'  ,'warehouses.deleteAll' ,]
        ]);

        # warehouses store
        Route::get('warehouses/create', [
            'uses'  => 'WarehouseController@create',
            'as'    => 'warehouses.create',
            'title' => 'add_warehouse_page'
        ]);


        # warehouses store
        Route::post('warehouses/store', [
            'uses'  => 'WarehouseController@store',
            'as'    => 'warehouses.store',
            'title' => 'add_warehouse'
        ]);

        # warehouses update
        Route::get('warehouses/{id}/edit', [
            'uses'  => 'WarehouseController@edit',
            'as'    => 'warehouses.edit',
            'title' => 'update_warehouse_page'
        ]);

        # warehouses update
        Route::put('warehouses/{id}', [
            'uses'  => 'WarehouseController@update',
            'as'    => 'warehouses.update',
            'title' => 'update_warehouse'
        ]);

        # warehouses show
        Route::get('warehouses/{id}/Show', [
            'uses'  => 'WarehouseController@show',
            'as'    => 'warehouses.show',
            'title' => 'show_warehouse_page'
        ]);

        # warehouses delete
        Route::delete('warehouses/{id}', [
            'uses'  => 'WarehouseController@destroy',
            'as'    => 'warehouses.delete',
            'title' => 'delete_warehouse'
        ]);
        #delete all warehouses
        Route::post('delete-all-warehouses', [
            'uses'  => 'WarehouseController@destroyAll',
            'as'    => 'warehouses.deleteAll',
            'title' => 'delete_group_of_warehouses'
        ]);
    /*------------ end Of warehouses ----------*/
    
    /*------------ start Of branches ----------*/
        Route::get('branches', [
            'uses'      => 'BranchController@index',
            'as'        => 'branches.index',
            'title'     => 'branches',
            'icon'      => '<i class="feather icon-home"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['branches.create', 'branches.store','branches.edit', 'branches.update', 'branches.show', 'branches.delete'  ,'branches.deleteAll' ,]
        ]);

        # branches store
        Route::get('branches/create', [
            'uses'  => 'BranchController@create',
            'as'    => 'branches.create',
            'title' => 'add_branch_page'
        ]);


        # branches store
        Route::post('branches/store', [
            'uses'  => 'BranchController@store',
            'as'    => 'branches.store',
            'title' => 'add_branch'
        ]);

        # branches update
        Route::get('branches/{id}/edit', [
            'uses'  => 'BranchController@edit',
            'as'    => 'branches.edit',
            'title' => 'update_branch_page'
        ]);

        # branches update
        Route::put('branches/{id}', [
            'uses'  => 'BranchController@update',
            'as'    => 'branches.update',
            'title' => 'update_branch'
        ]);

        # branches show
        Route::get('branches/{id}/Show', [
            'uses'  => 'BranchController@show',
            'as'    => 'branches.show',
            'title' => 'show_branch_page'
        ]);

        # branches delete
        Route::delete('branches/{id}', [
            'uses'  => 'BranchController@destroy',
            'as'    => 'branches.delete',
            'title' => 'delete_branch'
        ]);
        #delete all branches
        Route::post('delete-all-branches', [
            'uses'  => 'BranchController@destroyAll',
            'as'    => 'branches.deleteAll',
            'title' => 'delete_group_of_branches'
        ]);
    /*------------ end Of branches ----------*/
    

    #new_routes_here
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
    });

    /// excel area
    Route::get(
        'export/{export}',
        'ExcelController@master'
    )->name('master-export');
    Route::post('import-items', 'ExcelController@importItems')->name('import-items');
    Route::get('{model}/toggle-boolean/{id}/{action}', 'AdminController@toggleBoolean')->name('model.active');

});