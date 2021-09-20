<div class="settings-tray">
    <div class="friend-drawer no-gutters friend-drawer--grey">
    <img class="profile-image" src="{{ $user->photo_src }}" alt="">
    <div class="text">
      <h3>{{ $user->firstname }} {{ $user->lastname }}</h3>
      <h6 class="text-muted">Wolontariusz</h6>
    </div>
  </div>
</div>
<div class="chat-panel">
<div class="messagediv d-none" style="max-height: 600px; min-height: 600px; overflow-y: auto; overflow-x: hidden;">
    @foreach ($messages as $message)
        @if ($message->sender == Auth::id())
        <div class="row no-gutters">
            <div class="col-md-3 offset-md-9">
            <div class="chat-bubble chat-bubble--right">
                {{ $message->content }}
            </div>

            <h6 class="text-small text-right mr-2">
                @if ($message->condition == 0)
                {{ "wysłano:" }} {{ date('H:i', strtotime($message->created_at)) }}
            @else
                {{ "przeczytano:" }} {{ date('H:i', strtotime($message->updated_at)) }}
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
    @endforeach

</div>

  <div class="row">
    <div class="col-12">
      <div class="chat-box-tray">
            <input type="text" class="w-100" id="messageinput" placeholder="Type your message here...">
            <div class="sendbtn" style="cursor: pointer" id="{{ $message->receiver }}"><i class="far fa-paper-plane"></i></div>
            <script>
                $('.sendbtn').click(function () {
                    receiver_id = $(this).attr('id');
                    content = $("#messageinput").val();
                    $.ajax({
                        type:'POST',
                        url: "/coordinator/chat/sendmessage",
                        data: {
                            'content': content,
                            'receiver_id': receiver_id,
                        },
                        success:function(data) {
                            //$('#messagebox').html(data);
                            $('#messageinput').val('');
                            scrollToBottomFunc();
                            
                        }
                    });
                });
            </script>
      </div>
    </div>
  </div>
</div>
