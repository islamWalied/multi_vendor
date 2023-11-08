@props([
    'value' => '','type','name','label','title'
    ])

<div class="mb-6 col-md-6">
    <label class="block mb-2 text-sm font-medium text-gray-900" for="{{$label}}">{{$title ?? ""}}</label>
    <input
           id="{{$label}}"
           type="{{$type}}"
           name="{{$name}}"
           value="{{old($name,$value ?? '')}}"
           placeholder="{{$title}}"
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
                            ])}}>
    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
