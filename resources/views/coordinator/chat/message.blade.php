@if ($message->sender == Auth::id())
        <div class="row no-gutters">
            <div class="col-md-3 offset-md-9">
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
        @else
        <div class="row no-gutters">
            <div class="col-md-3">
              <div class="chat-bubble chat-bubble--left">
                {{ $message->content }}
              </div>
            </div>
          </div>
        @endif
