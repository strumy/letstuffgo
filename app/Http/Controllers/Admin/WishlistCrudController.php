<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WishlistRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WishlistCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WishlistCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Wishlist');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/wishlist');
        $this->crud->setEntityNameStrings('wishlist', 'wishlists');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'user.name', 'type' => 'text', 'label' => 'User']);
        $this->crud->addColumn(['name' => 'product.name', 'type' => 'text', 'label' => 'Product']);
        $this->crud->addColumn(['name' => 'created_at', 'type' => 'text', 'label' => 'Created Om']);
        $this->crud->addColumn(['name' => 'updated_at', 'type' => 'text', 'label' => 'Updated On']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(WishlistRequest::class);

        $this->crud->addField(
        [// 1-n relationship
            'label' => "Users", // Table column heading
            'type' => "select",
            'name' => 'user_id', // the column that contains the ID of that connected entity;
            'entity' => 'user', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\BackpackUser", // foreign key model
        ]);

        $this->crud->addField(
        [// 1-n relationship
            'label' => "Products", // Table column heading
            'type' => "select",
            'name' => 'product_id', // the column that contains the ID of that connected entity;
            'entity' => 'product', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Product", // foreign key model
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
