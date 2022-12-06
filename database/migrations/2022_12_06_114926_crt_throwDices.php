<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up ()
  {
    Schema::create('throwDices', function (Blueprint $table) {
      $table->id ();
      $table->unsignedInteger ('idthrpla');
      $table->unsignedInteger ('result');
      $table->enum ('win', ['wins', 'loses']);
      $table->timestamps ();
    });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
