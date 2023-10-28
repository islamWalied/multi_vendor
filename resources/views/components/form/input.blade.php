<div class="form-group">
    @if($status == "input")
        <label for="{{$name}}">{{$title}}</label>
        <input type="{{$type}}" name="{{$name}}" id="{{$name}}" class="form-control @error($name) is-invalid @enderror"
               placeholder="{{$title}}" value="{{old($name,$value)}}">

    @elseif($status == "textarea")
        <label for="{{$name}}">{{$title}}</label>
        <textarea name="{{$name}}" id="{{$name}}" class="form-control" placeholder="{{$title}}">{{old($name,$value)}}</textarea>

    @elseif($status == "image")
        <label for="{{$name}}">{{$title}}</label>
        <input type="{{$type}}" name="{{$name}}" id="{{$name}}" class="form-control">
        @if($value)
            <div class="form-group">
                <a href="{{asset('storage/' . $value)}}">
                    <img src="{{asset('storage/' . $value)}}" height="80px" />
                </a>
            </div>
        @endif

    @elseif($status == "status")
        <?php $i=0?>
        @foreach($options as $value => $text)

        <div class="form-check">
            <input class="form-check-input @error($name) is-invalid @enderror" type="{{$type}}" name="{{$name}}" id="flexRadioDefault{{$i}}"
                   value="{{$value}}" @checked(old($name,$checked == $value))>
            <label class="form-check-label" for="flexRadioDefault{{$i}}">
                {{$text}}
            </label>
            @error($name)
            <div class="invalid-feedback">
                {{$message}}
            </div>

            @enderror
        </div>
         <?php $i++?>
        @endforeach

    @elseif($status == "select")
            <label for="{{$name}}">{{$title}}</label>
            <select name="{{$name}}" class="form-control" id="{{$name}}">
                <option value="" selected>Primary</option>
                @foreach($value as $parent)
                    <option value="{{$parent->id}}" @selected($category->parent_id == $parent->id)> {{$parent->name ?? ""}}</option>
                @endforeach
            </select>
    @endif

    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
