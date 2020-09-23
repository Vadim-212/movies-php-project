<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('original_name');
            $table->longText('description');
            $table->integer('year');

            $table->foreignIdFor(App\Models\Country::class)
                ->constrained()
                ->onDelete('cascade');

            $table->foreignIdFor(App\Models\Genre::class)
                ->constrained()
                ->onDelete('cascade');

            $table->string('image_path')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
