<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MessageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class MessageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Message');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/message');
        $this->crud->setEntityNameStrings('message', 'messages');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'sender.name', 'type' => 'text', 'label' => 'Sender']);
        $this->crud->addColumn(['name' => 'recepient.name', 'type' => 'text', 'label' => 'Recepient']);
        $this->crud->addColumn(['name' => 'product.name', 'type' => 'text', 'label' => 'Product']);
        $this->crud->addColumn(['name' => 'location', 'type' => 'text', 'label' => 'Location']);
        $this->crud->addColumn(['name' => 'created_at', 'type' => 'text', 'label' => 'Created Om']);
        $this->crud->addColumn(['name' => 'updated_at', 'type' => 'text', 'label' => 'Updated On']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(MessageRequest::class);

        $this->crud->addField(
        [// 1-n relationship
            'label' => "Sender", // Table column heading
            'type' => "select",
            'name' => 'sender_id', // the column that contains the ID of that connected entity;
            'entity' => 'sender', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\BackpackUser", // foreign key model
        ]);

        $this->crud->addField(
        [// 1-n relationship
            'label' => "Recepient", // Table column heading
            'type' => "select",
            'name' => 'recepient_id', // the column that contains the ID of that connected entity;
            'entity' => 'recepient', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\BackpackUser", // foreign key model
        ]);

        $this->crud->addField(
        [// 1-n relationship
            'label' => "Products", // Table column heading
            'type' => "select",
            'name' => 'product_id', //  the column that contains the ID of that connected entity;
            'entity' => 'product', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Product", // foreign key model
        ]);

        $this->crud->addField(['name' => 'location', 'type' => 'text', 'label' => 'Location']);
        $this->crud->addField([  // CKEditor / Markdown
            'name' => 'content',
            'label' => 'Message',
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
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
