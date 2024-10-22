<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('total_price', 10, 2);
            $table->timestamp('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
