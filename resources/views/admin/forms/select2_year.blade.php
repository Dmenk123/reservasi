<div class="mb-1 row" name="{{ 'div_'.$name }}" id="{{ 'div_'.$name }}">
    <div class="col-sm-{{ $label_width ?? 4 }}">
        <label class="col-form-label">{{ $label }} {{ $required ? '*' : '' }}</label>
    </div>
    <div class="col-sm-{{$input_width ?? 8}}">
        <select class="select2 form-select" id="{{$name}}" name="{{$name}}" {{ $required ?? '' }}>
            <option value="">Please choose one</option>
            @php
                if(isset($range_year) && $range_year) {
                    $collection = (function() use ($range_year){
                        for ($i=(int)\Carbon\Carbon::now()->format('Y') - (int)$range_year; $i <= \Carbon\Carbon::now()->addYears((int)$range_year)->format('Y'); $i++) {
                            $a[] = [
                                'option_value' => $i,
                                'option_text' => $i
                            ];
                        }
                        return $a;
                    }) ();
                }else{
                    $collection = (function(){
                        for ($i=(int)\Carbon\Carbon::now()->format('Y') - 1; $i <= \Carbon\Carbon::now()->format('Y'); $i++) {
                            $a[] = [
                                'option_value' => $i,
                                'option_text' => $i
                            ];
                        }
                        return $a;
                    }) ();
                }

            @endphp
            @foreach($collection as $item)
                    <option value="{{ $item['option_value'] }}" @if (isset($value) and $item['option_value'] == $value){{ 'selected' }}@endif>
                    {{ $item['option_text'] }}
                </option>
            @endforeach
        </select>

        @error($name)
            <label id="{{ $name ?? '' }}-error" class="error mt-2 text-danger" for="{{ $name ?? '' }}">{{$message}}.</label>
        @enderror
    </div>
</div>


