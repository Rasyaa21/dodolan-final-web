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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');

            $table->string('customer_name');
            $table->string('customer_phone');
            $table->longText('customer_address');
            $table->integer('receipt_number')->nullable();

            $table->decimal('original_price', 20, 4);
            $table->decimal('discount', 20, 4)->nullable();
            $table->decimal('final_price', 20, 4);

            $table->enum('payment_status', ['pending', 'paid', 'failed']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
