<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $contacts = Auth::user()->categories->pluck('contacts')->flatten();
        $contacts = Auth::user()->contacts;

        return view('contact.index', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create', [
            'categories' => Category::where('user_id', '=', Auth::id())->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'category_id' => ['required'],
            'mobile' => ['required', 'unique:contacts,mobile_number'],
            'email' => ['required', 'email', 'unique:contacts,email'],
            'picture' => ['image', 'mimes:png,jpg,jpeg,webp'],
        ]);

        if ($request->picture) {
            $name = microtime(true) . $request->picture->hashName();
            $request->picture->move(public_path('template/img/contacts/'), $name);
        } else {
            $name = null;
        }

        $data = [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'category_id' => $request->category_id,
            'mobile_number' => $request->mobile,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'dob' => $request->dob,
            'address' => $request->address,
            'picture' => $name,
        ];

        if (Contact::create($data)) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contact.show', [
            'contact' => $contact,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
