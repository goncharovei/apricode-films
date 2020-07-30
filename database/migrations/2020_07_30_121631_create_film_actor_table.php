<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmActorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('film_actor', function (Blueprint $table) {
			$table->unsignedInteger('film_id');
			$table->unsignedInteger('actor_id');
			
			$table->foreign('film_id', 'fk_film_actor_film_id_to_films')
				->references('id')->on('films')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('actor_id', 'fk_film_actor_actor_id_to_actors')
				->references('id')->on('actors')
				->onUpdate('cascade')
				->onDelete('cascade');
			
			$table->unique(['film_id', 'actor_id'], 'index_film_id_and_actor_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('film_actor');
	}

}
