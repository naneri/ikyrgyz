<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsToCountriesCities extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->table('countries', function(Blueprint $table)
		{
			$table->string('name_ru', 50);
                        $table->string('name_en', 50);
                        $table->string('code', 5);
                        $table->integer('sort');
                        $table->dropColumn('name');
                        $table->dropTimestamps();
                });
                Schema::connection('mysql_users')->table('cities', function(Blueprint $table) {
                        $table->integer('region_id');
                        $table->string('name_ru', 50);
                        $table->string('name_en', 50);
                        $table->string('code', 5);
                        $table->integer('sort');
                        $table->dropColumn('name');
                        $table->dropTimestamps();
                });
        }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql_users')->table('countries', function(Blueprint $table)
		{
			
		});
	}

}
