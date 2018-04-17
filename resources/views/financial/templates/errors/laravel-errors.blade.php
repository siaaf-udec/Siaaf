<div class="alert alert-block alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert"></button>
    <h4 class="alert-heading"> <i class="fa fa-warning"></i> @lang('javascript.error')</h4>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>