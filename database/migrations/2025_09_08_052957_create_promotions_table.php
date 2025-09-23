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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained()->onDelete('cascade');

            $table->decimal('old_salary', 15, 2);
            $table->string('old_designation')->nullable();

            $table->decimal('increment_value', 15, 2)->nullable();
            $table->string('increment_type')->nullable();
            $table->decimal('increment_amount', 15, 2);

            $table->decimal('new_salary', 15, 2);
            $table->string('new_designation')->nullable();

            $table->date('effective_date')->nullable();
            $table->text('note')->nullable();

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
