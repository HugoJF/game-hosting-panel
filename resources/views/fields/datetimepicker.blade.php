<div class="form-group">
    <label for="{{ $name }}" class="control-label required">{{ $options['label'] }}</label>

    <div class="input-group date" id="datetimepicker-{{ $name }}" data-target-input="nearest" data-tempusdominus="yes">
        <input type="text" value="{{ $options['value'] }}" name="{{ $name }}" class="form-control datetimepicker-input" data-target="#datetimepicker-{{ $name }}"/>

        <div class="input-group-append" data-target="#datetimepicker-{{ $name }}" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>

    @if ($options['help_block']['text'] && !$options['is_child'])
        <{{ $options['help_block']['tag'] }} {!! $options['help_block']['helpBlockAttrs']  !!}>
        {{ $options['help_block']['text'] }}
</{{ $options['help_block']['tag'] }} >
@endif
</div>
