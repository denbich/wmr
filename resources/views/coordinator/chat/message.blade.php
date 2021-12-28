<div class="row no-gutters">
    <div class="col-md-4 offset-md-8">
    <div class="chat-bubble chat-bubble--right">
        {{ $message->content }}
    </div>

    <h6 class="text-small text-right mr-2">
        @if ($message->condition == 0)
        {{ "wysłano:" }} {{ date('d.m.Y H:i', strtotime($message->created_at)) }}
    @else
        {{ "przeczytano:" }} {{ date('d.m.Y H:i', strtotime($message->updated_at)) }}
    @endif
     </h6>
</div>
</div>
