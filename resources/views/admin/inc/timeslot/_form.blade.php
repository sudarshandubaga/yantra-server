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
<input type="hidden" name="type" value="{{ request('g_type') }}">
<div class="row">
    <div class="col-lg-2">
        <div class="form-group">
            <label for="start_game">Game start</label>
            <input type="time" name="start_game" id="start_game" class="form-control"
                value="{{ old('start_game', @$setting->start_game) }}" required>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label for="stop_game">Game end</label>
            <input type="time" name="stop_game" id="stop_game" class="form-control"
                value="{{ old('stop_game', @$setting->stop_game) }}" required>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="time">time</label>
            <input type="number" name="time" id="time" class="form-control" placeholder="Time in minutes"
                value="{{ old('time', @$time) }}" required>
        </div>
    </div>
    @php
        $statusArr = [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
        ];
    @endphp
    <div class="col-lg-2">
        <div class="form-group">
            <label for="status">Game status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">Select status</option>
                @foreach ($statusArr as $key => $value)
                    <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                        {{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
