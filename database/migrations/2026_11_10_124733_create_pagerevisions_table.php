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
        Schema::create('pagerevisions', function (Blueprint $table) {
            $table->id();
            //foreignId - Crea una id que fa referència a la clau primària d'una altra taula. En aquest cas, es crea una columna page_id que fa referència a la taula pages.
            //constrained - Afegeix una restricció de clau forana a la columna page_id, que fa referència a la taula pages.
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $table->longText('body ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagerevisions');
    }
};