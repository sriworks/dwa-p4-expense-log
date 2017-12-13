<?php $message = Session::get('message'); ?>
@if($message)
    <div class="{{'alert alert-' . $message['severity']}}" role="alert">
        {{$message['message_text']}}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        Please fix the errors below!
    </div>
@endif