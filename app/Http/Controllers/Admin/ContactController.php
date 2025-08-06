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

        $contactsQuery = Contact::query()
            ->select(['id', 'name', 'email', 'subject', 'message', 'is_read', 'created_at']);

        if ($filter === 'read') {
            $contactsQuery->where('is_read', true);
        } elseif ($filter === 'unread') {
            $contactsQuery->where('is_read', false);
        }

        $contacts = $contactsQuery->orderBy('created_at', 'desc')->get();

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * جلب القائمة كاملة بشكل AJAX (بدون إعادة تحميل الصفحة)
     */
    public function refreshList()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.message_list', compact('contacts'));
    }

    /**
     * جلب الرسائل غير المقروءة وغير المُبلغ عنها (للإشعارات)
     */
    public function unreadMessages()
    {
        $messages = Contact::where('is_read', false)
            ->where('is_notified', false)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'name' => $message->name,
                    'message' => \Illuminate\Support\Str::limit(strip_tags($message->message), 40),
                    'created_at_diff' => $message->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'messages' => $messages
        ]);
    }

    /**
     * تعليم الرسائل غير المُبلغ عنها بأنها أُبلغت
     */
    public function markAsNotified()
    {
        Contact::where('is_read', false)
            ->where('is_notified', false)
            ->update(['is_notified' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * عرض الرسالة الواحدة + تعليمها كمقروءة
     */
    public function show(Contact $contact)
    {
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        $relatedContacts = Contact::where('id', '!=', $contact->id)
            ->select(['id', 'name', 'email', 'subject', 'message', 'is_read', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.contacts.show', [
            'contact' => $contact,
            'relatedContacts' => $relatedContacts
        ]);
    }

    /**
     * تعليم رسالة كمقروءة
     */
    public function markAsRead(Request $request)
    {
        $id = $request->input('contact_id');
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);

        return redirect()->back()->with('success', __('contact.message_as_read'));
    }

    /**
     * حذف الرسالة
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', __('contact.message_deleted'));
    }
}
