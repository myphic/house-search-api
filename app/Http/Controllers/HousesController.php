<?php

namespace App\Http\Controllers;

use App\Imports\HousesImport;
use App\Models\House;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HousesController extends BaseController
{
    public function import()
    {
        Excel::import(new HousesImport, public_path() . '/csv/property-data.csv');
        return redirect('/')->with('success', 'Success!');
    }

    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $query = House::where('name', 'LIKE', '%' . $request->query('name') . '%')
                        ->where('price', '>=', $request->query('priceFrom', 0))
                        ->where('price', '<=', $request->query('priceTo', PHP_INT_MAX));
        $requestedParams = $request->all();
        unset($requestedParams['name']);
        unset($requestedParams['priceFrom']);
        unset($requestedParams['priceTo']);
        return response($query->where($requestedParams)->get()->toJson(), Response::HTTP_OK);
    }
}
