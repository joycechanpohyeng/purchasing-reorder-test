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
        Schema::create('image_upload', function (Blueprint $table) {
			$table->id();
            $table->boolean('check')->nullable();
			$table->string('employee_id');
			$table->string('email');
			$table->string('store_code');
			$table->string('sku_code');
			$table->integer('order_qty');
			$table->integer('remaining_qty');
			$table->string('file_name');
			$table->string('file_path');
            $table->date('generate_msg_at')->nullable();
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
        Schema::dropIfExists('image_upload');
    }
};
