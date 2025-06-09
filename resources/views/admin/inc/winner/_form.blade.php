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


@foreach ($timeslot as $t)
    <div class="row mb-3">
        <div class="col-lg-6">
            <div class="form-group">


                {{ $t->time }}


            </div>
        </div>
        <div class="col-lg-6">
            <select name="game[{{ $t->id }}]" class="form-control" id="game_id"
                @if ($t->is_switch != '1') disabled @endif>
                @foreach ($gameArr[$t->id] as $key => $value)
                    <option value="{{ $key }}" @if ($t->game_id == $key) selected @endif>
                        {{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endforeach
<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("setTodaysDate")[0].setAttribute('min', today);
</script>
<script>
    function cityChangedTrigger() {

        let queryString = "{{ route('timeslote_schedule.create') }}"; // get url parameters        
        document.location = queryString + "?type=" + document.getElementById("type")
            .value; // refresh the page with new url

    }
</script>
