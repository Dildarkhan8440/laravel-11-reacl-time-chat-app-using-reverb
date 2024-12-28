@vite('resources/js/app.js')
<x-app-layout>
    <x-slot name="header" >
      <div class="row">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <a href="/dashboard">Dashboard</a>
      {{-- </h2>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Chat') }}
          </h2> --}}
      </div>
      
    </x-slot>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<link href="{{ asset('chat.css') }}" rel="stylesheet">


<div class="chat_window">
    <div class="top_menu">
        <div class="buttons">
            <div class="button close">
            </div>
            <div class="button minimize"></div>
            <div class="button maximize"></div>
        </div>
        <div class="title">{{$user_to->name}}</div>
    </div>
    <ul class="messages" id='message_append'>
        @foreach ($messages as $msg )
            @if($msg->message_from==Auth()->user()->id)
            <li class="message right appeared float-right"><div class="avatar text-center"><b>You</b></div>
              <div class="text_wrapper">
                  <div class="text">{{$msg->message}}</div>
              </div>
          </li>
            @else
            <li class="message left appeared float-left"><div class="avatar text-center"></div>
              <div class="text_wrapper">
                  <div class="text">{{$msg->message}}</div>
              </div>
          </li>
            @endif
        @endforeach
   </ul>
    <div class="bottom_wrapper clearfix">
        <div class="message_input_wrapper">
            <input class="message_input" id='msg' placeholder="Type your message here..." />
        </div>
        <div class="send_message" onClick="sendMsg()">
            <div class="icon"></div>
            <p class="text">Send</p>
        </div>
    </div>
</div>
<div class="message_template">
    <li class="message"><div class="avatar"></div>
        <div class="text_wrapper">
            <div class="text"></div>
        </div>
    </li>
</div>
</x-app-layout>

<script>
  $("#message_append").animate({scrollTop: $('#message_append').get(0).scrollHeight}, 2000);
    function sendMsg() {
        var msg = document.getElementById('msg').value 
        var csrf="{{@csrf_token()}}";
      
        $.ajax({
            url:"{{route('send')}}",
            type : "POST",
            data:{
                sender:{!! json_encode(auth()->user()->id) !!},
                send_to:{!! json_encode($user_to->id) !!},
                channel:{!! json_encode($channel) !!},
                message:msg,
                _token:csrf
            },
            success:function (res) {
                $('#message_append').append(`
                <li class="message right appeared float-right"><div class="avatar text-center " ><b>You</b></div>
                    <div class="text_wrapper">
                        <div class="text">${res.message}</div>
                    </div>
                </li>
                `);
            },
            error:function (res) {
                
            }
        });
        $("#message_append").animate({scrollTop: $('#message_append').get(0).scrollHeight}, 2000);
    }

    window.onload=()=>{
       var user_id={!! json_encode(auth()->user()->id) !!};
        window.Echo.private(`private-channel.${user_id}`).listen('MessageSent',function (data) {
            
            if(data.sender!={{auth()->user()->id}}){
                $('#message_append').append(`
                <li class="message left appeared float-left"><div class="avatar text-center"></div>
                    <div class="text_wrapper">
                        <div class="text">${data.message}</div>
                    </div>
                </li>
                `)
            }
            
            $("#message_append").animate({scrollTop: $('#message_append').get(0).scrollHeight}, 2000);
        });
    }
</script>