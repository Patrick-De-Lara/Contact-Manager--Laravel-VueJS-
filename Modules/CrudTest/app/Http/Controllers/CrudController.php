<?php

namespace Modules\CrudTest\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController as BackpackCrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Illuminate\Http\JsonResponse;
use Modules\CrudTest\app\Models\Contact;

class CrudController extends BackpackCrudController
{
    public function setup()
    {
        CRUD::setModel(Contact::class);
        CRUD::setEntityNameStrings('contact', 'contacts');
    }

    public function setupCreateOperation()
    {
        CRUD::field('name')->validationRules('required|string|max:255');
        CRUD::field('email')->validationRules('required|email|unique:contacts,email');
        CRUD::field('phone')->validationRules('required|string|max:20');
    }

    //select * from contacts
    public function showData(): JsonResponse
    {
        $contacts = CRUD::getEntries();
        
        return response()->json($contacts);
    }

    
    // Insert sanitized and validated data into the database
    public function store(): JsonResponse
    {
        $request = $this->crud->validateRequest();

        $data = [
            'name' => strip_tags(trim($request->input('name'))),
            'email' => strtolower(trim($request->input('email'))),
            'phone' => trim($request->input('phone')),
        ];

        $item = $this->crud->create($data);

        return response()->json($item);
    }
}