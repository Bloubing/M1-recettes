<?php

namespace App\Livewire;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SearchResults extends Component
{
    // On met les résultats réactifs pour qu'ils se mettent à jour selon 
    // le searchText de Search
    #[Reactive]
    public $results = [];

    public $type;

    public function mount($type) {
        //On récupère "type" qui est passé depuis le composant Search
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.search-results');
    }

  
}
