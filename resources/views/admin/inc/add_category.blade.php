<form action="{{ url('restaurent-control/category/add') }}" method="POST" enctype="multipart/form-data" class="user">
    @csrf

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $message }}
        </div>
    @endif
    @if (count($errors->all()))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="category_name">Enter category name</label>
                <input type="text" name="category_name" class="form-control" placeholder="Enter category name"
                    id="category_name" value="{{ old('category_name') }}">
            </div>
            <div class="form-group">
                <label for="category_description">Enter category description</label>
                <textarea name="category_description" class="form-control" placeholder="Enter category description"
                    id="category_description">{{ old('category_description') }}</textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="root_category">Select Parent category</label>
                <select name="root_category" class="form-control" id="root_category">
                    @foreach ($parentArr as $key => $value)
                        <option value="{{ $key }}" {{ old('root_category', '0') == $key ? 'selected' : '' }}>
                            {{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_slug">Enter slug</label>
                <input type="text" name="category_slug" class="form-control" placeholder="Enter slug"
                    id="category_slug" value="{{ old('category_slug') }}">
            </div>
            <div class="form-group">
                <label for="category_image">Choose image</label>
                <input type="file" name="category_image" class="form-control" id="category_image">
            </div>
        </div>
    </div>
    <div class="text-right">
        <input type="submit" class="btn btn-primary" name="login" value="Add Category" />
    </div>
</form>
