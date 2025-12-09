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
            Schema::table('courses', function (Blueprint $table) {
                $table->unsignedBigInteger('program_id')->nullable()->after('id');
                $table->boolean('is_active')->default(true)->after('description');

                $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null');
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
        {
            Schema::table('courses', function (Blueprint $table) {
                $table->dropForeign(['program_id']);
                $table->dropColumn(['program_id', 'is_active']);
            });
        }
};
