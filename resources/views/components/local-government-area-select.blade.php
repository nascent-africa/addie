<div class="mb-3">
    <label for="local-government-area" class="form-label">{{ __('Local Government Area') }}</label>

    <select class="form-select @error('local_government_area_id') is-invalid @enderror" name="local_government_area_id" id="local-government-area">
        @if ($localGovernmentArea)
            <option value="{{ $localGovernmentArea->id }}">{{ $localGovernmentArea->name }}</option>
        @else
            <option selected>Select Local Government Area</option>
        @endif

        @foreach($localGovernmentAreas as $localGovernmentArea)
            <option value="{{ $localGovernmentArea->id }}">{{ $localGovernmentArea->name }}</option>
        @endforeach
    </select>
    @error('local_government_area_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
