<?php

namespace App\Controllers;

use App\MyClass\Pizza as ClassPizza;

class Pizza extends BaseController
{

    public function getIndex()
    {

        return $this->view('/pizza/index');
    }


    public function getEdit($id_pizza)
    {
        $this->addBreadcrumb('Administrateur', '#');
        $this->addBreadcrumb('Gestion des pizza', ['Pizza']);
        $stepModel = model('StepModel');
        $steps = $stepModel->getAllStep();
        $categoryModel = model('CategoryModel');
        $categories = $categoryModel->getAllCategory();
        $ingredientModel = model('IngredientModel');
        $ingredients = $ingredientModel->getAllIngredient();
        if ($id_pizza == 'new') {
            $this->title = "Créer la pizza";
            $this->addBreadcrumb('Création pizza ', ['Pizza', 'edit', 'new']);
            return $this->view(
                '/pizza/edit',
                [
                    'steps' => $steps,
                    'categories' => $categories,
                    'ingredients' => $ingredients,
                ]
            );
        }
        $this->title = "Gérer la pizza";
        $pizzaModel = model('PizzaModel');
        $pizza = $pizzaModel->getPizzaById($id_pizza);
        $this->addBreadcrumb('Edition de ' . $pizza['name'], ['Pizza']);
        if ($pizza) {
            return $this->view('/pizza/edit', ['pizza' => $pizza]);
        }
        $this->error("La pizza n'existe pas.");
        return $this->redirect('Pizza');
    }

    public function getAjaxCategories(){
        $idStep = $this->request->getVar('idStep');
        $categoryModel = model('CategoryModel');
        $categories = $categoryModel->getCategoriesByIdStep($idStep);

        return $this->response->setJSON($categories);
    }
}
