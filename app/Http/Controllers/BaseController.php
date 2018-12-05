<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller {


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {


    }

    public function sendJsonResponse($response) {
        return \Illuminate\Support\Facades\Response::json($this->convertToCamelCase($response), $response['status_code'])->header('Content-Type', "application/json");
    }

    /**
     * Convert to Camel Case
     *
     * Converts array keys to camelCase, recursively.
     * @param  array  $array Original array
     * @return array
     */
    protected function convertToCamelCase($array) {
        $converted_array = [];
        foreach ($array as $old_key => $value) {
            if (is_array($value)) {
                $value = $this->convertToCamelCase($value);
            } else if (is_object($value)) {
                if ($value instanceof Model) {
                    $value = $value->toArray();
                } else if (method_exists($value, 'toArray')) {
                    $value = $value->toArray();
                } else {
                    $value = (array) $value;
                }


                $value = $this->convertToCamelCase($value);
            }
            $converted_array[camel_case($old_key)] = $value;
        }

        return $converted_array;
    }

}
