<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // تطبيق الفلاتر
        if ($request->status == 'read') {
            $query->where('is_read', true);
        } elseif ($request->status == 'unread') {
            $query->where('is_read', false);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contacts.index', compact('contacts'));
    }


    public function show(Contact $contact)
    {
        // نضع الرسالة كمقروءة تلقائيًا إذا لم تكن كذلك
        if (! $contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function markAsRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Message deleted.');
    }
}
