<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Tag;
use App\Models\Ingredient;
use Livewire\Component;


class Search extends Component
{

    public $searchText = "";
    public $results = [];

    // Type par défaut du sort-by (bouton à gauche
    // de la barre de recherche )
    public $type = "Recettes";

    // Méthode appelée dès que searchText est modifié
    // searchText étant l'input de la barre de recherche
    public function updatedSearchText($value) {
        
        $this->reset('results');

        // On n'affiche les résultats qu'après 2 caractères entrés
        if (strlen($value) < 2) return;

        $searchTerm = "%{$value}%";

        if ($this->type == "Tags") {
            $this->results = Tag::where('name', 'LIKE', $searchTerm)->orderBy('name')->get(); 
        } 
        else if ($this->type == "Ingrédients") {
            
            $this->results = Ingredient::where('name', 'LIKE', $searchTerm)->orderBy('name')->get(); 
        }
        else if ($this->type == "Utilisateurs") {
            $this->results = User::where('name', 'LIKE', $searchTerm)->orderBy('name')->get(); 
        } 
        else { // Recettes (mis en else pour que ce soit par défaut)
            $this->results = Recipe::where('title', 'LIKE', $searchTerm)->orderBy('title')->get(); 
        }
    }

    // Changer le type de recherche
    public function setType($typeChoisi) {
       
        $this->type = $typeChoisi;
        
    }

    // Clear les résultats et le searchText
    // lorsque l'on clique sur le body
    // (présence d'un event dispatcher sur le main)
    #[On('clearSearchResults')]
    public function clear() {
        $this->reset('results', 'searchText');
    }


    public function render()
    {
        return view('livewire.search');
    }
}
