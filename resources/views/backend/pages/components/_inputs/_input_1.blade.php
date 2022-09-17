@if ($input['field']=='select')
@php
    $viewindex =$input['view_index'];
@endphp
<div class="form-group">
    <label for="basicInput">{{ str_replace( '_',' ', strtoupper($input['name'])) }}</label>
    <select name="{{ $input['name'] }}" {{ isset($input['required']) ? "required" : "" }} class="form-control simple-selector {{  isset($input['update']) ? $input['name'] : '' }}" id="{{ isset($input['update']) ? '' : $input['name'] }}">
        @foreach (getData($input['modelData']) as $item)
        <option value="{{ $item->id }}"   >{{ $item->$viewindex }}</option>
        @endforeach
    </select>
</div>
@endif
@if ($input['field']=='input')

<div class="form-group">
    @if ($input['name']!='id')
    <label for="basicInput">{{ str_replace( '_',' ', strtoupper($input['name'])) }}</label>
    @endif
    <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" {{ isset($input['required']) ? "required" : "" }} {{ isset($input['min']) ? "min=".$input['min'] : "" }}   {{ isset($input['max']) ? "max=".$input['max'] : "" }} class="form-control {{  isset($input['update']) ? $input['name'] : '' }}" id="{{ isset($input['update']) ? '' : $input['name'] }}"  placeholder="{{ isset($input['update']) ? '' : $input['placeholder'] }}">
</div>
@endif


