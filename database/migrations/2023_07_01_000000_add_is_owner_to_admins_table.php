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
        // Check if the column doesn't exist before adding it
        if (!Schema::hasColumn('admins', 'is_owner')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->boolean('is_owner')->default(false)->after('password');
            });

            // Set the first admin as owner if any exists
            $admin = DB::table('admins')->first();
            if ($admin) {
                DB::table('admins')->where('id', $admin->id)->update(['is_owner' => true]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('is_owner');
        });
    }
};
