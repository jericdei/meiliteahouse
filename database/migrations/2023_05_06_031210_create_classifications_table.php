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
        Schema::create('investor_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('total_investment', 9, 2);
            $table->decimal('interest_rate', 4, 3);
            $table->decimal('referral_rate', 4, 3);
            $table->json('freebies')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_classifications');
    }
};
