<?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Artisan;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\Auth\ForgotPasswordController;
    use App\Http\Controllers\FrontendController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\MessageController;
    use App\Http\Controllers\ProductReviewController;
    use App\Http\Controllers\PostCommentController;
    use App\Http\Controllers\NotificationController;
    use App\Http\Controllers\HomeController;
    use \UniSharp\LaravelFilemanager\Lfm;
    use App\Http\Controllers\Auth\ResetPasswordController;
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */

    // CACHE CLEAR ROUTE
    Route::get('cache-clear', function () {
        Artisan::call('optimize:clear');
        request()->session()->flash('success', 'Successfully cache cleared.');
        return redirect()->back();
    })->name('cache.clear');


    // STORAGE LINKED ROUTE
    Route::get('storage-link',[AdminController::class,'storageLink'])->name('storage.link');

    // SEO Routes
    Route::get('sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

    Auth::routes(['register' => false]);

    Route::get('user/login', [FrontendController::class, 'login'])->name('login.form');
    Route::post('user/login', [FrontendController::class, 'loginSubmit'])->name('login.submit');
    Route::get('user/logout', [FrontendController::class, 'logout'])->name('user.logout');

    Route::get('user/register', [FrontendController::class, 'register'])->name('register.form');
    Route::post('user/register', [FrontendController::class, 'registerSubmit'])->name('register.submit');
   
    // Reset password
    Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


    Route::get('/', [FrontendController::class, 'home'])->name('home');

// Frontend Routes
    Route::get('/home', [FrontendController::class, 'index']);
    Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about-us');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
    Route::post('/contact/message', [MessageController::class, 'store'])->name('contact.store');
    Route::get('product-detail/{slug}', [App\Http\Controllers\Frontend\ProductDetailController::class, 'show'])->name('product-detail');
    Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
    Route::get('/product-cat/{slug}', [FrontendController::class, 'productCat'])->name('product-cat');
    Route::get('/product-sub-cat/{slug}/{sub_slug}', [FrontendController::class, 'productSubCat'])->name('product-sub-cat');

    Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
    Route::get('/product-lists', [FrontendController::class, 'productLists'])->name('product-lists');
    Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
// Media (Blog functionality)
    Route::get('/media', [FrontendController::class, 'blog'])->name('media');
    Route::get('/media-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('media.detail');
    Route::get('/media/search', [FrontendController::class, 'blogSearch'])->name('media.search');
    Route::post('/media/filter', [FrontendController::class, 'blogFilter'])->name('media.filter');
    Route::get('media-cat/{slug}', [FrontendController::class, 'blogByCategory'])->name('media.category');
    Route::get('media-tag/{slug}', [FrontendController::class, 'blogByTag'])->name('media.tag');

// NewsLetter
    Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

// Product Review
    Route::resource('/review', 'ProductReviewController', ['except' => ['store']]);
    Route::post('product/{slug}/review', [ProductReviewController::class, 'store'])->name('product.review.store');

// Post Comment
    Route::post('post/{slug}/comment', [PostCommentController::class, 'store'])->name('post-comment.store');
    Route::resource('/comment', 'PostCommentController', ['except' => ['store']]);

// Frontend Project Categories
Route::get('/categories-projets', [App\Http\Controllers\Frontend\ProjectCategoryController::class, 'index'])->name('project-categories.index');
Route::get('/categories-projets/{slug}', [App\Http\Controllers\Frontend\ProjectCategoryController::class, 'show'])->name('project-categories.show');

// Frontend Project Detail
Route::get('/projet/{project}', [App\Http\Controllers\Frontend\ProjectController::class, 'show'])->name('projects.show');

// Admin Project Management
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('projectcategory', App\Http\Controllers\Admin\ProjectCategoryController::class);
    Route::delete('projects/images/{image}', [App\Http\Controllers\Admin\ProjectController::class, 'destroyImage'])->name('projects.images.destroy');
    Route::patch('projects/{project}/images/{image}/set-main', [App\Http\Controllers\Admin\ProjectController::class, 'setMainImage'])->name('projects.images.set-main');
    
    // Ordering routes
    Route::post('projectcategory/update-order', [App\Http\Controllers\Admin\ProjectCategoryController::class, 'updateOrder'])->name('projectcategory.update-order');
    Route::post('projects/update-order', [App\Http\Controllers\Admin\ProjectController::class, 'updateOrder'])->name('projects.update-order');
    Route::post('projects/{project}/images/update-order', [App\Http\Controllers\Admin\ProjectController::class, 'updateImageOrder'])->name('projects.images.update-order');
});

