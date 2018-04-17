<div class="progress progress-striped active" style="height: 20px;">
    <div class="progress-bar progress-bar-{{ isset( $class ) ? $class : 'danger' }}" role="progressbar"
         aria-valuenow="{{ isset( $now ) ? $now : 0 }}"
         aria-valuemin="0"
         aria-valuemax="{{ isset( $max ) ? $max : 100 }}"
         style="width: {{ isset( $percent ) ? "$percent%" : '0%' }}">
        {{ __('financial.help-text.percent', ['percent' => isset( $percent ) ? "$percent%" : '0%' ]) }}
    </div>
</div>