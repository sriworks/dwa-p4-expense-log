@if($errors->get($fieldName))
<div class="alert alert-danger" role="alert">
    <ul class='error'>
        @foreach($errors->get($fieldName) as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif