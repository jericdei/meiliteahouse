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
        Schema::create('franchising_form_submissions', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('full_name');
            $table->text('address');
            $table->unsignedInteger('age');
            $table->string('contact_no');
            $table->string('email');
            $table->string('target_location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchising_form_submissions');
    }
};
