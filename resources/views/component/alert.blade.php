@if (session()->has('flash.type') && session()->get('flash.type') == 'success')
<div class="alert alert-success" role="alert">
    <div class="container">
        {{ session()->get('flash.message') }}
    </div>
</div>
@elseif (session()->has('flash.type') && session()->get('flash.type') == 'danger')
<div class="alert alert-danger" role="alert">
    <div class="container">
        {{ session()->get('flash.message') }}
    </div>
</div>
@endif
