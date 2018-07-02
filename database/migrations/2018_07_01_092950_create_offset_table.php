<?php

use App\Constants\Constant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffsetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable(Constant::OFFSETTABLE))
        {
            Schema::drop(Constant::OFFSETTABLE);
        }
        Schema::create(Constant::OFFSETTABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->integer(Constant::OFFSET);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offset');
    }
}
