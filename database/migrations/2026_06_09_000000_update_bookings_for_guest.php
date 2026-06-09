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
        Schema::table('bookings', function (Blueprint $table) {
            // allow nullable user for guest bookings
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // guest details
            if (!Schema::hasColumn('bookings', 'guest_name')) {
                $table->string('guest_name')->nullable()->after('playstation_id');
            }

            if (!Schema::hasColumn('bookings', 'guest_phone')) {
                $table->string('guest_phone')->nullable()->after('guest_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'guest_phone')) {
                $table->dropColumn('guest_phone');
            }

            if (Schema::hasColumn('bookings', 'guest_name')) {
                $table->dropColumn('guest_name');
            }

            // Attempt to revert user_id nullability (may require DBAL)
            // If DBAL isn't available this will be a no-op for many setups.
            try {
                $table->unsignedBigInteger('user_id')->nullable(false)->change();
            } catch (\Throwable $e) {
                // ignore if change cannot be performed automatically
            }
        });
    }
};
