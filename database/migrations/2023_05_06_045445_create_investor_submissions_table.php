<?php

use App\Enums\Common\StatusEnum;
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
        Schema::create('investor_submissions', function (Blueprint $table) {
            $table->uuid("id");
            $table->string('status')->default(StatusEnum::Pending->value);
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('contact_no');
            $table->string('email');
            $table->string('profile_picture');
            $table->unsignedInteger('age');
            $table->foreignId('referred_by')
                ->nullable()
                ->constrained('investors');
            $table->string('occupation_type');
            $table->json('occupation_data');
            $table->double('investment_amount', 9, 2);
            $table->string('reference_no');
            $table->string('payment_method');
            $table->string('valid_id');
            $table->string('proof_of_payment');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_submissions');
    }
};
