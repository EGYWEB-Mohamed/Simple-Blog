<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class HomePosts extends Component
{
    public $paginate = 12;
    public $search;
    protected $listeners = [
        'searchMethod' => 'search'
    ];
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.home-posts',[
            'posts' => Post::whereActive(true)
                            ->when($this->search,function (Builder $builder){
                                $builder->where('title','LIKE','%'.$this->search.'%');
                            })
                           ->take($this->paginate)->get(),
        ]);
    }

    public function search($searchTerm)
    {
        $this->search = $searchTerm;
    }
    public function loadMore()
    {
        $this->paginate += 12;
    }
}
