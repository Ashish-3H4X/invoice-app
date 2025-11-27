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
    Schema::create('invoice_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('invoice_id');
        $table->unsignedBigInteger('service_id')->nullable();
        
        $table->string('description');
        $table->integer('quantity')->default(1);
        $table->decimal('unit_price', 10, 2);
        $table->decimal('tax_rate', 5, 2)->default(0);
        $table->decimal('line_total', 10, 2);

        $table->timestamps();

        $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        $table->foreign('service_id')->references('id')->on('services');
    });
}

};
