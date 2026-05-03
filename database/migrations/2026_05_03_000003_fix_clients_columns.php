<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        DB::statement('ALTER TABLE clients ADD COLUMN IF NOT EXISTS first_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE clients ADD COLUMN IF NOT EXISTS middle_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE clients ADD COLUMN IF NOT EXISTS last_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE clients ADD COLUMN IF NOT EXISTS date_of_birth DATE NULL');
        DB::statement('ALTER TABLE clients ADD COLUMN IF NOT EXISTS id_type VARCHAR(255) NULL');
        DB::statement('ALTER TABLE clients ADD COLUMN IF NOT EXISTS id_number VARCHAR(255) NULL');
        DB::statement('ALTER TABLE clients ADD COLUMN IF NOT EXISTS client_type VARCHAR(255) NULL');
    }

    public function down(): void {}
};
