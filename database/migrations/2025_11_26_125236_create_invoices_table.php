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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id');
        $table->string('invoice_no')->unique();
        $table->date('invoice_date');
        $table->date('due_date')->nullable();

        $table->decimal('subtotal', 10, 2);
        $table->decimal('tax_total', 10, 2)->default(0);
        $table->decimal('total', 10, 2);

        $table->string('status')->default('unpaid'); // paid / unpaid / overdue
        $table->text('notes')->nullable();

        $table->timestamps();

        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
    });
}

};
