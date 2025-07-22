@foreach($contacts as $contact)
<div class="contact-item {{ $contact->is_read ? 'read' : 'unread' }}">
    <h5>{{ $contact->name }}</h5>
    <p>{{ Str::limit($contact->message, 100) }}</p>
</div>
@endforeach
