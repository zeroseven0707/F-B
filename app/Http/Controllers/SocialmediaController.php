<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocialmediaController extends Controller
{
    public function index(Request $request)
    {
        $apiKey = $request->header('api_key');
        $user = User::where('api_key',$apiKey)->first();
        $webId = $user->id;

        $socialMedia = SocialMedia::where('web_id',$webId)->get();
        return response()->json([
            'message' => 'successfully fetched docial media',
            'data' => $socialMedia
        ], 200);
    }

    public function show($id, Request $request)
    {
        $apiKey = $request->header('api_key');
        $user = User::where('api_key',$apiKey)->first();
        $webId = $user->id;

        $socialMedia = SocialMedia::where('web_id',$webId)->where('id',$id)->first();

        if (!$socialMedia) {
            return response()->json(['message' => 'Social media not found'], 404);
        }

        return response()->json(['data' => $socialMedia], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image',
            'link' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $imageName = $request->file('image')->store('social-media');
        $socialMedia = SocialMedia::create([
            'name' => $request->name,
            'image' => $imageName,
            'link' => $request->link,
        ]);

        return response()->json(['message' => 'Successfully created socialmedia','data' => ['id' => $socialMedia->id]], 201);
    }

    public function update(Request $request, $id)
    {
        $socialMedia = SocialMedia::find($id);

        if (!$socialMedia) {
            return response()->json(['message' => 'Social media not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'nullable|file|image',
            'link' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('social-media', 'public');
            $socialMedia->image = $imagePath;
        }

        $socialMedia->name = $request->name;
        $socialMedia->link = $request->link;
        $socialMedia->save();

        return response()->json(['message' => 'Social media updated','data'=>[$socialMedia->id]], 200);
    }

    public function destroy($id)
    {
        $socialMedia = SocialMedia::find($id);

        if (!$socialMedia) {
            return response()->json(['message' => 'Social media not found'], 404);
        }
        Storage::disk('public')->delete($socialMedia->image);

        $socialMedia->delete();

        return response()->json(['message' => 'Social media deleted'], 200);
    }
}
