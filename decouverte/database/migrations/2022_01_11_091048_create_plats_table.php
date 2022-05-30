<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # La classe Blueprint représente vos tables en BDD à partir de vos Models dans votre application Laravel
        Schema::create('plats', function (Blueprint $table) {
            # Ligne générée par la cli (make:migration) représente l'id auto incrémentée.
            $table->id();

            //////////////////////////RELATION/////////////////////////////////
            #Pr créer une relation il vous faudra ajouter ces instructions
            $table->unsignedBigInteger('cocktail_id');
            $table->foreign('cocktal_id')
                ->references('id')
                ->on('cocktails')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            ///////////////////////////////////////////////////////////////////

            # Grace à l'objet Blueprint, on peut construire notre table avec les méthodes fournies par Laravel
            $table->string('title');
            $table->mediumText('content');

            #Ligne générée par la cli représente vos propriétés creatAt, udateAt
            $table->timestamps();

            # On peut lancer la cmd: php artisan migrate
            # une fois la migration faite, on peut voir le statut aveec lacli: php artisan migrate:status
        });
    }



    /**
     * Cette
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plats');
    }
}

