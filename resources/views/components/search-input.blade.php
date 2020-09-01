<form id="search-form" class="w-100" method="get">
    <input id="search" class="form-control form-control-dark w-100" name="search"
           type="text" placeholder="{{__('Search')}}" aria-label="Search">
</form>
<script>
    document.getElementById('search').onkeydown = function(event){
        if(event.key === 'Enter'){
            document.getElementById('search-form').submit();
        }
    };
</script>
