<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    public function index(Request $request)
    {
        // Get search term from request
        $search = $request->query('search');
        $filterType = $request->query('type');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');  
        $availabilityStatus = $request->query('availability_status'); 

        $cars = Car::query();
        
        // Apply Search
        if ($search) {
            $cars = $cars->where('name', 'like', "%$search%");
        }
    
        // Apply filter by car type, price range and availability status
        if ($filterType) {
            $cars = $cars->where('type', $filterType);
        }

        if ($minPrice && $maxPrice) {
            $cars = $cars->whereBetween('price_per_day', [$minPrice, $maxPrice]);
        } elseif ($minPrice) {
            $cars = $cars->where('price_per_day', '>=', $minPrice);
        } elseif ($maxPrice) {
            $cars = $cars->where('price_per_day', '<=', $maxPrice);
        }

        if ($availabilityStatus) {
            $cars = $cars->where('availability_status', $availabilityStatus);
        }

        return response()->json($cars->get());
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
