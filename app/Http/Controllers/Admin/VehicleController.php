<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\VehicleManufacturers;
use App\Vehicle;

class VehicleController extends Controller {

    public function fetchVehicleManufacturers(Request $request) {
        $url = "https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getMakes&sold_in_us=1";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $contents = curl_exec($ch);
//if (curl_error($ch)) {
//    echo 'error:' . curl_error($ch);
//}
        curl_close($ch);
        $contents = json_decode(substr($contents, 2, -2));
        foreach ($contents->Makes as $value) {
            $insert = array("name" => $value->make_id);
            $vehicleManufacturer = VehicleManufacturers::firstOrNew($insert);
            $vehicleManufacturer->save();
            $this->fetchVehicleModel($vehicleManufacturer);
        }
    }

    public function fetchVehicleModel($vehicleManufacturer) {
        $url = "https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getModels&make=" . $vehicleManufacturer->name . "&sold_in_us=1";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $contents = curl_exec($ch);
        //if (curl_error($ch)) {
        //    echo 'error:' . curl_error($ch);
        //}
        curl_close($ch);
        $contents = json_decode(substr($contents, 2, -2));
        foreach ($contents->Models as $value) {
            $insert = array("model" => $value->model_name, "vehicle_manufacturer_id" => $vehicleManufacturer->id);
            $vehicle = Vehicle::firstOrNew($insert);
            $vehicle->save();
        }
    }
    public function fetchVehicleBody($vehicleManufacturer) {
        $url = "https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getModels&make=" . $vehicleManufacturer->name . "&sold_in_us=1";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $contents = curl_exec($ch);
        //if (curl_error($ch)) {
        //    echo 'error:' . curl_error($ch);
        //}
        curl_close($ch);
        $contents = json_decode(substr($contents, 2, -2));
        foreach ($contents->Models as $value) {
            $insert = array("model" => $value->model_name, "vehicle_manufacturer_id" => $vehicleManufacturer->id);
            $vehicle = Vehicle::firstOrNew($insert);
            $vehicle->save();
        }
    }
    public function fetchAll() {
        $url = "https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getTrims&model=Excursion&make=ford";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $contents = curl_exec($ch);
        //if (curl_error($ch)) {
        //    echo 'error:' . curl_error($ch);
        //}
        curl_close($ch);
        $contents = json_decode(substr($contents, 2, -2));
        dd($contents);
        foreach ($contents->Models as $value) {
            $insert = array("model" => $value->model_name, "vehicle_manufacturer_id" => $vehicleManufacturer->id);
//            $vehicle = Vehicle::create($insert);
        }
    }

}
