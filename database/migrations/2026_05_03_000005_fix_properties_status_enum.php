<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        DB::statement("ALTER TABLE properties MODIFY COLUMN status ENUM('available', 'sold', 'rented') DEFAULT 'available'");
    }
    public function down(): void {}
};
