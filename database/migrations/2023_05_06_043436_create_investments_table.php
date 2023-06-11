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
        Schema::create('transaction_investments', function (Blueprint $table) {
            $table->id();
            $table->double('amount', 9, 2);
            $table->string('status')->default(StatusEnum::Pending->value);
            $table->string('payment_method');
            $table->string('reference_no');
            $table->string('proof_of_payment');
            $table->foreignId('investor_id')
                ->nullable()->constrained('investors');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_investments');
    }
};
