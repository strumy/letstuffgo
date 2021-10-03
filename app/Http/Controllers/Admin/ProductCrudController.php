<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings('product', 'products');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        /*$this->crud->setFromDb();*/
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'sku', 'type' => 'text', 'label' => 'SKU / Product Unique ID']);
        $this->crud->addColumn(['name' => 'price', 'type' => 'text', 'label' => 'Price / €']);
        $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addColumn(['name' => 'user.name', 'type' => 'text', 'label' => 'User Name']);
        $this->crud->addColumn(['name' => 'category.name', 'type' => 'text', 'label' => 'Category']);
        $this->crud->addColumn(['name' => 'publish_date', 'type' => 'text', 'label' => 'Publish Date']);
        $this->crud->addColumn(['name' => 'blocking_date', 'type' => 'text', 'label' => 'Blocking Date']);
        $this->crud->addColumn(['name' => 'created_at', 'type' => 'text', 'label' => 'Created Om']);
        $this->crud->addColumn(['name' => 'updated_at', 'type' => 'text', 'label' => 'Updated On']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setValidation(ProductRequest::class);
        /*$this->crud->setFromDb();*/

        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addField([  // CKEditor / Markdown
            'name' => 'description',
            'label' => 'Description',
            'type' => 'simplemde',            
            // optional
            'simplemdeAttributes' => [
            //   'promptURLs' => true,
            //   'status' => false,
            //   'spellChecker' => false,
            //   'forceSync' => true,
            ],
            // 'simplemdeAttributesRaw' => $some_json

            //'type' => 'ckeditor',
            // optional:
            //'options' => [
            //    'autoGrow_minHeight' => 200,
            //    'autoGrow_bottomSpace' => 50,
            //    'removePlugins' => 'resize,maximize',
        ]);
        
        $this->crud->request->request->add(['user_id'=> backpack_user()->id]);        
        $this->crud->addField([   // Hidden
            'name' => 'user_id',
            'type' => 'hidden'
        ]);

        $this->crud->request->request->add(['sku'=> uniqid() ]);
        $this->crud->addField([   // Hidden
            'name' => 'sku',
            'type' => 'hidden'
        ]);

        $this->crud->addField([
            'name' => 'price', 
            'type' => 'number', 
            'label' => 'Price',
            'attributes' => ["step" => "any"], // allow decimals
            'prefix' => "€"
        ]);
        
        $this->crud->addField(
        [// 1-n relationship
            'label' => "Category", // Table column heading
            'type' => "select",
            'name' => 'category_id', // the column that contains the ID of that connected entity;
            'entity' => 'category', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Category", // foreign key model
        ]);

        $this->crud->addField(
        [   // radio
            'name'        => 'status', // the name of the db column
            'label'       => 'Status', // the input label
            'type'        => 'enum'            
        ]);

        $this->crud->addColumn(['name' => 'created_at', 'type' => 'datetime', 'label' => 'Created']);
        $this->crud->addColumn(['name' => 'updated_at', 'type' => 'datetime', 'label' => 'Updated']);        
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
