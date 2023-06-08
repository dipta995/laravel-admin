<?php

use App\Models\Demo;
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
        Schema::create(with(new Demo)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('select_admin_id')->nullable();
            $table->string('multiple_admin_id')->nullable();
            $table->string('color')->nullable();
            $table->string('date')->nullable();
            $table->string('datetime-local')->nullable();
            $table->string('email')->nullable();
            $table->string('file')->nullable();
            $table->string('file_multiple')->nullable();
            $table->string('number')->nullable();
            $table->string('password')->nullable();
            $table->string('radio')->nullable();
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
        Schema::dropIfExists(with(new Demo)->getTable());
    }
};
