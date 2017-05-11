<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Token;
class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->string('name');
        });

    $data = array(
    array('id'=> 1, 'token'=> 'M123', 'name'=>'Some'),
    array('id'=> 2, 'token'=> 'T123', 'name'=>'Any'),
    );
   DB::table('tokens')->insert($data); // Query Builder
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
