<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english" role="tab" aria-controls="english" aria-selected="true">{{ __('English') }}</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="french-tab" data-toggle="tab" href="#french" role="tab" aria-controls="french" aria-selected="false">{{ __('French') }}</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="english-tab">
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>

            <input type="text" name="name[en]" class="form-control @error('name.en') is-invalid @enderror"
                   value="{{ old('name.en', $node ? $node->getTranslation('name', 'en') : null) }}" id="name" placeholder="Burkina Faso">

            @error('name.en')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="tab-pane fade" id="french" role="tabpanel" aria-labelledby="french-tab">
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>

            <input type="text" name="name[fr]" class="form-control @error('name.fr') is-invalid @enderror"
                   value="{{ old('name.fr', $node ? $node->getTranslation('name', 'fr') : null) }}" id="name" placeholder="Burkina Faso">

            @error('name.fr')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
