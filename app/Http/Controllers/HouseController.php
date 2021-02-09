<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param House $house
     * @return JsonResponse
     */
    public function index(Request $request, House $house): JsonResponse
    {
        $houses = $house->newQuery();
        if ($request->has('bedrooms')) {
            $houses->where('bedrooms', $request->input('bedrooms'));
        }
        if ($request->has('bathrooms')) {
            $houses->where('bathrooms', $request->input('bathrooms'));
        }
        if ($request->has('garages')) {
            $houses->where('garages', $request->input('garages'));
        }
        if ($request->has('storeys')) {
            $houses->where('storeys', $request->input('storeys'));
        }
        if ($request->has('low')) {
            $houses->where('price', '>=', $request->input('low'));
        }
        if ($request->has('high')) {
            $houses->where('price', '<=', $request->input('high'));
        }
        if ($request->has('name')) {
            $houses->where('name', 'like', "%".$request->input('name')."%");
        }
        return response()->json($houses->get());
    }
}
