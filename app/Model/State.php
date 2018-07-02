<?php
/**
 * Created by PhpStorm.
 * User: nisheetkumar
 * Date: 02/07/18
 * Time: 11:12 AM
 */

namespace App\Model;

use App\Constants\Constant;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table =  Constant::STATETABLE;

}