<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Livewire\Component;

class EditViewDiary extends Component
{
    protected $listeners = [
        // 'create' => 'create',
        'edit' => 'edit'
    ];

    protected $rules = [ // これは必須らしい
        'article.title' => ['required'],
        'article.content' => ['required'],
    ];

    public $article;

    public function render()
    {
        return view('livewire.article-input');
    }

    public function mount()
    {
        $this->create();
    }


    public function edit(Article $article)
    {
        $this->article = $article;
    }

    public function save()
    {
        $this->validate();
        $this->article->save();

        session()->flash('status', '保存が完了しました。');
        $this->emitTo('article-list', 'refresh');
        $this->create();
    }
}
