<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\User;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apiKey = $request->header('api_key');
        $user = User::where('api_key',$apiKey)->first();
        $webId = $user->id;
        try {
            $faqs = Faqs::where('web_id',$webId)->get();
            return response()->json(['message' => 'successfully fethced Faqs', 'data' => $faqs], 200);

        } catch (\Exception $a) {
            // Tangani jika validasi gagal
            return response()->json(['message' => 'Validation failed', 'errors' => $a->errors()], 422);
        }
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
