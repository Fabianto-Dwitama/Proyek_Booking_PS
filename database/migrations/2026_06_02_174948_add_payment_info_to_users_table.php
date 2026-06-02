<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('nama_rental')->nullable();

            $table->string('no_whatsapp')->nullable();

            $table->string('rekening_bca')->nullable();

            $table->string('rekening_bni')->nullable();

            $table->string('dana')->nullable();

            $table->string('gopay')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'nama_rental',
                'no_whatsapp',
                'rekening_bca',
                'rekening_bni',
                'dana',
                'gopay'
            ]);

        });
    }
};