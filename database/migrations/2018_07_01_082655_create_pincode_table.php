<?php

use App\Constants\Constant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePincodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable(Constant::PINTABLE))
        {
            Schema::drop(Constant::PINTABLE);
        }
        Schema::create(Constant::PINTABLE, function (Blueprint $table) {
            $table->string(Constant::OFFICENAME);
            $table->integer(Constant::PINCODE);
            $table->string(Constant::TALUK);
            $table->string(Constant::DISTRICT);
            $table->string(Constant::STATE);
            $table->timestamps(2);
            $table->primary([Constant::PINCODE,Constant::OFFICENAME]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Constant::PINTABLE);
    }
}
