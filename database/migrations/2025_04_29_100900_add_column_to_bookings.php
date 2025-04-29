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
            if (!Schema::hasColumn('bookings', 'provider_id')) {
                $table->foreignId('provider_id')
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('cascade')
                    ->after('client_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'provider_id')) {
                $table->dropForeign(['provider_id']);
                $table->dropColumn('provider_id');
            }
        });
    }
};
