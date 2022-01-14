<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGhRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gh_requests', function (Blueprint $table) {
            $table->id();

            $table->string('endpoint');
            $table->string('query');
            $table->integer('page');
            $table->integer('per_page');
            $table->integer('last');

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
        Schema::dropIfExists('gh_requests');
    }
}
