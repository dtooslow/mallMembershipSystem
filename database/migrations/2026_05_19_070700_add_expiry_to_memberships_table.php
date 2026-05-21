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
        Schema::table('memberships', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('points');
            $table->timestamp('last_renewed_at')->nullable()->after('expires_at');
        });

        // Set default values for any existing records
        try {
            \Illuminate\Support\Facades\DB::table('memberships')->update([
                'expires_at' => now()->addYear(),
                'last_renewed_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Ignore if DB class isn't loaded or table empty
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->dropColumn(['expires_at', 'last_renewed_at']);
        });
    }
};
