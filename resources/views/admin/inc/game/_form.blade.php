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
            <label for="name">Enter name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter title" id="name"
                required="required" value="{{ old('name') }}">
        </div>
        <!--
   <div class="form-group">
    <label for="description">Enter short description</label>
    <textarea name="record[description]" class="form-control" id="description" placeholder="Enter short description"
        rows="4" cols="3">{{ old('record.description') }}</textarea>
   </div>
   -->
    </div>
    <div class="col-lg-6">
        <input type="hidden" name="type" value="{{ $request->type }}">
        <div class="form-group">
            <label for="image">Choose Image</label>
            <div>
                <input type="file" name="image" id="image">
            </div>
        </div>
    </div>
</div>
