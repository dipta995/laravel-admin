
<div class="form-group">
    <label for="basicInput">{{ $input['name'] }}</label>
    <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" {{ $input['required'] ? "required" : "" }} {!! $input['min'] ? "min=".$input['min'] : "" !!}   {{ $input['max'] ? "max=".$input['max'] : "" }} class="form-control" id="{{ $input['id'] }}" placeholder="{{ $input['update'] ? $update_data->$input['name'] :$input['placeholder'] }}">
</div>

