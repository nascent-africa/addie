<div class="mb-3">
    <label for="city" class="form-label">{{ __('City') }}</label>

    <select class="form-select @error('city_id') is-invalid @enderror" name="city_id" id="city">
        @if ($city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @else
            <option selected>Select city</option>
        @endif

        @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>
    @error('city_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
