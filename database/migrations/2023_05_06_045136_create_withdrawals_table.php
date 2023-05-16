<?php

use App\Enums\Common\StatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->double('amount', 9, 2);
            $table->string('status')->default(StatusEnum::Pending->value);
            $table->string('payment_method');
            $table->string('account_number');
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
        Schema::dropIfExists('transaction_withdrawals');
    }
};
