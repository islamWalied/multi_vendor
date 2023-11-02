<div class="mb-6 col-md-6">
    <?php $i=0?>
    @foreach($options as $value => $text)

        <div class="form-check">
            <input
                    class=" focus:outline-none
                    @error($name) is-invalid @enderror"
                    type="radio"
                    name="{{$name}}"
                    id="category{{$i}}"
                    value="{{$value}}"
                    @checked(old($name,$checked == $value))>

            <label class="" for="category{{$i}}">{{$text}}</label>
        </div>
            <?php $i++?>
    @endforeach

    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
