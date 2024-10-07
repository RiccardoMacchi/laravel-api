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
        Schema::create('framework_item', function (Blueprint $table) {
            $table->unsignedBigInteger('framework_id');

            $table->foreign('framework_id')
                ->references('id')
                ->on('frameworks')
                ->cascadeOnDelete();


            $table->unsignedBigInteger('item_id');

            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('framework_item');
    }
};