// Backend section start

    Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'co-admin']], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('/file-manager', function () {
            return view('backend.layouts.file-manager');
        })->name('file-manager');
        // user route (admin only)
        Route::resource('users', 'UsersController')->middleware('admin-only');
        // Profile
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
        Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');
        // Category
        Route::resource('/category', 'CategoryController')->names([
            'index' => 'admin.category.index',
            'create' => 'admin.category.create',
            'store' => 'admin.category.store',
            'show' => 'admin.category.show',
            'edit' => 'admin.category.edit',
            'update' => 'admin.category.update',
            'destroy' => 'admin.category.destroy',
        ]);
        // Product
        Route::resource('/product', 'ProductController')->names([
            'index' => 'admin.product.index',
            'create' => 'admin.product.create',
            'store' => 'admin.product.store',
            'show' => 'admin.product.show',
            'edit' => 'admin.product.edit',
            'update' => 'admin.product.update',
            'destroy' => 'admin.product.destroy',
        ]);
        // Ajax for sub category
        Route::post('/category/{id}/child', 'CategoryController@getChildByParent');
        // Manage products in category
        Route::get('/category/{id}/products', 'CategoryController@manageProducts')->name('admin.category.products');
        Route::post('/category/{id}/products/sort', 'CategoryController@sortProducts')->name('admin.category.products.sort');
        // POST category
        Route::resource('/post-category', 'PostCategoryController');
        // Post
        Route::resource('/post', 'PostController');
        // Media management
        Route::delete('/media/{id}/delete', [App\Http\Controllers\PostController::class, 'deleteMedia'])->name('media.delete');
        Route::post('/media/order', [App\Http\Controllers\PostController::class, 'updateMediaOrder'])->name('media.order');
        // Message
        Route::resource('/message', 'MessageController');
        Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');
        Route::get('/message/{id}/download', [MessageController::class, 'downloadAttachment'])->name('message.download');
        Route::delete('/message/{id}/attachment', [MessageController::class, 'deleteAttachment'])->name('message.attachment.delete');
        Route::patch('/message/{id}/toggle-read', [MessageController::class, 'toggleReadStatus'])->name('message.toggle.read');
        Route::delete('/message/bulk-delete', [MessageController::class, 'bulkDelete'])->name('message.bulk.delete');

        // Settings (admin only)
        Route::get('settings', [AdminController::class, 'settings'])->name('settings')->middleware('admin-only');
        Route::post('setting/update', [AdminController::class, 'settingsUpdate'])->name('settings.update')->middleware('admin-only');



        // Notification
        Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
        Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
        // Password Change (admin only)
        Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form')->middleware('admin-only');
        Route::post('change-password', [AdminController::class, 'changPasswordStore'])->name('change.password')->middleware('admin-only');
        // Certificate
        Route::resource('certificate', 'CertificateController', [
            'as' => 'admin'
        ]);

        // Analytics
        Route::get('/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('admin.analytics');
        Route::get('/analytics/chart-data', [App\Http\Controllers\Admin\AnalyticsController::class, 'getChartData'])->name('admin.analytics.chart-data');
        Route::get('/analytics/stats', [App\Http\Controllers\Admin\AnalyticsController::class, 'getVisitorStats'])->name('admin.analytics.stats');
        Route::post('/analytics/initialize', [App\Http\Controllers\Admin\AnalyticsController::class, 'initialize'])->name('admin.analytics.initialize');

        // About Us Images Management
        // About Us Images CRUD retired and replaced by Settings-managed image
    });


// User section start
    Route::group(['prefix' => '/user', 'middleware' => ['user']], function () {
        Route::get('/', [HomeController::class, 'index'])->name('user');
        // Profile
        Route::get('/profile', [HomeController::class, 'profile'])->name('user-profile');
        Route::post('/profile/{id}', [HomeController::class, 'profileUpdate'])->name('user-profile-update');
        // Product Review
        Route::get('/user-review', [HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
        Route::delete('/user-review/delete/{id}', [HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
        Route::get('/user-review/edit/{id}', [HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
        Route::patch('/user-review/update/{id}', [HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');

        // Post comment
        Route::get('user-post/comment', [HomeController::class, 'userComment'])->name('user.post-comment.index');
        Route::delete('user-post/comment/delete/{id}', [HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
        Route::get('user-post/comment/edit/{id}', [HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
        Route::patch('user-post/comment/udpate/{id}', [HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');

        // Password Change
        Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
        Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');

    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        Lfm::routes();
    });

    Route::get('/certificates', [FrontendController::class, 'certificates'])->name('certificates');
    Route::get('/nos-produits', [App\Http\Controllers\FrontendController::class, 'nosProduits'])->name('products.nos');

// Frontend
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'showAll'])->name('categories.index');
Route::get('/categories/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'showAll'])->name('products.all');

// Test route to verify categories
Route::get('/test-categories', function() {
    $categories = \App\Models\Category::whereNull('parent_id')->with('children')->get();
    return response()->json([
        'total_categories' => $categories->count(),
        'categories' => $categories->map(function($cat) {
            return [
                'id' => $cat->id,
                'title' => $cat->title,
                'slug' => $cat->slug,
                'children_count' => $cat->children->count()
            ];
        })
    ]);
});

// Test route for image accessibility
Route::get('/test-image/{filename}', function ($filename) {
    $path = public_path('images/projects/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    return response('Image not found', 404);
})->name('test.image');

// Image serving routes
Route::get('/images/projects/{filename}', function ($filename) {
    $path = public_path('images/projects/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    return response('Image not found', 404);
})->name('serve.project.image');

Route::get('/images/project-categories/{filename}', function ($filename) {
    $path = public_path('images/project-categories/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    return response('Image not found', 404);
})->name('serve.project.category.image');


