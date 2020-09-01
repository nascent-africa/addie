<div class="mb-3">
    <label for="province" class="form-label">{{ __('State / Province') }}</label>

    <select class="form-select @error('province_id') is-invalid @enderror" name="province_id" id="province">
        @if ($province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @else
            <option selected>Select province</option>
        @endif

        @foreach($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
    </select>
    @error('province_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
