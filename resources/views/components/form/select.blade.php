<div class="mb-6 col-md-6">


<label for="category" class="block mb-2 text-sm font-medium text-gray-900">Select an option</label>

<select name="{{$name}}"

    {{$attributes->class([
                        'block',
                        'p-2.5',
                        'w-full',
                        'text-sm',
                        'bg-gray-50',
                        'rounded-lg',
                        'border ',
                        'border-gray-300',
                        'focus:ring-blue-500',
                        'focus:outline-none',
                        'is-invalid' => $errors->has($name)
                    ])}}
>
    @foreach($options as $value)
        <option value="{{$value->id}}" @selected($column == $value->id)>{{$value->name ?? ""}} </option>
    @endforeach

</select>
    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
