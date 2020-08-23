<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>{{ $name }}</span>
    <a class="link-secondary" href="#" aria-label="Add a new report">
        <span data-feather="plus-circle"></span>
    </a>
</h6>

<ul class="nav flex-column mb-2">
    {{ $slot }}
</ul>
