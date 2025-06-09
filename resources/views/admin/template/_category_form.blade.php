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
            <label for="title">Enter category name</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter category name"
                required>

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="slug">Enter slug</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug">
        </div>
    </div>
</div>
