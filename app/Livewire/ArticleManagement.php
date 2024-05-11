<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArticleManagement extends Component
{
    public function render()
    {
        $articles = Article::where('web_id',auth()->user()->id)->get();
        return view('livewire.article-management', compact('articles'));
    }
    use WithFileUploads;

    public $title, $date, $text, $image;
    public $selectedId, $updateMode = false;


    public function create()
    {
        $this->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'text' => 'required|string',
            'image' => 'required|image',
        ]);

        $imagePath = $this->image->store('articles', 'public');

        Article::create([
            'title' => $this->title,
            'date' => $this->date,
            'text' => $this->text,
            'image' => $imagePath,
            'web_id' => Auth::user()->id
        ]);

        session()->flash('message', 'Article created successfully.');

        $this->reset(['title', 'date', 'text', 'image']);
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->selectedId = $id;
        $this->title = $article->title;
        $this->date = $article->date;
        $this->text = $article->text;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'text' => 'required|string',
        ]);

        $article = Article::findOrFail($this->selectedId);
        $article->title = $this->title;
        $article->date = $this->date;
        $article->text = $this->text;

        if ($this->image) {
            // Delete existing image
            Storage::delete('public/' . $article->image);

            // Store new image
            $imagePath = $this->image->store('articles', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        session()->flash('message', 'Article updated successfully.');

        $this->reset(['title', 'date', 'text', 'selectedId', 'updateMode', 'image']);
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        session()->flash('message', 'Article deleted successfully.');
    }
}
