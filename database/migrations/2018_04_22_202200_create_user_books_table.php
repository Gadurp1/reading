<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserBooksTable extends Migration {

	public function up()
	{
		Schema::create('user_books', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('book_id')->unsigned();
				$table->integer('user_id')->unsigned();
				$table->integer('order');
				$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('user_books');
	}
}
