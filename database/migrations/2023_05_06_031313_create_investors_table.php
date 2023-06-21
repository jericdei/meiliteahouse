<?php

use App\Enums\Investors\InvestorStatusEnum;
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
        Schema::create('investors', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('status')->default(InvestorStatusEnum::ACTIVE->value);
            $table->string('referral_code')->unique();
            $table->uuid('referred_by')
                ->nullable();
            $table->double('referral_bonus', 9, 2)->default(0);
            $table->unsignedInteger('age');
            $table->string('occupation_type');
            $table->json('occupation_data');
            $table->uuid('user_id')
                ->nullable();
            $table->foreignId('classification_id')
                ->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
