<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTicketidDefault extends Migration
{

    public function up()
    {
        Schema::table('entries', function (Blueprint $table) {
            DB::statement('ALTER TABLE `entries` MODIFY COLUMN `ticket_id` varchar(11) DEFAULT NULL;');
            DB::statement('UPDATE `entries` SET `ticket_id` = NULL WHERE `ticket_id` = 0;');
        });
    }

    public function down()
    {
        Schema::table('entries', function (Blueprint $table) {
            DB::statement('UPDATE `entries` SET `ticket_id` = 0 WHERE `ticket_id` = NULL;');
            DB::statement('ALTER TABLE `entries` MODIFY COLUMN `ticket_id` int(11) DEFAULT 0;');
        });
    }

}