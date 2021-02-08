<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        return response()->json($houses->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param House $house
     * @return Response
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param House $house
     * @return Response
     */
    public function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param House $house
     * @return Response
     */
    public function update(Request $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param House $house
     * @return Response
     */
    public function destroy(House $house)
    {
        //
    }
}