<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            //
            // Check if the column does not exist before adding it
            if (!Schema::hasColumn('feedback', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id')->nullable();
            }
            //$table->unsignedBigInteger('user_id')->after('id');

            // If you have a users table and want to set up a foreign key constraint
           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        // Set a default user_id for existing rows
        $defaultUserId = 1; // Change this to a valid user ID in your users table
        DB::table('feedback')->update(['user_id' => $defaultUserId]);

        Schema::table('feedback', function (Blueprint $table) {
            // Add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
