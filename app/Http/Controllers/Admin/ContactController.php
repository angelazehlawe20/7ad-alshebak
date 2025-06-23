<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $locale = app()->getLocale();

        $contactsQuery = Contact::query()
            ->select([
                'id',
                'name_' . $locale . ' as name',
                'email',
                'subject_' . $locale . ' as subject',
                'message_' . $locale . ' as message',
                'is_read',
                'sent_at',
                'created_at'
            ]);

        if ($filter === 'read') {
            $contactsQuery->where('is_read', true);
        } elseif ($filter === 'unread') {
            $contactsQuery->where('is_read', false);
        }

        $contacts = $contactsQuery->orderBy('created_at', 'desc')->get();

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $locale = app()->getLocale();
        
        // Mark the contact as read when viewed
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        // Get related contacts (optional) - can be used to show similar messages
        $relatedContacts = Contact::where('id', '!=', $contact->id)
            ->select([
                'id',
                'name_' . $locale . ' as name',
                'email',
                'subject_' . $locale . ' as subject',
                'message_' . $locale . ' as message',
                'is_read',
                'sent_at',
                'created_at'
            ])
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
