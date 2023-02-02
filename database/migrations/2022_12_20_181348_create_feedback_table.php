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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->comment('client who sent feedback.');
            $table->foreignId('client_type_id')->nullable();
            $table->foreignId('feedback_type_id')->constrained();
            $table->boolean('is_office')->default(0);
            $table->longText("comment");
            $table->foreignId('office_id')->nullable();
            $table->foreignId('receiver_id')->nullable()->constrained('users');
            $table->foreignId('status_id')->default(1)->constrained();
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
        Schema::dropIfExists('feedback');
    }
};
