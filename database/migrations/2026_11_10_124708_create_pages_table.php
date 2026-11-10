<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //To create a new database table, use the create method on the Schema facade. 
        //The create method accepts two arguments: the first is the name of the table, 
        //while the second is a closure which receives a Blueprint object that may be used to define the new table:

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique(); //URL del títol. slug converteix el text en un format apre per url - https://laravel.com/framework/docs/13.x/strings#method-fluent-str-slug
            $table->longText('body');
            $table->timestamps();
            //string - Crea una columna de cadena de caràcters amb una longitud màxima de 255 caràcters.
            //longText - Crea una columna de text llarg que pot emmagatzemar grans quantitats de text.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};