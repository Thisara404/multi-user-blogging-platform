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
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->text('provider_token')->nullable();
            $table->string('avatar')->nullable();

            // Make password nullable for OAuth users
            $table->string('password')->nullable()->change();

            // Add unique constraint for provider + provider_id
            $table->unique(['provider', 'provider_id']);
        });

        // Make password nullable in a separate statement for better compatibility
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['provider', 'provider_id']);
            $table->dropColumn(['provider', 'provider_id', 'provider_token', 'avatar']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();
            $table->dropUnique(['provider', 'provider_id']);
        });
    }
};
