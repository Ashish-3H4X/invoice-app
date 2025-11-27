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
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('unit_price', 10, 2);
        $table->decimal('tax_rate', 5, 2)->default(0);
        $table->string('sku')->nullable();
        $table->timestamps();
    });
}

};
