<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Genre::query()->create([
            'name' => 'Криминал'
        ]);

        \App\Models\Country::query()->create([
            'name' => 'Великобритания'
        ])->create([
            'name' => 'США'
        ]);

        \App\Models\Actor::query()->create([
            'name' => 'Мэттью МакКонахи',
            'original_name' => 'Matthew McConaughey',
            'date_of_birth' => '1969-11-04',
            'country_id' => '2',
            'image_path' => 'public/images/matthew_mcconaughey.png'
        ]);

        \App\Models\Movie::query()->create([
            'name' => 'Джентльмены',
            'original_name' => 'The Gentlemen',
            'description' => 'Один ушлый американец ещё со студенческих лет приторговывал наркотиками, а теперь
            придумал схему нелегального обогащения с использованием поместий обедневшей английской аристократии и
            очень неплохо на этом разбогател. Другой пронырливый журналист приходит к Рэю, правой руке американца,
            и предлагает тому купить киносценарий, в котором подробно описаны преступления его босса при участии других
            представителей лондонского криминального мира - партнёра-еврея, китайской диаспоры, чернокожих спортсменов
            и даже русского олигарха.',
            'year' => '2019',
            'country_id' => '1',
            'genre_id' => '1',
            'image_path' => 'public/images/the_gentlemen.png'
        ]);

        \App\Models\MovieActor::query()->create([
            'movie_id' => '1',
            'actor_id' => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
