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
        Schema::create('feedback_timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_id')->constrained();
            $table->string('pending')->nullable();
            $table->string('admin_receive')->nullable();
            $table->string('forwarded_receiver')->nullable();
            $table->string('receiver_received')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('feedback_timelines');
    }
};
