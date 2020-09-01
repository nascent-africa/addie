<div class="mb-3">
    <label for="country" class="form-label">{{ __('Country') }}</label>

    <select class="form-select @error('country_id') is-invalid @enderror" name="country_id" id="country">
        @if ($country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @else
            <option value="" selected>{{__('Select country')}}</option>
        @endif

        @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>
    @error('country_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
