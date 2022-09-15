
<div class="form-group">
    <label for="basicInput">{{ $input['name'] }}</label>
    <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" {{ isset($input['required']) ? "required" : "" }} {{ isset($input['min']) ? "min=".$input['min'] : "" }}   {{ isset($input['max']) ? "max=".$input['max'] : "" }} class="form-control" id="{{ $input['name'] }}"  placeholder="{{ isset($input['update']) ? '' : $input['placeholder'] }}">
</div>

