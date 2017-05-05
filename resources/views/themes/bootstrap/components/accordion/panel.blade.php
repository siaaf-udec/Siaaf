<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#{{ $id }}" href="#{{ $link }}"> {{ $title }} </a>
        </h4>
    </div>
    <div id="{{ $link }}" class="panel-collapse collapse">
        <div class="panel-body">
            {{ $body }}
        </div>
    </div>
</div>