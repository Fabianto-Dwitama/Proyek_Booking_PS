<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->decimal('nominal', 10, 2)
                  ->after('metode');

            $table->dropColumn('bukti_transfer');

        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->string('bukti_transfer')
                  ->nullable();

            $table->dropColumn('nominal');

        });
    }
};