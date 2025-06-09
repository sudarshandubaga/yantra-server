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
            <label for="name">Enter city name</label>
            <input type="text" name="record[name]" class="form-control" placeholder="Enter City name"
                required="required" id="name"
                value="{{ old('record.name', isset($record['name']) ? $record['name'] : '') }}">
        </div>
        <div class="form-group">
            <label for="sid">Select State</label>
            <select name="record[sid]" class="form-control" id="sid" required="required">
                <option value="0"
                    {{ old('record.sid', isset($record['sid']) ? $record['sid'] : '0') == '0' ? 'selected' : '' }}>
                    Select State</option>
                @foreach ($parentArr as $key => $value)
                    <option value="{{ $key }}"
                        {{ old('record.sid', isset($record['sid']) ? $record['sid'] : '0') == $key ? 'selected' : '' }}>
                        {{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="slug">Enter slug</label>
            <input type="text" name="record[slug]" class="form-control" placeholder="Enter slug" id="slug"
                value="{{ old('record.slug', isset($record['slug']) ? $record['slug'] : '') }}">
        </div>
    </div>

</div>
