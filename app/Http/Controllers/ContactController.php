<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filteringOptions = $request->all();
        $query = Contact::query();

        if (isset($filteringOptions['name'])) {
            $query->orderBy('name', $filteringOptions['name']);
        }
        if (isset($filteringOptions['date']) && in_array($filteringOptions['date'], ['asc', 'desc'])) {
            $query->orderBy('created_at', $filteringOptions['date']);
        }
        if (isset($filteringOptions['search'])) {
            $search = $filteringOptions['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $contacts = $query->get();

        return view('index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $validatedRequest = $request->validated();
        Contact::create($validatedRequest);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            return view('components.show', compact('contact'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            return view('components.edit', compact('contact'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
        $contact = Contact::find($id);
        $contact->update($validatedRequest);
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Contact::destroy($id)) {
            return abort(404);
        }
        return redirect()->back();
    }
}
