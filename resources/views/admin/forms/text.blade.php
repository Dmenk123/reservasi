@if (isset($type) && $type == 'hidden')
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" class="form-control" value="{{ $value ?? '' }}" @if(isset($disabled) && $disabled=='true') disabled @endif placeholder="{{ $hint ?? '' }}" {{ $required ?? '' }} {{ $disabled ?? '' }} @if( isset($readonly) && $readonly=='true') readonly @endif>
@else
    <div class="mb-1 row" name="{{ 'div_'.$name }}" id="{{ 'div_'.$name }}">
        <div class="col-sm-{{ $label_width ?? 2 }}">
            <label class="col-form-label">{{ $label }} {{ $required ? '*' : '' }}</label>
        </div>
        <div class="col-sm-{{$input_width ?? 5}}">
            <input type="{{$type}}" id="{{$name}}" name="{{$name}}" class="form-control" value="{{ $value ?? '' }}" @if(isset($disabled) && $disabled=='true') disabled @endif placeholder="{{ $hint ?? '' }}" {{ $required ?? '' }} {{ $disabled ?? '' }} @if( isset($readonly) && $readonly=='true') readonly @endif>
        </div>
    </div>
@endif

