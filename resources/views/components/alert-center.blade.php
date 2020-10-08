
@if (session()->has('status'))
<div class="alert alert-{{ $type }}" role="alert">
    {{ session()->get('status') }}
</div>
@endif