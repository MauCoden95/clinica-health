<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;


class CategoryList extends Component
{
    public $categoryId;
    public $categories;
    public $count_categories;
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount(){
        $this->getCategories();
    }

    public function render()
    {
        return view('livewire.category-list');
    }

    public function getCategories(){
        $this->categories = Category::all();
        $this->count_categories = count($this->categories);
    }

    public function delete(){
        $category = Category::find($this->categoryId);

        if ($category) {
            $category->delete();

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Proveedor eliminado correctamente'
            ]);

            $this->getCategories();
        }
    }

    public function create(){
        //dd($this->name);

        $create = Category::create([
            'name' => $this->name,
        ]);

        if ($create) {
            $this->dispatch('showAlert', [
            'type' => 'success',
            'title' => '¡Éxito!',
            'text' => 'Categoría creada correctamente'
            ]);

            $this->name = '';
            $this->getCategories();
        }

    }
    
}
