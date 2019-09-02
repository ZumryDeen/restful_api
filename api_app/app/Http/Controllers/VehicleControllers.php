<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * Class VehicleControllers
 * @package App\Http\Controllers
 */
class VehicleControllers extends Controller
{
    /**
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    /*
        * Get All Vehicles from Different Sources
        * */
    /**
     * @return false|\Illuminate\Http\JsonResponse|string
     */

    public function test2()
    {
        return response()->json(['error' => 'Json Server Not started on PORT:8022.'], 500);
    }

    public function getAllVehicles()
    {

        $vehicle = new Vehicle();

        $allVehicleFromDb = Vehicle::all()->toArray();
        $allVehicleFromCsv = $vehicle->getVehilceDatafromFile();

        $Guzzclient = new Client();
        try {
            $response = $Guzzclient->get('http://localhost:8652/vehicles');
            $response = json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Json Server Not started on PORT:8022.'], 500);
        }

        if ($allVehicleFromCsv) {
            $allVehicles = array_merge($allVehicleFromCsv, $allVehicleFromDb, $response);
        } else {
            return response()->json(['error' => 'CSV Data Soursce Not Found '], 204);
        }

        return json_encode($allVehicles);
    }



    public function getAllVehicless()
    {

        /*
         * Get All Vehicles from DataBase
         * */
        $vehicle = new Vehicle();
        $allVehicleFromDb = Vehicle::all()->toArray();

        /*  Get All Vehicles From Json Server
            change the json server PORT to 8652
        */
        $Guzzclient = new Client();
        try {
            $response = $Guzzclient->get('http://localhost:8652/vehicles');
            $response = json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Json Server Not started on PORT:8652.'], 500);
        }


        /* Get All Vehicles From CSV */


        $allVehicleFromCsv = $vehicle->getVehilceDatafromFile();


        if ($allVehicleFromCsv) {
            $allVehicles = array_merge($allVehicleFromCsv, $allVehicleFromDb, $response);
        } else {
            return response()->json(['error' => 'CSV Data Soursce Not Found '], 204);
        }

        return json_encode($allVehicles);
    }

    /**
     * @param $source
     * @param $identifier
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function getVehicles($source, $identifier)
    {
        try {
            $vehicle = new Vehicle();
            if ($source == "csv") {
                $Vehicles = $vehicle->GetVehicleByIdentifier($identifier, $source);
                if ($Vehicles) {
                    return json_encode($Vehicles);
                } else {
                    return response()->json(['error' => 'No matching vehicle found'], 200);
                }
            } elseif ($source == "3drpartyapi") {
                $Vehicles = $vehicle->GetVehicleByIdentifier($identifier, $source);
                if ($Vehicles) {
                    return json_encode($Vehicles);
                } else {
                    return response()->json(['error' => 'No matching vehicle found'], 200);
                }
            } elseif ($source == "database") {
                $Vehicles = $vehicle->GetVehicleByIdentifier($identifier, $source);
                if ($Vehicles) {
                    return json_encode($Vehicles);
                } else {
                    return response()->json(['error' => 'No matching vehicle found'], 200);
                }
            } else {
                return response()->json(['error' => 'Invalid Source'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateVehicle(Request $request)
    {
        $vehicle = new Vehicle();
        $Vehicles = $vehicle->updateVehiclesByidentifier($request);
        if ($Vehicles == 1) {
            return response()->json(['success' => 'Vehicle Updated'], 200);
        } elseif ($Vehicles == 2) {
            return response()->json(['error' => 'identifier is not set'], 201);
        }
    }
}
