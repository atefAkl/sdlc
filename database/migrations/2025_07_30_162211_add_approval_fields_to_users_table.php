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
            $table->boolean('is_approved')->default(false)->after('email_verified_at');
            $table->boolean('is_active')->default(false)->after('is_approved');
            $table->timestamp('approved_at')->nullable()->after('is_active');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
            $table->string('registration_type')->default('self')->after('approved_by'); // 'self' or 'admin'

            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['is_approved', 'is_active', 'approved_at', 'approved_by', 'registration_type']);
        });
    }
};
