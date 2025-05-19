<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactAddress;
use App\Models\ContactContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Display a listing of the contacts.
     */
    public function index(): View
    {
        $contacts = Contact::where('userid', Auth::id())
            ->orderBy('name')
            ->paginate(10);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact.
     */
    public function create(): View
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'document' => 'nullable|string|max:20',
            'type' => 'required|integer|in:0,1',
            'active' => 'required|boolean',
        ]);

        $validated['userid'] = Auth::id();

        $contact = Contact::create($validated);

        return redirect()->route('contacts.show', $contact)
            ->with('status', 'contact-created');
    }

    /**
     * Display the specified contact.
     */
    public function show(Contact $contact): View
    {
//        $this->authorize('view', $contact);

        $contact->load('addresses', 'contactMethods');

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit(Contact $contact): View
    {
//        $this->authorize('update', $contact);

        $contact->load('addresses', 'contactMethods');

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
//        $this->authorize('update', $contact);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'document' => 'nullable|string|max:20',
            'type' => 'required|integer|in:0,1',
            'active' => 'required|boolean',
        ]);

        $contact->update($validated);

        return redirect()->route('contacts.show', $contact)
            ->with('status', 'contact-updated');
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
//        $this->authorize('delete', $contact);

        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('status', 'contact-deleted');
    }

    /**
     * Store a new address for the contact.
     */
    public function storeAddress(Request $request, Contact $contact): RedirectResponse
    {
//        $this->authorize('update', $contact);

        $validated = $request->validate([
            'descricao' => 'required|string|max:50',
            'cep' => 'required|string|max:10',
            'endereco' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'uf' => 'required|string|size:2',
            'numero' => 'nullable|string|max:10',
            'referencia' => 'nullable|string|max:100',
            'complemento' => 'nullable|string|max:100',
        ]);

        $validated['contactid'] = $contact->id;

        $contact->addresses()->create($validated);

        return redirect()->route('contacts.edit', $contact)
            ->with('status', 'address-created');
    }

    /**
     * Update the specified address.
     */
    public function updateAddress(Request $request, ContactAddress $address): RedirectResponse
    {
//        $this->authorize('update', $address->contact);

        $validated = $request->validate([
            'descricao' => 'required|string|max:50',
            'cep' => 'required|string|max:10',
            'endereco' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'uf' => 'required|string|size:2',
            'numero' => 'nullable|string|max:10',
            'referencia' => 'nullable|string|max:100',
            'complemento' => 'nullable|string|max:100',
        ]);

        $address->update($validated);

        return redirect()->route('contacts.edit', $address->contact)
            ->with('status', 'address-updated');
    }

    /**
     * Remove the specified address.
     */
    public function destroyAddress(ContactAddress $address): RedirectResponse
    {
        $contact = $address->contact;
//        $this->authorize('update', $contact);

        $address->delete();

        return redirect()->route('contacts.edit', $contact)
            ->with('status', 'address-deleted');
    }

    /**
     * Store a new contact method for the contact.
     */
    public function storeContactMethod(Request $request, Contact $contact): RedirectResponse
    {
//        $this->authorize('update', $contact);

        $validated = $request->validate([
            'descricao' => 'required|string|max:100',
            'tipo' => 'required|integer|in:0,1,2',
            'valor' => 'required|string|max:255',
        ]);

        $validated['contactid'] = $contact->id;

        $contact->contactMethods()->create($validated);

        return redirect()->route('contacts.edit', $contact)
            ->with('status', 'contact-method-created');
    }

    /**
     * Update the specified contact method.
     */
    public function updateContactMethod(Request $request, ContactContact $contactMethod): RedirectResponse
    {
//        $this->authorize('update', $contactMethod->contact);

        $validated = $request->validate([
            'descricao' => 'required|string|max:100',
            'tipo' => 'required|integer|in:0,1,2',
            'valor' => 'required|string|max:255',
        ]);

        $contactMethod->update($validated);

        return redirect()->route('contacts.edit', $contactMethod->contact)
            ->with('status', 'contact-method-updated');
    }

    /**
     * Remove the specified contact method.
     */
    public function destroyContactMethod(ContactContact $contactMethod): RedirectResponse
    {
        $contact = $contactMethod->contact;
        $this->authorize('update', $contact);

        $contactMethod->delete();

        return redirect()->route('contacts.edit', $contact)
            ->with('status', 'contact-method-deleted');
    }
}
