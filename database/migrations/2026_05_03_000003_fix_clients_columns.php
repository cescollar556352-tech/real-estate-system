<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'first_name')) $table->string('first_name')->nullable();
            if (!Schema::hasColumn('clients', 'middle_name')) $table->string('middle_name')->nullable();
            if (!Schema::hasColumn('clients', 'last_name')) $table->string('last_name')->nullable();
            if (!Schema::hasColumn('clients', 'date_of_birth')) $table->date('date_of_birth')->nullable();
            if (!Schema::hasColumn('clients', 'id_type')) $table->string('id_type')->nullable();
            if (!Schema::hasColumn('clients', 'id_number')) $table->string('id_number')->nullable();
            if (!Schema::hasColumn('clients', 'client_type')) $table->string('client_type')->nullable();
        });
    }
    public function down(): void {}
};
