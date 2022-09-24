<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demos', function (Blueprint $table) {
            $table->id();
            $table->string('select_admin_id');
            $table->string('multiple_admin_id');
            $table->string('color');
            $table->string('date');
            $table->string('datetime-local');
            $table->string('email');
            $table->string('file');
            $table->string('file_multiple')->nullable();
            $table->string('number');
            $table->string('password');
            $table->string('radio');
            $table->string('checkbox')->nullable();
            $table->integer('is_active')->default(0);
            $table->integer('serialize')->default(0);
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
        Schema::dropIfExists('demos');
    }
};
