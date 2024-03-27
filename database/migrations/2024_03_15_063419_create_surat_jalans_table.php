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
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->id();
            
            $table->uuid('mobile_id_sj')->nullable();

            $table->string('surat_jalan');
            $table->date('tgl_sj');
            $table->foreignId('id_pabrik')->constrained('pabriks')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_jalans');
    }
};