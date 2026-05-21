<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->after('shop_id')
                ->constrained()->nullOnDelete();
            $table->unsignedInteger('quantity')->default(1)->after('product_id');
            $table->string('description')->nullable()->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn(['product_id', 'quantity', 'description']);
        });
    }
};
