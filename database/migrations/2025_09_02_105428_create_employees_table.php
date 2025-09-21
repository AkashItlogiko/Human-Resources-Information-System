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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');

            // contact & identity
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('nid_number')->nullable();

            // payroll
            $table->decimal('salary', 10, 2)->nullable();

            // files
            $table->string('profile_photo')->nullable();
            $table->string('document_file')->nullable(); // stored as "documents/filename.ext"

            // addresses
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
