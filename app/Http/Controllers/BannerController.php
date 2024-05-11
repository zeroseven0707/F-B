<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
       public function find(Request $request)
    {
        $apiKey = $request->header('api_key');
        $user = User::where('api_key',$apiKey)->first();
        return response()->json([
            'data'=>$user
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apiKey = $request->header('api_key');
        $user = User::where('api_key',$apiKey)->first();
        $webId = $user->id;

        $banner = Banners::where('web_id',$webId)->get();
        return response()->json([
            'data'=>$banner
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        try {
            // Validasi input
            $validatedData = $request->validate([
                'type' => 'required|string',
                'image' => 'required|image',
                'link' => 'required|url'
            ]);
        } catch (\Exception $a) {
            // Tangani jika validasi gagal
            return response()->json(['message' => 'Validation failed', 'errors' => $a->errors()], 422);
        }

        try {
            // menyimpan gambar ke dalam direktori
            $imagePath = $request->file('image')->store('banners');

            // membuat data banner baru
            $banner = new Banners();
            $banner->type = $validatedData['type'];
            $banner->image = $imagePath;
            $banner->link = $validatedData['link'];
            $banner->web_id = Auth::user()->id;
            $banner->save();

            return response()->json([
                'message'=>'successfully created banner',
                'data' => $banner
            ], 201);
        } catch (\Exception $e) {
            // menangani error jika terjadi
            return response()->json([
                'errors'=>'Failed to create banner'
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request,$type)
    {
        try {
        $apiKey = $request->header('api_key');
        $user = User::where('api_key',$apiKey)->first();
        $webId = $user->id;
            // Temukan banner berdasarkan ID
            $banner = Banners::where('web_id',$webId)->where('type',$type)->first();

            return response()->json(['data' => $banner], 200);
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            return response()->json(['message' => 'Banner not found', 'error' => $e->getMessage()], 404);
        }
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
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'type' => 'required|string',
                'image' => 'nullable|image',
                'link' => 'required|url',
            ]);
        } catch (\Exception $e) {
            // Tangani jika validasi gagal
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        }

        try {
            // Temukan banner berdasarkan ID
            $banner = Banners::findOrFail($id);

            // Jika ada file gambar baru diupload, simpan gambar ke dalam direktori
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('banners', 'public');
                $banner->image = $imagePath;
            }

            // Update data banner
            $banner->type = $validatedData['type'];
            $banner->link = $validatedData['link'];
            $banner->save();

            return response()->json(['message' => 'Banner updated successfully'], 200);
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            return response()->json(['message' => 'Failed to update banner', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Temukan banner berdasarkan ID
            $banner = Banners::findOrFail($id);

            // Hapus gambar dari direktori
            Storage::disk('public')->delete($banner->image);

            // Hapus data banner
            $banner->delete();

            return response()->json(['message' => 'Banner deleted successfully'], 200);
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            return response()->json(['message' => 'Failed to delete banner', 'error' => $e->getMessage()], 500);
        }
    }
}
