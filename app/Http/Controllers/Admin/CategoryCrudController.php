<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Category');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/category');
        $this->crud->setEntityNameStrings('category', 'categories');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        /*$this->crud->setFromDb();*/
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'created_at', 'type' => 'datetime', 'label' => 'Created']);
        $this->crud->addColumn(['name' => 'updated_at', 'type' => 'datetime', 'label' => 'Updated']);        
    }

    protected function setupCreateOperation()
    {
        // TODO: remove setFromDb() and manually define Fields
        /*$this->crud->setFromDb();*/
        $this->crud->setValidation(CategoryRequest::class);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
