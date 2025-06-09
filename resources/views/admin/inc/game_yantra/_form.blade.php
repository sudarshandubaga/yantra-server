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
            <label for="title">Enter title</label>
            <input type="text" name="record[title]" class="form-control" placeholder="Enter title" id="title"
                required>
        </div>
        @php
            $language = [
                'english' => 'English',
                'hindi' => 'Hindi',
            ];
        @endphp
        <div class="form-group">
            <label for="language">Select Language</label>
            <select name="record[language]" class="form-control" id="language">
                <option value="0" selected disabled>Select Language</option>
                @foreach ($language as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="excerpt">Enter short description</label>
            <textarea name="record[excerpt]" class="form-control" id="excerpt" placeholder="Enter short description"
                rows="4" cols="3" required></textarea>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="cid">Select Category</label>
            <select name="record[cid]" class="form-control" id="cid" required>
                <option value="0" selected disabled>Select Category</option>
                @foreach ($parentArr as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tid">Select Tag</label>
            <select name="tid[]" class="form-control selectpicker" id="tid" required multiple>
                @foreach ($tagsArr as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Choose image</label>
            <div>
                @if (empty($image))
                    <img src="{{ url('top.jpg') }}" class="add_media" id="show_image"
                        style="width:120px;height:120px;" />
                    <input type="hidden" name="record[image]" value="" id="image">
                @else
                    <img src="{{ url('storage/media/' . $image) }}" class="add_media" id="show_image"
                        style="width:120px;height:120px;" />
                    <input type="hidden" name="record[image]" value="{{ $m_id }}" id="image">
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="description">Enter description</label>
            <textarea name="record[description]" class="form-control editor" placeholder="Enter description" id="description"></textarea>
        </div>
    </div>
    <h6 class="col-12">
        <p class="bg-primary text-white p-4 font-weight-bold">Meta Info</p>
    </h6>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="seo_title">Title</label>
            <input type="text" name="record[seo_title]" class="form-control" placeholder="Enter title"
                id="seo_title">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="seo_keywords">Keywords</label>
            <input type="text" name="record[seo_keywords]" class="form-control" placeholder="write..."
                id="seo_keywords">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="seo_description">Description</label>
            <textarea name="record[seo_description]" class="form-control" placeholder="write..." rows="4" cols="3"
                id="seo_description"></textarea>
        </div>
    </div>
</div>
