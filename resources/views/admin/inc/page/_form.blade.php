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
            <label for="title">Enter Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter title"
                required="required" value="{{ old('title') }}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="slug">Enter Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug"
                value="{{ old('slug') }}">
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label for="description">Enter description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter short description" rows="4"
                cols="3">{{ old('description') }}</textarea>
        </div>
    </div>
</div>
