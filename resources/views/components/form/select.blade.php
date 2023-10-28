<div class="form-group">
    <label for="{{$title}}">{{$title}}</label>
    <select name="{{$name}}" class="form-control" id="{{$title}}">
        <option value="" selected>Primary</option>
        @foreach($value as $parent)
            <option value="{{$parent->id}}">{{$parent->name}}</option>
        @endforeach
    </select>
</div>
