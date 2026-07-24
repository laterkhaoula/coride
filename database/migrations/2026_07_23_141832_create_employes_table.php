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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');
            $table->string('ville_residence');
            $table->enum('role', ['conducteur', 'passager', 'les deux']);
            $table->string('password')->default('$2y$12$e.Y.lY.2e5lZ5kZ5kZ5kZu.Xy1.Xy1.Xy1.Xy1.Xy1.Xy1.Xy1.Xy'); // bcrypt('password')
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
