<?php
/**
 * Created by PhpStorm.
 * User: nisheetkumar
 * Date: 29/06/18
 * Time: 11:40 AM
 */

namespace App\Model;

use Illuminate\Support\Facades\Validator;
use App\Constants\Constant;
use GuzzleHttp\Client;
use Http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
class Pincode extends Model
{

    public function getAdd($pincode)
    {
        $validator = Validator::make(array(Constant::PINCODE=>$pincode),
                [Constant::PINCODE =>'required|digits:6']);
        if($validator->fails()===true) {
            return response()->json(['info' => 'enter valid pincode']);
        }
        return DB::table(Constant::PINTABLE)
            ->select([Constant::DISTRICT, Constant::STATE, Constant::PINCODE])
            ->distinct()
            ->where(Constant::PINCODE, $pincode)
            ->get();

        //return $query_response;
    }


    public function getPin($request)
    {
        //$district = $request[Constant::DISTRICT];
        //$state =$request[Constant::STATE];
        $validator = Validator::make($request->all(),
            [
                Constant::STATE => 'required|max:255',
                Constant::DISTRICT =>'required|max:255'
            ]);
        if($validator->fails()===true) {
            return response()->json(['info' => 'enter valid query']);
        }
        $district = $request->input(Constant::DISTRICT);
        $state = $request->input(Constant::STATE);
        return DB::table(Constant::PINTABLE)->distinct()
            ->where([[Constant::DISTRICT,'=',$district],[Constant::STATE,'=',$state]])
            ->get([Constant::PINCODE]);
    }


    public function populateDatabase()
    {
        $limit=1000;
        $json_offset = json_decode(DB::table(Constant::OFFSETTABLE)
            ->select('offset')
            ->where('id','=',1)
            ->get(),true);
        $offset=$json_offset[0]['offset'];

        $url = "https://api.data.gov.in/resource/";
        $data = array('api-key'=>Constant::KEY,
            'format'=>'json',
            'offset'=>$offset,
            'limit'=>$limit);

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $url,
        ]);
        
        $response = $client->request('GET','6176ee09-3d56-4a3b-8115-21841576b2f6',
            [ 'query' => $data ]);
        //echo $response->getStatusCode();// "200"
        if($response->getStatusCode()===200)
        {
            $json_response =  json_decode($response->getBody(),true);
            foreach ($json_response['records'] as $record) {
                //echo $record['pincode'];
                try {
                    DB::table(Constant::PINTABLE)
                        ->insert([
                            Constant::OFFICENAME => $record['officename'],
                            Constant::PINCODE => $record['pincode'],
                            Constant::TALUK => $record['taluk'],
                            Constant::DISTRICT => $record['districtname'],
                            Constant::STATE => $record['statename'],
                            Constant::CREATETIME => now(),
                            Constant::UPDATETIME => now()
                        ]);
                } catch (QueryException $exception) {
                    echo "Key already in database:".$record['pincode'].':'.$record['officename'], '\n';
                }
            }
            if($json_response['count']<$limit)
            {
                $offset = 0;
            }
            else
            {
                $offset +=$limit;
            }
            DB::table(Constant::OFFSETTABLE)
                ->where('id', '=',1)
                ->update([Constant::OFFSET=>$offset,
                    Constant::UPDATETIME=>now()]);
        }
    }
}