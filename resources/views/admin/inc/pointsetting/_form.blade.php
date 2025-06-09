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
            <label for="point_value">Enter Point Value (vs ₹1)</label>
            <input type="text" name="record1[point_value]" class="form-control" placeholder="Enter Point Value"
                id="point_value" value="{{ old('record1.point_value') }}">
        </div>
        <div class="form-group">
            <label for="use_point">Enter Use Point (%)</label>
            <input type="text" name="record1[use_point]" class="form-control" placeholder="Enter Use Point (%)"
                id="use_point" value="{{ old('record1.use_point') }}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="max_points">Enter Max Points (use time)</label>
            <input type="text" name="record1[max_points]" class="form-control" placeholder="Enter Max Points"
                id="max_points" value="{{ old('record1.max_points') }}">
        </div>
        <div class="form-group">
            <label for="min_cart_amount">Enter Min Cart Amount (use time)</label>
            <input type="text" name="record1[min_cart_amount]" class="form-control"
                placeholder="Enter Min Cart Amount" id="min_cart_amount" value="{{ old('record1.min_cart_amount') }}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="accept_point">Enter Referal Code Point</label>
            <input type="text" name="record[accept_point]" class="form-control"
                placeholder="Enter Referal Code Point" id="accept_point" value="{{ old('record.accept_point') }}">
        </div>
    </div>
</div>
