
<x-form.input name="name"
              title="Category Name"
              type="text"
              status="input"
              :value="$category->name"/>

<x-form.input name="parent_id"
              title="Category Parent"
              :value="$parents"
              status="select"
              :category="$category"/>

<x-form.input name="description"
              title="Category Description"
              status="textarea"
              :value="$category->description"/>

<x-form.input   name="image"
                type="file"
                title="Category Image"
                status="image"
                :value="$category->image"/>

 <x-form.input   name="status"
                 title="Category Status"
                 type="radio"
                 :checked="$category->status"
                 status="status"
                 :options="['active' => 'Active','archived' => 'Archived']"/>
