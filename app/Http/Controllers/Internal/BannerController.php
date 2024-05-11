<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'link' => 'required|url',
            'type' => 'required|in:default,body',
        ]);

        $banner = new Banners();
        $banner->image = $request->file('image')->store('banners');
        $banner->link = $request->input('link');
        $banner->type = $request->input('type');
        $banner->save();

        session()->flash('message', 'Banner created successfully.');

        return redirect()->route('banners.index');
    }

    public function update(Request $request, Banners $banner)
    {
        $request->validate([
            'image' => 'nullable|image',
            'link' => 'required|url',
            'type' => 'required|in:default,body',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($banner->image);
            $banner->image = $request->file('image')->store('banners');
        }

        $banner->link = $request->input('link');
        $banner->type = $request->input('type');
        $banner->save();

        session()->flash('message', 'Banner updated successfully.');

        return redirect()->route('banners.index');
    }

    public function destroy(Banners $banner)
    {
        Storage::delete($banner->image);
        $banner->delete();

        session()->flash('message', 'Banner deleted successfully.');

        return redirect()->route('banners.index');
    }

}
