<div class="container-fluid mb-5">
    <div class="row">
        @if(isset($right_column))
        <div class="col-md-4 col-lg-3 order-md-last pt-3 border-left">
            {{  $right_column }}
        </div>
        @endif

        <div class="{{ isset($right_column) ? 'col-md-8 col-lg-9' : 'col-12' }}">
            {{ $slot }}
        </div>
    </div>
</div>
