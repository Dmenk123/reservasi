<div class="mb-1 row" name="{{ 'div_'.$name }}" id="{{ 'div_'.$name }}">
    <div class="col-sm-{{ $label_width ?? 4 }}">
        <label class="col-form-label">{{ $label }} {{ $required ? '*' : '' }}</label>
    </div>
    <div class="col-sm-{{$input_width ?? 8}}">
        <select class="select2 form-select" id="{{$name}}" name="{{$name}}" {{ $required ?? '' }} @if(isset($multiple)) multiple="multiple" @endif>
            <option value="">Please Choose One</option>
            @if (isset($collection))
                @foreach($collection as $opt)
                    <option @if($opt->$option_value == $value){{'selected'}}@endif value="@if(isset($opt->$option_value)){{ $opt->$option_value }}@else{{ $opt->$option_text }}@endif">{{ trim($opt->$option_text) }}</option>
                @endforeach
            @endif
        </select>

        @error($name)
            <label id="{{ $name ?? '' }}-error" class="error mt-2 text-danger" for="{{ $name ?? '' }}">{{$message}}.</label>
        @enderror
    </div>
</div>


