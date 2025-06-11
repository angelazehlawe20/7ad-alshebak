<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc');
        return view('admin.contacts.index', compact('contacts'));
    }

    public function filterByIsRead(Request $request)
{
    $status = $request->input('status');

    $contacts = Contact::query();

    if ($status === 'read') {
        $contacts->where('is_read', true);
    } elseif ($status === 'unread') {
        $contacts->where('is_read', false);
    }

    $contacts = $contacts->orderBy('created_at', 'desc')->paginate(10); // يمكنك استخدام ->get() بدلاً من ->paginate()

    return view('admin.contacts.index', compact('contacts'));
}



    public function show(Contact $contact)
    {
        // Mark the contact as read when viewed
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        // Get related contacts (optional) - can be used to show similar messages
        $relatedContacts = Contact::where('id', '!=', $contact->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.contacts.show', [
            'contact' => $contact,
            'relatedContacts' => $relatedContacts
        ]);
    }

    public function markAsRead(Request $request)
    {
        $id = $request->input('contact_id');
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
