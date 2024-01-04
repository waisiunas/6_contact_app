<?php

namespace App\Http\Controllers\deleted;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Auth::user()->contacts()->onlyTrashed()->get();

        return view('deleted.index', [
            'contacts' => $contacts,
        ]);
    }

    public function restore(string $id) {
        $contact = Contact::withTrashed()->find($id);
        if ($contact->restore()) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    public function delete(string $id) {
        $contact = Contact::withTrashed()->find($id);

        $path = 'template/img/photos/' . $contact->picture;

        if ($contact->forceDelete()) {
            if ($contact->picture && File::exists(public_path($path))) {
                unlink(public_path($path));
            }
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }
}
