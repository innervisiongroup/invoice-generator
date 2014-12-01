<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_options', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('type');
			$table->string('option_group')->nullable();
			$table->integer('weight');
			$table->integer('price');
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
		Schema::drop('invoice_options');
	}

}
