<?php
Route::group(['middleware' => ['checkIp']], function () {
Route::localizedGroup(function ()  {

    //front routes
    Route::get('/', 'Home\HomeController@index')->name('home');
    Route::get('/services', 'ServiceController@index')->name('front.services');
    Route::get('/blog', 'BlogController@index')->name('front.blog');
    Route::get('/blog/detail/{id}/{title?}', 'BlogController@Show')->name('blog.detail');
    Route::get('/SomeOfAutobus', 'SomeofusController@index')->name('front.someofus');
    Route::get('/About', 'AboutController@index')->name('front.about');
    Route::get('/contact', 'ContactController@index')->name('front.contact');
    Route::get('/offers', 'OfferController@index')->name('front.offer');
    Route::get('/privacy', 'Home\HomeController@privacy')->name('front.privacy');
    Route::get('/terms', 'Home\HomeController@terms')->name('front.terms');
    Route::get('/offersas', 'OfferController@indexAjax')->name('front.offerajax');
    Route::get('/locationsajax', 'LocationController@LocationsAjax')->name('LocationsAjax');
    Route::get('/koko', 'LocationController@AjaxPlease');
    Route::post('/order', 'OrderController@order')->name('Order');
    Route::post('/frontorder', 'OrderController@FrontOrderById')->name('front.order.detail');
    Route::get('/order/response', 'OrderController@OrderStatus')->name('OrderStatus');
//    Route::post('/koko', 'LocationController@AjaxPleasePost');
    Route::post('/contact/sendmail', 'ContactController@SendMail')->name('contact.sendmail');
    Route::post('/contact/send', 'ContactController@SendMailAjax')->name('contact.send');


    //admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('loguser');
            Route::group(['middleware' => ['auth:admin']], function () {
                Route::get('/', 'AdminController@index')->name('admin_home');
                Route::post('/savetasks', 'AdminController@SaveTasks')->name('savetasks');
                Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
                Route::get('/viewlistitem/{id}/{table}', 'AdminController@view_list_item');
                Route::post('/addlistitem', 'AdminController@add_list_item')->name('addlistitem');
                Route::post('/editlistitem', 'AdminController@edit_list_item')->name('editlistitem');
                Route::post('/deletelistitem/{id}/{table}', 'AdminController@DeleteListItem')->name('deletelistitem');
                Route::post('/deletepost/{id}/{table}', 'AdminController@DeletePost')->name('deleteitem');
                Route::post('/changelistitemstatus/{id}/{table}', 'AdminController@ChangeListItemStatus')->name('changestatus');
                Route::post('/changestatus', 'AdminController@ChangeStatus')->name('changepoststatus');
                Route::post('/changesliderstatus', 'AdminController@ChangeSliderStatus')->name('changesliderstatus');
                Route::post('/changemainstatus', 'AdminController@ChangeMainStatus')->name('changemainstatus');
                Route::post('/changelistitemsortorder', 'AdminController@ChangeListItemSortOrder')->name('changesortorder');
                Route::post('/changetableitemsortorder', 'AdminController@ChangeTableItemSortOrder')->name('changetablesortorder');
                //attrs
                Route::get('/viewitem/{id}/{table}', 'AdminController@showeditmodal')->name('admin.editmodal');
                Route::post('/edititem', 'AdminController@editmodalpost')->name('admin.edititempost');

                //services
                Route::get('/services', 'ServiceController@services')->name('admin.service');
                Route::get('/services/add', 'ServiceController@AddService')->name('admin.service.add');
                Route::post('/services', 'ServiceController@AddServicePost')->name('admin.service.addpost');
                Route::get('/services/edit/{id}', 'ServiceController@ServiceById')->name('admin.service.edit');
                Route::post('/services/edit', 'ServiceController@EditServicePost')->name('admin.service.editpost');

                //blog
                Route::get('/blog', 'BlogController@blog')->name('admin.blog');
                Route::get('/blog/add', 'BlogController@createBlog')->name('admin.blog.add');
                Route::post('/blog', 'BlogController@AddBlogPost')->name('admin.blog.addpost');
                Route::get('/blog/edit/{id}', 'BlogController@blogById')->name('admin.blog.edit');
                Route::post('/blog/edit', 'BlogController@blogUpdate')->name('admin.blog.editpost');

                //whoweare
                Route::get('/whoweare', 'WhoWeAreController@whoWeAre')->name('admin.whoweare');
                Route::get('/whoweare/add', 'WhoWeAreController@createWhoWeAre')->name('admin.whoweare.add');
                Route::post('/whoweare', 'WhoWeAreController@addWhoWeArePost')->name('admin.whoweare.addpost');
                Route::get('/whoweare/edit/{id}', 'WhoWeAreController@whoWeAreById')->name('admin.whoweare.edit');
                Route::post('/whoweare/edit', 'WhoWeAreController@whoWeAreUpdate')->name('admin.whoweare.editpost');

                //slider
                Route::get('/slider', 'SliderController@slider')->name('admin.slider');
                Route::get('/slider/add', 'SliderController@createSlider')->name('admin.slider.add');
                Route::post('/slider', 'SliderController@storeSlider')->name('admin.slider.store');
                Route::get('/slider/edit/{id}', 'SliderController@sliderById')->name('admin.slider.edit');
                Route::post('/slider/edit', 'SliderController@sliderUpdate')->name('admin.slider.editpost');

                //categories
                Route::get('/categories', 'CategoriesController@index')->name('admin.categories');

                 //services

                Route::get('/service', 'ServiceController@service')->name('admin.service');
                Route::get('/service/add', 'ServiceController@createService')->name('admin.service.add');
                Route::post('/service', 'ServiceController@AddServicePost')->name('admin.service.store');
                Route::get('/service/edit/{serviceId}', 'ServiceController@serviceById')->name('admin.service.edit');
                Route::post('/service/edit', 'ServiceController@serviceUpdate')->name('admin.service.editpost');


                //additional services

                Route::get('/additionalService', 'AdditionalServiceController@additionalService')->name('admin.additionalService');
                Route::get('/additionalService/add', 'AdditionalServiceController@createAdditionalService')->name('admin.additionalService.add');
                Route::post('/additionalService', 'AdditionalServiceController@AddAdditionalServicePost')->name('admin.additionalService.addpost');
                Route::get('/additionalService/edit/{additionalServiceId}', 'AdditionalServiceController@additionalServiceById')->name('admin.additionalService.edit');
                Route::post('/additionalService/edit', 'AdditionalServiceController@additionalServiceUpdate')->name('admin.additionalService.editpost');
                //orders
                Route::get('/Order', 'OrderController@GetOrder')->name('admin.getorder');
                Route::get('/Order/{id}', 'OrderController@GetOrderById')->name('admin.getsingleorder');




                //locations
                Route::get('/locations', 'LocationController@Location')->name('admin.locations');
                Route::get('/locations/add', 'LocationController@addLocation')->name('admin.locations.add');
                Route::post('/locations', 'LocationController@AddLocationPost')->name('admin.locations.addpost');
                Route::get('/locations/edit/{id}', 'LocationController@LocationById')->name('admin.locations.edit');
                Route::post('/locations/edit', 'LocationController@EditLocationPost')->name('admin.locations.editpost');

                //meta
                Route::get('/meta', 'MetaController@Meta')->name('admin.meta');
                Route::get('/meta/add', 'MetaController@addMeta')->name('admin.meta.add');
                Route::post('/meta', 'MetaController@AddMetaPost')->name('admin.meta.addpost');
                Route::get('/meta/edit/{id}', 'MetaController@MetaById')->name('admin.meta.edit');
                Route::post('/meta/edit', 'MetaController@EditMetaPost')->name('admin.meta.editpost');

                //CONTACT
                Route::get('/contact/edit/{id}', 'ContactController@ContactById')->name('admin.contact.edit');
                Route::post('/contact/edit', 'ContactController@EditContactPost')->name('admin.contact.editpost');

                //translation routes
                Route::get('/translations/view/{groupKey?}',  ['uses' => '\Barryvdh\TranslationManager\Controller@getView'])->where('groupKey', '.*');
                Route::get('/translations/{groupKey?}', ['uses' => '\Barryvdh\TranslationManager\Controller@getIndex'])->where('groupKey', '.*')->name('admin.translations');
                Route::post('/translations/add/{groupKey}', ['uses' => '\Barryvdh\TranslationManager\Controller@postAdd'])->where('groupKey', '.*');
                Route::post('/translations/edit/{groupKey}', ['uses' => '\Barryvdh\TranslationManager\Controller@postEdit'])->where('groupKey', '.*');
                Route::post('/translations/groups/add', ['uses' => '\Barryvdh\TranslationManager\Controller@postAddGroup']);
                Route::post('/translations/delete/{groupKey}/{translationKey}', ['uses' => '\Barryvdh\TranslationManager\Controller@postDelete'])->where('groupKey', '.*');
                Route::post('/translations/import', ['uses' => '\Barryvdh\TranslationManager\Controller@postImport']);
                Route::post('/translations/find', ['uses' => '\Barryvdh\TranslationManager\Controller@postFind']);
                Route::post('/translations/locales/add', ['uses' => '\Barryvdh\TranslationManager\Controller@postAddLocale']);
                Route::post('/translations/locales/remove', ['uses' => '\Barryvdh\TranslationManager\Controller@postRemoveLocale']);
                Route::post('/translations/publish/{groupKey}', ['uses' => '\Barryvdh\TranslationManager\Controller@postPublish'])->where('groupKey', '.*');
                Route::post('/translations/translate-missing', ['uses' => '\Barryvdh\TranslationManager\Controller@postTranslateMissing']);

                //publish translations for using in JS files
                Route::get('/langstojs', function() {
                    Artisan::call('lang:js');
                })->name('langstojs');

                Route::post('/uploadfiles', 'FileController@UploadFiles')->name('admin.uploadfiles');

            });

    });
    //Auth::routes();
    Route::post('login', 'Auth\LoginController@login')->name('user.login');
    Route::post('register', 'Auth\RegisterController@register')->name('user.register');

    //fb auth routes
    Route::get('/redirect/{param?}', 'SocialAuthController@redirect')->name('social.auth');
    Route::get('/callback/{param?}', 'SocialAuthController@callback')->name('social.callback');


    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    Route::prefix('user')->group(function () {
        Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'UserController@index')->name('user.home');
        Route::get('edit', 'UserController@index')->name('user.edit');
        Route::post('editpost', 'UserController@EditUser')->name('user.editpost');
        Route::post('getuserorder', 'UserController@UserOrderById')->name('user.order.detail');
        Route::get('history', 'UserController@history')->name('user.history');
        Route::post('change-password', 'UserController@ChangePassword')->name('user.change.password.post');
        Route::get('logout', 'Auth\LoginController@logout')->name('user.logout');

        });
    });
    });
});
