@foreach($messages as $message)
    <div class="message-item {{ $message->is_read ? 'read' : 'unread' }}">
        <strong>{{ $message->name }}</strong>
        <p>{{ Str::limit($message->message, 50) }}</p>
        <small>{{ $message->created_at->diffForHumans() }}</small>
    </div>
@endforeach
