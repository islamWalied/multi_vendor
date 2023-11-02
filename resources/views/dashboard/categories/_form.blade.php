 <x-form.input name="name"
                  title="Category Name"
                  label="name"
                  type="text"
                  :value="$category->name"/>

<x-form.select name="category_id"
               title="Category"
               label="category_id"
               :column="$category->parent_id"
               :options="$parents"/>

<x-form.textarea name="description"
                 title="Category Description"
                 label="textarea"
                 :value="$category->description"/>

<x-form.image name="image"
              title="Product Image"
              label="image"
              type="file"
              :value="$category->image"/>

<x-form.radio name="status"
              :checked="$category->status"
              :options="['active' => 'Active','archived' => 'Archived']"/>

