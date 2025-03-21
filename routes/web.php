<?php

use App\Http\Controllers\Auth\{ForgotPasswordController,
    LoginController,
    RegisterController,
    ResetPasswordController,
    VerificationController,
};
use App\Http\Controllers\Back\{BackContactController,
    CategoryController,
    CustomerController,
    FrontBrandController,
    FrontCourseController,
    FrontFileController,
    FrontGalleryController,
    FrontImageController,
    FrontNewsController,
    FrontPortfolioCategoryController,
    FrontPortfolioImageController,
    FrontPortfoliosController,
    FrontProductController,
    FrontProductImageController,
    FrontReferencesController,
    FrontServicesController,
    FrontSettingController,
    FrontSlidersController,
    FrontVideoController,
    HelperController,
    HomeController,
    ModelController,
    PermissionController,
    ProductController,
    RoleController,
    StockInController,
    StockOutController,
    SupplierController,
    UnitController,
    UserController,
    WarehouseController
};

use App\Http\Controllers\Front\{AdvantageController,
    FrontContactController,
    FrontAboutController,
    FrontHomeController,
    ServicesController
};
use Illuminate\Support\Facades\Route;


Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('email/verify/{token}', [RegisterController::class, 'verifyEmail'])->name('verifyEmail');


Route::post('resendVerificationEmail', [VerificationController::class, 'resendVerificationEmail'])->name('resendVerificationEmail');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::prefix('/')->group(function () {
    Route::get('/', [FrontHomeController::class, 'index'])->name('homepage');
    Route::get('/work-area', [FrontHomeController::class, 'work_area'])->name('work-area');

    Route::resources([
        'about-us' => FrontAboutController::class,
        'service' => ServicesController::class,
        'advantage' => AdvantageController::class,
        'contact' => FrontContactController::class,
    ]);

});

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/rate-limited-users', [UserController::class, 'showRateLimitedUsers'])->name('rate.limited.users');
    Route::post('/rate-clear-users', [UserController::class, 'clearRateLimitedUsers'])->name('rate.clear.users');

    Route::get('/roles/{role}/users', [UserController::class, 'manageRoles'])->name('user.roles');
    Route::post('/roles/{role}/users', [UserController::class, 'updateRoles'])->name('user.update.roles');


    Route::get('/roles/{role}/permissions', [RoleController::class, 'managePermissions'])->name('roles.permissions');
    Route::post('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');


    Route::post('/isActive/{id}/users', [UserController::class, 'isActiveSetter'])->name('user.is-active-setter');
    Route::post('/isActive/{id}/product', [FrontProductController::class, 'isActiveSetter'])->name('ajax.is-active-setter');
    Route::post('/ajax-rankSetter', [FrontProductController::class, 'rankSetter'])->name('ajax-rankSetter');

    Route::get('/image-form/{id}/product', [FrontProductController::class, 'product_image'])->name('product.image-form');

    Route::post('/image-upload/{id}/product', [FrontProductController::class, 'product_image_upload'])->name('product.image-upload');

    Route::post('/image-refresh/{id}/product', [FrontProductController::class, 'product_refresh_image'])->name('product.refresh-image-list');


    Route::post('/isActive/{id}/product-image', [FrontProductImageController::class, 'isActiveSetter'])->name('ajax.is-active-setter-product-image');

    Route::post('/ajax-rankSetter-product-image', [FrontProductImageController::class, 'rankSetter'])->name('ajax-rankSetter-product-image');

    Route::post('/ajax-news-rankSetter', [FrontNewsController::class, 'rankSetter'])->name('ajax-news-rankSetter');

    Route::post('/isActive/{id}/news', [FrontNewsController::class, 'isActiveSetter'])->name('ajax.news-is-active-setter');

    Route::post('/ajax-references-rankSetter', [FrontReferencesController::class, 'rankSetter'])->name('ajax-references-rankSetter');

    Route::post('/isActive/{id}/references', [FrontReferencesController::class, 'isActiveSetter'])->name('ajax.references-is-active-setter');


    Route::post('/ajax-brands-rankSetter', [FrontBrandController::class, 'rankSetter'])->name('ajax-brands-rankSetter');

    Route::post('/isActive/{id}/brands', [FrontBrandController::class, 'isActiveSetter'])->name('ajax.brands-is-active-setter');

    Route::post('/ajax-courses-rankSetter', [FrontCourseController::class, 'rankSetter'])->name('ajax-courses-rankSetter');

    Route::post('/isActive/{id}/courses', [FrontCourseController::class, 'isActiveSetter'])->name('ajax.courses-is-active-setter');


    Route::post('/ajax-gallery-rankSetter', [FrontGalleryController::class, 'rankSetter'])->name('ajax.gallery-rankSetter');

    Route::post('/isActive/{id}/gallery', [FrontGalleryController::class, 'isActiveSetter'])->name('ajax.gallery-is-active-setter');

    Route::post('/isCoverSetter/{id}/{parent}/product-image', [FrontProductImageController::class, 'isCoverSetter'])->name('isCoverSetter-product-image');

    Route::post('/isActive/{id}/images-image', [FrontImageController::class, 'isActiveSetter'])->name('ajax.is-active-setter-images-image');

    Route::post('/ajax-rankSetter-images-image', [FrontImageController::class, 'rankSetter'])->name('ajax.images-rankSetter-image');

    Route::post('/image-refresh/{id}/images', [FrontImageController::class, 'refresh_image'])->name('images.refresh-image-list');

    Route::post('/isActive/{id}/files-file', [FrontFileController::class, 'isActiveSetter'])->name('ajax.is-active-setter-files-file');

    Route::post('/ajax-rankSetter-files-file', [FrontFileController::class, 'rankSetter'])->name('ajax.files-rankSetter-file');

    Route::post('/files-refresh/{id}/images', [FrontFileController::class, 'refresh_files'])->name('files.refresh-file-list');


    Route::post('/isActive/{id}/videos', [FrontVideoController::class, 'isActiveSetter'])->name('ajax.is-active-setter-videos');

    Route::post('/ajax-rankSetter-videos', [FrontVideoController::class, 'rankSetter'])->name('ajax.rankSetter-videos');


    Route::post('/isActive/{id}/services', [FrontServicesController::class, 'isActiveSetter'])->name('ajax.is-active-setter-services');

    Route::post('/ajax-rankSetter-services', [FrontServicesController::class, 'rankSetter'])->name('ajax.files-rankSetter-services');

    Route::post('/isActive/{id}/portfoliosCategories', [FrontPortfolioCategoryController::class, 'isActiveSetter'])->name('ajax.is-active-setter-portfoliosCategories');


    Route::post('/isActive/{id}/portfolios', [FrontPortfoliosController::class, 'isActiveSetter'])->name('ajax.is-active-setter-portfolios');

    Route::post('/ajax-rankSetter-portfolios', [FrontPortfoliosController::class, 'rankSetter'])->name('ajax.files-rankSetter-portfolios');

    Route::get('/image-form/{id}/portfolios', [FrontPortfoliosController::class, 'portfolios_image'])->name('portfolios.image-form');

    Route::post('/ajax-rankSetter-portfolio-image', [FrontPortfolioImageController::class, 'rankSetter'])->name('ajax-rankSetter-portfolio-image');

    Route::post('/isActive/{id}/portfolio-image', [FrontPortfolioImageController::class, 'isActiveSetter'])->name('ajax.is-active-setter-portfolio-image');

    Route::post('/image-refresh/{id}/portfolio', [FrontPortfoliosController::class, 'portfolio_refresh_image'])->name('portfolio.refresh-image-list');

    Route::post('/image-upload/{id}/portfolio', [FrontPortfoliosController::class, 'portfolio_image_upload'])->name('portfolio.image-upload');


    Route::post('/isActive/{id}/sliders', [FrontSlidersController::class, 'isActiveSetter'])->name('ajax.is-active-setter-sliders');

    Route::post('/ajax-rankSetter-sliders', [FrontSlidersController::class, 'rankSetter'])->name('ajax.rankSetter-sliders');

    Route::post('/isReadable/{id}/contacts', [BackContactController::class, 'isReadable'])->name('ajax.is-readable-setter-contacts');




    Route::resources([
        'stock-in' => StockInController::class,
        'stock-out' => StockOutController::class,
        'categories' => CategoryController::class,
        'models' => ModelController::class,
        'products' => ProductController::class,
        'warehouse' => WarehouseController::class,
        'units' => UnitController::class,
        'customers' => CustomerController::class,
        'suppliers' => SupplierController::class,
        'permissions' => PermissionController::class,
        'users' => UserController::class,
        'roles' => RoleController::class,
        'settings' => FrontSettingController::class,
        'product' => FrontProductController::class,
        'product-image' => FrontProductImageController::class,
        'news' => FrontNewsController::class,
        'references' => FrontReferencesController::class,
        'brands' => FrontBrandController::class,
        'courses' => FrontCourseController::class,
        'galleries' => FrontGalleryController::class,
        'images' => FrontImageController::class,
        'files' => FrontFileController::class,
        'galleries.videos' => FrontVideoController::class,
        'services' => FrontServicesController::class,
        'portfoliosCategories' => FrontPortfolioCategoryController::class,
        'portfolios' => FrontPortfoliosController::class,
        'portfolioImages' => FrontPortfolioImageController::class,
        'sliders' => FrontSlidersController::class,
        'contacts' => BackContactController::class,


    ]);

    Route::get('/ajax-product', [HelperController::class, 'getProductDetails'])->name('ajax-product');

    Route::get('/ajax-stock', [HelperController::class, 'getStockDetails'])->name('ajax-stock');


});
