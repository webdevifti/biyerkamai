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
        Schema::create('guest_gifts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('guest_name')->nullable();
            $table->string('guest_address')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('gift_type')->nullable();
            $table->integer('gift_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_gifts');
    }
};
