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
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(StatusEnum::Pending->value);
            $table->string('referral_code')->unique();
            $table->foreignId('referred_by')
                ->nullable()->constrained('investors');
            $table->double('referral_bonus', 9, 2)->default(0);
            $table->unsignedInteger('age');
            $table->string('occupation_type');
            $table->json('occupation_data');
            $table->string('valid_id');
            $table->foreignId('user_id')
                ->nullable()->constrained('users');
            $table->foreignId('classification_id')
                ->nullable()->constrained('investor_classifications');
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
