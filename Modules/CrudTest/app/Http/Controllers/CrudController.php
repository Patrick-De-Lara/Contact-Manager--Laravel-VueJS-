<?php

namespace Modules\CrudTest\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController as BackpackCrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Illuminate\Http\JsonResponse;
use Modules\CrudTest\app\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
        CRUD::field('profile_image')->type('upload')->upload(true)->validationRules('required|image|max:4096'); // max 4MB
    }

    //select * from contacts
    public function showData(): JsonResponse
    {
        $contacts = CRUD::getEntries();

        $contacts = $contacts->map(function ($contact) {
            if ($contact->profile_image) {
                $contact->profile_image_url = asset('storage/' . $contact->profile_image);
            }
            return $contact;
        });
        
        return response()->json($contacts);
    }

    // Insert sanitized and validated data into the database
    public function store(): JsonResponse
    {
        $request = $this->crud->validateRequest();

        // If ID exists, route to update
        if($request->has('id')){
            return $this->update($request->input('id'));
        }   

        $data = [
            'name' => strip_tags(trim($request->input('name'))),
            'email' => strtolower(trim($request->input('email'))),
            'phone' => trim($request->input('phone')),
        ];

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $path = $file->store('profile_images', 'public'); 
            $data['profile_image'] = $path; 
        }

        $item = $this->crud->create($data);

        if ($item->profile_image) {
            $item->profile_image_url = url('storage/' . $item->profile_image);
        }

        return response()->json($item, 201);
    }

    // Update the existing contact
    public function update($id): JsonResponse
    {
        $request = $this->crud->validateRequest();
        
        $contact = Contact::findOrFail($id);

        $data = [
            'name' => strip_tags(trim($request->input('name'))),
            'email' => strtolower(trim($request->input('email'))),
            'phone' => trim($request->input('phone')),
        ];

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($contact->profile_image) {
                Storage::disk('public')->delete($contact->profile_image);
            }
            
            $file = $request->file('profile_image');
            $path = $file->store('profile_images', 'public'); 
            $data['profile_image'] = $path; 
        }

        // Update the contact
        $contact->update($data);

       
        if ($contact->profile_image) {
            $contact->profile_image_url = url('storage/' . $contact->profile_image);
        }

        return response()->json($contact, 200);
    }

    // Delete a contact
    public function destroy($id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        // Delete profile image if exists
        if ($contact->profile_image) {
            Storage::disk('public')->delete($contact->profile_image);
        }

        $contact->delete();
        return response()->json(['message' => 'Contact deleted successfully'], 200);
    }
}