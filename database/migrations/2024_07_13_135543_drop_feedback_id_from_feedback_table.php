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
        Schema::table('feedback', function (Blueprint $table) {
            //
            if (Schema::hasColumn('feedback', 'feedback_id')) {
                $table->dropColumn('feedback_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('feedback', 'feedback_id')) {
                $table->unsignedBigInteger('feedback_id')->nullable();
            }
        });
    }
};
