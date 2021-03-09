<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug');
            $table->string('subtitle')->nullable();
            $table->string('photo')->nullable();

            $table->text('excerpt')->nullable();
            $table->text('presentation')->nullable();
            $table->text('content')->nullable();

            $table->integer('views')->default(0);

            $table->timestamp('published_at')->nullable();
            $table->bigInteger('user_id');

            //campurile meta pentru SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
