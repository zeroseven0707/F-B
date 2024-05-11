<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $apiKey = $request->header('api_key');
        $user = User::where('api_key',$apiKey)->first();
        $webId = $user->id;

        $articles = Article::where('web_id',$webId)->get();
        return response()->json(['message'=>'successfully fethced articles','data' => $articles], 200);
    }

    public function show($id, Request $request)
    {
        $apiKey = $request->header('api_key');
        $user = User::where('api_key',$apiKey)->first();
        $webId = $user->id;

        $article = Article::where('web_id',$webId)->where('id',$id)->first();

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json(['message'=>'successfully fethced article','data' => $article], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'image' => 'required|file',
            'text' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $imagePath = $request->file('image')->store('article');

        $article = Article::create([
            'title' => $request->title,
            'image' => $imagePath,
            'date' => Carbon::now(),
            'text' => $request->text,
        ]);

        return response()->json(['message'=>'Article created','data' => $article], 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'image' => 'file',
            'text' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
            $article->image = $imagePath;
        }

        $article->title = $request->title;
        $article->text = $request->text;
        $article->save();

        return response()->json(['message'=>'Article updated','data' => $article], 200);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $article->delete();

        return response()->json(['message' => 'Article deleted'], 200);
    }
}
