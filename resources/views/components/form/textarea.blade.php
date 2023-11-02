<div class="mb-6 col-md-6">
    <label for="{{$label}}" class="block mb-2 text-sm font-medium text-gray-900">{{$title}}</label>
    <textarea
        id="{{$label}}"
        name="{{$name}}"
        rows="3"
        placeholder="{{$title}}"
        {{$attributes->class([
                                    'block',
                                    'p-2.5',
                                    'w-full',
                                    'text-sm',
                                    'text-gray-900',
                                    'bg-gray-50',
                                    'rounded-lg',
                                    'border-gray-300',
                                    'focus:ring-blue-500',
                                    'focus:border-blue-500',
                                    'is-invalid' => $errors->has($name)
                                ])}}
    >{{old($name,$value)}}
    </textarea>
    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
