<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
			$table->engine = 'InnoDB';
        	$table->increments('id');
        	$table->string('id_article',255)->unique();
			$table->integer('meta_id')->unsigned();
			$table->integer('details_id')->unsigned();
        });

		Schema::create('article_details', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('ministere', 255);
			$table->string('nature', 255);
			$table->date('publication');
			$table->date('signature');
			$table->text('titre');
			$table->text('contenu');
		});

		Schema::create('article_meta', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('meta_id', 255);
			$table->string('joid', 255);
			$table->string('url', 255);
			$table->string('origine',255);
			$table->string('nature', 255);
			$table->string('type', 255);
			$table->date('debut');
			$table->date('fin');
		});

		Schema::create('article_version', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->string('id_version');
			$table->string('origine', 255);
			$table->string('etat', 255);
			$table->date('debut');
			$table->date('fin');

			$table->foreign('article_id')->references('id')->on('article')->onUpdate('restrict')->onDelete('restrict');
		});



		Schema::table('article', function (Blueprint $table) {
			$table->foreign('meta_id')->references('id')->on('article_meta')->onUpdate('restrict')->onDelete('restrict');
			$table->foreign('details_id')->references('id')->on('article_details')->onUpdate('restrict')->onDelete('restrict');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('article_version');
		Schema::drop('article_meta');
		Schema::drop('article_details');
		Schema::drop('article');




    }
}
