<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            //
            $table->foreignId('delivery_id')->constrained('delivery_statuses')->cascadeOnDelete();
            $table->boolean('delivered')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            //
            $table->dropForeign(['delivery_id']);

            $table->dropColumn('delivery_id');
            $table->dropColumn('delivered');
        });
    }
};
