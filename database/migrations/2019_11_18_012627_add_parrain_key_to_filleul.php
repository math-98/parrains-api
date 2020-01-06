<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParrainKeyToFilleul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filleuls', function (Blueprint $table) {
            $table->unsignedBigInteger('parrain_id')->nullable();

            $table->foreign('parrain_id')
                ->references('id')->on('filleuls')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filleul', function (Blueprint $table) {
        });
    }
}
