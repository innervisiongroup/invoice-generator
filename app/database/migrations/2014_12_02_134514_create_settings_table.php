<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('app_name');
			$table->string('main_logo');
			$table->string('favicon');
			$table->string('company_name');
			$table->string('company_street_address');
			$table->string('company_zip_code');
			$table->string('company_city');
			$table->string('company_country');
			$table->string('company_phone_number');
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
		Schema::drop('settings');
	}

}
