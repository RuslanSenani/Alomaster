<?php

use App\Traits\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    use MigrationHelper;

    public function up(): void
    {
        $this->createBrandsTable();

        $this->createCoursesTable();

        $this->createGalleriesTable();

        $this->createFilesTable();

        $this->createImagesTable();

        $this->createVideosTable();

        $this->createMembersTable();

        $this->createNewsTable();

        $this->createPopupsTable();

        $this->createPortfolioCategoriesTable();

        $this->createPortfoliosTable();

        $this->createPortfolioImagesTable();

        $this->createProductsTable();

        $this->createProductImagesTable();

        $this->createReferencesTable();

        $this->createServicesTable();

        $this->createSettingsTable();

        $this->createSlidesTable();

        $this->createTestimonialsTable();


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        $tables = ['brands', 'courses', 'files', 'images', 'videos', 'galleries', 'members', 'news', 'popups', 'portfolios', 'portfolio_categories', 'portfolio_images', 'product_images', 'f_products', 'references', 'services', 'settings', 'slides', 'testimonials',];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }

    }

    /**
     * @return void
     */
    public function createBrandsTable(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img_url');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);
        });
    }

    /**
     * @return void
     */
    public function createCoursesTable(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('title');
            $table->text('description');
            $table->string('img_url');
            $table->dateTime('event_date');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);
        });
    }
    /**
     * @return void
     */
    public function createGalleriesTable(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('title');
            $table->enum('gallery_type', ['file', 'image', 'video']);
            $table->string('folder_name');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
        });
    }

    /**
     * @return void
     */
    public function createFilesTable(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained('galleries')->onDelete('cascade');
            $table->string('url');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);

        });
    }

    /**
     * @return void
     */
    public function createImagesTable(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained('galleries')->onDelete('cascade');
            $table->string('url');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);
        });
    }

    /**
     * @return void
     */
    public function createVideosTable(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained('galleries')->onDelete('cascade');
            $table->string('url');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);
        });
    }

    /**
     * @return void
     */
    public function createMembersTable(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);

        });
    }

    /**
     * @return void
     */
    public function createNewsTable(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('title');
            $table->text('description');
            $table->string('news_type', 10);
            $table->string('img_url');
            $table->string('video_url');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
        });
    }

    /**
     * @return void
     */
    public function createPopupsTable(): void
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('page', 50);
            $table->boolean('isActive')->default(false);
        });
    }

    /**
     * @return void
     */
    public function createPortfoliosTable(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('portfolio_categories')->onDelete('cascade');
            $table->string('url');
            $table->string('portfolio_url');
            $table->string('title');
            $table->text('description');
            $table->integer('client');
            $table->string('place');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $table->timestamp('finishedAt')->nullable();
            $this->addCommonColumns($table);
        });
    }

    /**
     * @return void
     */
    public function createPortfolioCategoriesTable(): void
    {
        Schema::create('portfolio_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);
        });
    }

    /**
     * @return void
     */
    public function createPortfolioImagesTable(): void
    {
        Schema::create('portfolio_images', function (Blueprint $table) {
            $table->id();
            $table->integer('portfolio_id');
            $table->string('img_url');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);

        });
    }

    /**
     * @return void
     */
    public function createProductImagesTable(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('f_products')->onDelete('cascade');
            $table->string('img_url')->nullable();
            $table->integer('rank')->default(0);
            $table->boolean('isActive')->default(false);
            $table->boolean('isCover')->default(false);
            $this->addCommonColumns($table);


        });
    }

    /**
     * @return void
     */
    public function createProductsTable(): void
    {
        Schema::create('f_products', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);

        });
    }


    /**
     * @return void
     */
    public function createReferencesTable(): void
    {
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('img_url')->nullable();
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);
        });
    }

    /**
     * @return void
     */
    public function createServicesTable(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('title');
            $table->string('description');
            $table->string('img_url');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);


        });
    }

    /**
     * @return void
     */
    public function createSettingsTable(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('about_us')->nullable();
            $table->string('address')->nullable();
            $table->string('mission')->nullable();
            $table->string('vision')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('fax_1')->nullable();
            $table->string('fax_2')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tik_tok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('x')->nullable();
            $table->string('linkedin')->nullable();
            $this->addCommonColumns($table);

        });
    }

    /**
     * @return void
     */
    public function createSlidesTable(): void
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('allowButton')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_caption')->nullable();
            $table->string('animation_type')->nullable();
            $table->string('animation_time')->nullable();
            $table->integer('rank')->nullable();
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);

        });
    }

    /**
     * @return void
     */
    public function createTestimonialsTable(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('full_name');
            $table->string('company');
            $table->string('img_url');
            $table->integer('rank');
            $table->boolean('isActive')->default(false);
            $this->addCommonColumns($table);
        });
    }


};
