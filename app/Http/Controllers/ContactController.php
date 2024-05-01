<?php

namespace App\Http\Controllers;

use App\Actions\GetContactsAction;
use App\Actions\StoreContactAction;
use App\Actions\UpdateContactAction;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetContactsAction $getContactsAction)
    {
        $contacts = $getContactsAction->execute();
        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function fetchContacts(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('perPage', 10);

        $contacts = Contact::where('user_id', auth()->user()->id);
        if ($query) {
            $contacts->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'like', "%$query%")
                        ->orWhere('company', 'like', "%$query%")
                        ->orWhere('phone', 'like', "%$query%")
                        ->orWhere('email', 'like', "%$query%");
                });
        }


        return response()->json($contacts->paginate($perPage));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request, StoreContactAction $storeContactAction)
    {
        $response = $storeContactAction->execute($request->all());
        return redirect()->route('contact.index')->with('success', 'Contact '.$response->name.' created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', ['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact, UpdateContactAction $updateContactAction)
    {
        $updateContactAction->execute($contact, $request->all());
        return redirect()->route('contact.index')->with('success', 'Contact '.$contact->name.' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): JsonResponse
    {
        $response = $contact->delete();
        return response()->json(['status' => $response, 'message' => 'Contact was successfully deleted!']);
    }
}
