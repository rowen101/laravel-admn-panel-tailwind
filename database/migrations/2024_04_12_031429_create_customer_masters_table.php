<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wm_customer_masters', function (Blueprint $table) {
            $table->id();
            $table->string('cuscode',20);
            $table->string('cusname',100);
            $table->integer('leadtime');
            $table->integer('stockfreshness');
            $table->integer('status');
            $table->string('created_by',20);
            $table->string('updated_by',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wm_customer_masters');
    }
};
