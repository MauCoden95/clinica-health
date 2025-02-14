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
                'text' => 'Categoría eliminada correctamente'
            ]);

            $this->getCategories();
        }
    }

    public function create(){
        if ($this->name == '') {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Campos vacíos'
                ]);

            return;
        }

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


    public function editCategory(){
        if ($this->name == '') {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Campos vacíos'
                ]);

            return;
        }

        $category = Category::find($this->categoryId);

        $update = $category->update([
            'name' => $this->name,
        ]);


        if ($update) {
            $this->dispatch('showAlert', [
            'type' => 'success',
            'title' => '¡Éxito!',
            'text' => 'Categoría editada correctamente'
            ]);

            $this->name = '';
            $this->getCategories();
        }

    }
    
}
