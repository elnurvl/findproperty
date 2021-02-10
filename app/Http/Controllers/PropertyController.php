<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Property $property
     * @return JsonResponse
     */
    public function index(Request $request, Property $property): JsonResponse
    {
        $results = $property->newQuery();
        if ($request->has('bedrooms')) {
            $results->where('bedrooms', $request->input('bedrooms'));
        }
        if ($request->has('bathrooms')) {
            $results->where('bathrooms', $request->input('bathrooms'));
        }
        if ($request->has('garages')) {
            $results->where('garages', $request->input('garages'));
        }
        if ($request->has('storeys')) {
            $results->where('storeys', $request->input('storeys'));
        }
        if ($request->has('low')) {
            $results->where('price', '>=', $request->input('low'));
        }
        if ($request->has('high')) {
            $results->where('price', '<=', $request->input('high'));
        }
        if ($request->has('name')) {
            $results->where('name', 'like', "%".$request->input('name')."%");
        }
        return response()->json($results->get());
    }
}
