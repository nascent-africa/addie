<div class="mb-3">
    <label for="region" class="form-label">{{ __('Region') }}</label>

    <select class="form-select @error('region_id') is-invalid @enderror" name="region_id" id="region">
        @if ($region)
            <option value="{{ $region->id }}">{{ $region->name }}</option>
        @else
            <option selected>Select region</option>
        @endif

        @foreach($regions as $region)
            <option value="{{ $region->id }}">{{ $region->name }}</option>
        @endforeach
    </select>
    @error('region_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
