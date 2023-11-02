<div class="form-row">
    <x-form.input label="name"
                  name="name"
                  title="Product Name"
                  type="text"
                  :value="$products->name"/>

    <x-form.select name="category_id"
                   title="Category"
                   label="category_id"
                   :column="$products->category_id"
                   :options="\App\Models\Category::all()"/>
</div>

<div class="form-row">
    <x-form.textarea name="description"
                     title="Product Description"
                     label="textarea"
                     :value="$products->description"/>

    <x-form.image name="image"
                  title="Product Image"
                  label="image"
                  type="file"
                  :value="$products->image"/>
</div>

<div class="form-row">
    <x-form.input name="price"
                  title="Product Price"
                  label="price"
                  type="text"
                  :value="$products->price"/>

    <x-form.input name="compare_price"
                  title="Compare Price"
                  label="compare_price"
                  type="text"
                  :value="$products->compare_price"/>
</div>

<div class="form-row">
    <x-form.input name="tags"
                  title="Product Tags"
                  label="tags"
                  type="text"
                  :value="$tags"/>
</div>

<div class="form-row">
    <x-form.radio name="status"
                  :checked="$products->status"
                  :options="['archived' => 'Archived','draft' => 'Draft','active' => 'Active']"/>
</div>

@push('styles')
<link href="{{asset('dist/css/tagify.css')}}" rel="stylesheet" type="text/css" />

@endpush

@push('scripts')
    <script src="{{asset('dist/js/tagify.js')}}"></script>
    <script src="{{asset('dist/js/tagify.polyfills.min.js')}}"></script>
    <script>
        var inputElm = document.querySelector('[name=tags]'),
            tagify = new Tagify (inputElm);
    </script>
@endpush
