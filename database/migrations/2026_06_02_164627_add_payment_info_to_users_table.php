<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('whatsapp')
                  ->nullable();

            $table->string('rekening_bca')
                  ->nullable();

            $table->string('rekening_bni')
                  ->nullable();

            $table->string('dana')
                  ->nullable();

            $table->string('gopay')
                  ->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'whatsapp',
                'rekening_bca',
                'rekening_bni',
                'dana',
                'gopay'
            ]);

        });
    }
};