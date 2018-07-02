<?php

use App\Constants\Constant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable(Constant::STATETABLE))
        {
            Schema::drop(Constant::STATETABLE);
        }
        Schema::create(Constant::STATETABLE,function (Blueprint $table)
        {
            $table->string(Constant::STATECODE)->unique();
            $table->string(Constant::STATE);
            $table->timestamps(2);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Constant::STATETABLE);
    }
}
