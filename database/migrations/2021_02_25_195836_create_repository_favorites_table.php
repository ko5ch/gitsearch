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
        Schema::dropIfExists('repository_favorites');
    }
}
