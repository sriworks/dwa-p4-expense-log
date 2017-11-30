<?php $message = Session::get('message'); ?>
@if($message)
    <div class="{{'alert alert-' . $message['severity']}}" role="alert">
        <p>{{$message['message_text']}}</p>
    </div>
@endif