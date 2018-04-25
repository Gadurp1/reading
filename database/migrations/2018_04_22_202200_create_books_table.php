<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBooksTable extends Migration {

	public function up()
	{
			Schema::create('books', function(Blueprint $table) {
				$table->increments('id');
				$table->string('google_id');
				$table->integer('author_id')->unsigned();;
				$table->string('title', 255)->index();
				$table->string('description');
				$table->string('slug');
				$table->string('image', 500);
				$table->integer('page_count');
				$table->timestamps();
			});
	}

	public function down()
	{
		Schema::drop('books');
	}
}
