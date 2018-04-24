<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookSubscriptionsTable extends Migration {

	public function up()
	{
		Schema::create('book_subscriptions', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('book_id')->unsigned();
				$table->integer('user_id')->unsigned();
				$table->integer('order');
				$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('book_subscriptions');
	}
}
