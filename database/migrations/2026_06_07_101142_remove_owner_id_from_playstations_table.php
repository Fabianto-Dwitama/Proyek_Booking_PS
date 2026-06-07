<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('playstations', function (Blueprint $table) {

            if (Schema::hasColumn('playstations', 'owner_id')) {
                $table->dropColumn('owner_id');
            }

        });
    }

    public function down(): void
    {
        Schema::table('playstations', function (Blueprint $table) {

            $table->unsignedBigInteger('owner_id')->nullable();

        });
    }
};