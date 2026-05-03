<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        DB::statement('ALTER TABLE properties ADD COLUMN IF NOT EXISTS bedrooms TINYINT UNSIGNED NULL');
        DB::statement('ALTER TABLE properties ADD COLUMN IF NOT EXISTS bathrooms TINYINT UNSIGNED NULL');
        DB::statement('ALTER TABLE properties ADD COLUMN IF NOT EXISTS lot_area DECIMAL(10,2) NULL');
        DB::statement('ALTER TABLE properties ADD COLUMN IF NOT EXISTS floor_area DECIMAL(10,2) NULL');
    }

    public function down(): void {}
};
