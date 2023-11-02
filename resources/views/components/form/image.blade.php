<div class="mb-6 col-md-6">
    <label class="block mb-2 text-sm font-medium text-gray-900" for="{{$label}}">{{$title}}</label>
    <input
           id="{{$label}}"
           name="{{$name}}"
           type="{{$type}}"
            {{$attributes->class([
                                'block',
                                'p-2.5',
                                'w-full',
                                'text-sm',
                                'text-gray-900',
                                'bg-gray-50',
                                'rounded-lg',
                                'border ',
                                'border-gray-300',
                                'focus:ring-blue-500',
                                'focus:outline-none',
                                'dark:text-gray-400',
                                'cursor-pointer',
                                'is-invalid' => $errors->has($name)
                            ])}}>

    @if($value)
        @if($value[0][0] =='h')
            <a href="{{asset(/*'storage/' . */$value)}}">
                <img src="{{asset(/*'storage/' . */$value)}}" height="60px" width="60px" />
            </a>
        @else
            <a href="{{asset('storage/' . $value)}}">
                <img src="{{asset('storage/' . $value)}}" height="60px" width="60px" />
            </a>
        @endif
    @endif
    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
