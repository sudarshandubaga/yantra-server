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
            <label for="login">Enter login</label>
            <input type="text" name="login" class="form-control" placeholder="Enter login" id="title" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="password">Enter password</label>
            <input type="text" name="password" class="form-control" placeholder="Enter password" id="title"
                required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">Enter name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name" id="title" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="email">Enter email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" id="title" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="mobile">Enter mobile</label>
            <input type="number" name="mobile" class="form-control" placeholder="Enter mobile" id="title"
                required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="role_id">Select Role</label>
            <select name="role_id" class="form-control" id="title" required>
                <option value="">Select Role</option>
                @foreach ($roleArr as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
