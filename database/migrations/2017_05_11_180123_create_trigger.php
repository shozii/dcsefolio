<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER privilege_instructor
        BEFORE INSERT ON `instructors`
        FOR EACH ROW
        BEGIN
            IF(NEW.`token`="M123")
            THEN
                SET NEW.`privileged`=1;
            ELSE
                SET NEW.`privileged`=0;
            END IF;
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::unprepared('DROP TRIGGER `privilege_instructor`');
    }
}
