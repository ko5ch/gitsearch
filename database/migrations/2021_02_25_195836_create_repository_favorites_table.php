<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepositoryFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repository_favorites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('html_url')->unique();
            $table->text('description')->nullable();
            $table->string('owner_login', 39);
            $table->unsignedInteger('stargazers_count')->default(0);
            $table->unsignedBigInteger('repo_id')->unique();
        });

        Schema::create('repository_favorite_user', function (Blueprint $table) {
            $table->foreignId('repository_favorite_id')
                ->references('id')->on('repository_favorites')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->unique(['repository_favorite_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repository_favorite_user');
        Schema::dropIfExists('repository_favorites');
    }
}
