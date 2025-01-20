<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // References the user who submitted the ticket
        $table->string('type'); // 'Software' or 'Hardware'
        $table->string('status')->default('Open'); // 'Open', 'Closed', etc.
        $table->string('system')->nullable(); // System (e.g., SAP)
        $table->string('sub_system')->nullable(); // Sub-system
        $table->string('wo_type')->nullable(); // Work Order type (e.g., Modification, Problem)
        $table->text('scope')->nullable(); // Scope or issue description
        $table->text('description')->nullable(); // Detailed description
        $table->timestamps(); // Created and Updated timestamps

        // Foreign key constraint
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
