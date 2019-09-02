<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class Vehicle
 * @package App\Models
 */
class Vehicle extends Model
{
    //
    /**
     * @var array
     */
    protected $primaryKey = 'license_Plate';
    /**
     * @var string
     */
    protected $keyType = 'string';
    /**
     * @var array
     */
    protected $fillable = ['license_Plate', 'make', 'model', 'year'];
    /**
     * @var string
     */
    public $table = 'vehicles';
    /**
     * @var bool
     */
    public $timestamps = false;
    /*
     * Get All Vehicles ByIdentifier(
     * */
    /**
     * @param $identifier
     * @return array
     */
    public function GetVehicleByIdentifier($identifier, $source)
    {
            /*
             * Get Data From CSV File
             * */
        try {
            if ($source == "csv") {
                $filePath = public_path().'/vehicles.csv';
                /* File Path */



                $rows = array_map(function ($v) {
                    return str_getcsv($v, ";");
                }, file($filePath));

                /* Get headers from CSV */
                $header = array_shift($rows);
                $csvData = [];
                foreach ($rows as $row) {
                    $csvData[] = array_combine($header, $row);
                }
                $csvDump = collect($csvData);
                $filteredCsvData = $csvDump->where('identifier', $identifier);
                return $filteredCsvData->all();


                /*
                 * Get Data From Json Server
                 * */
            } elseif ($source == "3drpartyapi") {
                /* Create Http Client*/
                $Guzzclient = new Client();
                try {
                    $response = $Guzzclient->get('http://localhost:8652/vehicles');
                    $response = json_decode($response->getBody()->getContents(), true);
                    $VehicleCollection = collect($response);

                     $filteredDatabyIdentifier = $VehicleCollection->where('identifier', $identifier);
                     if ($filteredDatabyIdentifier->isEmpty()) {
                        return null;
                     } else {
                        return $filteredDatabyIdentifier;
                     }
                } catch (RequestException $e) {
                    return$e->getMessage();
                    return response()->json(['error' => 'Json Server Not started on PORT:8652.'], 500);
                }

            /* Fetch Data From Database   */
            } elseif ($source == "database") {
                $allVehicleFromDb = Vehicle::where('license_Plate', $identifier)->first();
                return $allVehicleFromDb;
            } else {
                return response()->json(['error' => 'Invalid Source'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }


        /**
         * Get Vehilce Data from File
         * @return array
         */

        public function getVehilceDatafromFile()
        {
        $filePath = public_path().'/vehicles.csv';

        //    die($filePath);

        $rows = array_map(function ($v) {
            return str_getcsv($v, ";");
        }, file($filePath));

        /* Get headers from CSV */
        $header = array_shift($rows);
        $csvData = [];
        foreach ($rows as $row) {
            $csvData[] = array_combine($header, $row);
        }


        return $csvData;
        }




    /**
     * Update Vehicle By Identifier
     * @param $request
     * @return int
     */
    public function updateVehiclesByidentifier($request)
    {

        $identifierID = $request->get('identifier');
        if ($identifierID) {
            $make = $request->get('make');
            $model = $request->get('model');
            $year = $request->get('year');
            $vehicles = Vehicle::find($identifierID);
            if ($make) {
                $vehicles->make = $request->make;
            }
            if ($model) {
                $vehicles->model = $request->model;
            }
            if ($year) {
                $vehicles->year = $request->year;
            }
            $saved = $vehicles->save();
            return $saved;
        } else {
            return 2;
        }
    }
}
