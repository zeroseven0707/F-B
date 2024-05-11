<?php

namespace App\Livewire;

use App\Models\Faqs;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FaqManagement extends Component
{
    public $question, $answer, $faq_id, $updateMode = false;

    public function render()
    {
        $faqs = Faqs::where('web_id',auth()->user()->id)->get();
        return view('livewire.faq-management', compact('faqs'));
    }

    public function create()
    {
        $this->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faqs::create([
            'question' => $this->question,
            'answer' => $this->answer,
            'web_id' => Auth::user()->id,
        ]);

        session()->flash('message', 'FAQ created successfully.');

        $this->reset(['question', 'answer']);
    }

    public function edit($id)
    {
        $faq = Faqs::findOrFail($id);
        $this->faq_id = $id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = Faqs::findOrFail($this->faq_id);
        $faq->update([
            'question' => $this->question,
            'answer' => $this->answer,
        ]);

        session()->flash('message', 'FAQ updated successfully.');

        $this->reset(['question', 'answer', 'faq_id', 'updateMode']);
    }

    public function delete($id)
    {
        Faqs::findOrFail($id)->delete();

        session()->flash('message', 'FAQ deleted successfully.');
    }
}
