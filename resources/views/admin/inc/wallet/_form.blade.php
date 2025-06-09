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
    @php
        $typeArr = [
            'credit' => 'Credit',
            'debit' => 'Debit',
        ];
    @endphp
    <div class="col-lg-6">
        <div class="form-group">
            <label for="user_id">Select User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($userArr as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="type">Select Type</label>
            <select name="type" id="type" class="form-control">
                @foreach ($typeArr as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="amount">Enter amount</label>
            <input type="text" name="amount" id="title" class="form-control" placeholder="Enter amount"
                required="required" value="{{ old('amount') }}">
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label for="remarks">Remarks</label>
            <textarea name="remarks" id="remarks" class="form-control" placeholder="Enter Remarks">{{ old('remarks') }}</textarea>
        </div>
    </div>

</div>
