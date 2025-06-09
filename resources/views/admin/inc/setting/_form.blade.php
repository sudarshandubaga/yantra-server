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
    <div class="col-lg-12">
        <div class="form-group">
            <label for="return_point">Return Point</label>
            <input type="text" name="return_point" id="return_point" class="form-control"
                placeholder="Enter return point" value="{{ old('return_point') }}">
        </div>
    </div>
</div>
