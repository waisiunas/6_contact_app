<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
            'mobile' => ['required'],
            'email' => ['required'],
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
            'categories' => Category::all(),
            'contact' => $contact,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'category_id' => ['required'],
            'mobile' => ['required'],
            'email' => ['required'],
        ]);

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
        ];

        if ($contact->update($data)) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    public function picture(Request $request, Contact $contact)
    {
        $request->validate([
            'picture' => ['required', 'image', 'mimes:png,jpg,jpeg,webp'],
        ]);

        $old_picture_path = 'template/img/contacts/' . $contact->picture;
        $name = microtime(true) . $request->picture->hashName();

        $request->picture->move(public_path('template/img/contacts/'), $name);

        if ($contact->picture && File::exists(public_path($old_picture_path))) {
            unlink(public_path($old_picture_path));
        }

        $data = [
            'picture' => $name,
        ];

        if ($contact->update($data)) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if ($contact->delete()) {
            return redirect()->route('contacts')->with(['success' => 'Magic has been spelled!']);
        } else {
            return redirect()->route('contacts')->with(['failure' => 'Magic has failed to spell!']);
        }
    }
}
