<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'bedrooms')) $table->unsignedTinyInteger('bedrooms')->nullable();
            if (!Schema::hasColumn('properties', 'bathrooms')) $table->unsignedTinyInteger('bathrooms')->nullable();
            if (!Schema::hasColumn('properties', 'lot_area')) $table->decimal('lot_area', 10, 2)->nullable();
            if (!Schema::hasColumn('properties', 'floor_area')) $table->decimal('floor_area', 10, 2)->nullable();
        });
    }
    public function down(): void {}
};
