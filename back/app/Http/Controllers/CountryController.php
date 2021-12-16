<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountries()
    {
        $countiesPath = storage_path('/countries/countries.json');
        $countries = json_decode(file_get_contents($countiesPath), true);

        return $countries;
    }
}