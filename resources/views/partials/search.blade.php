<div class="searchbars-container">
    <div class="mx-1">
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <i class="fa fa-search search-icon"></i>
            <input type="text" name="query" id="query" value="{{ request()->input('query') }}" class="search-box" placeholder="Search for product">
        </form>
    </div>
    <div class="mx-1">
        <div class="position-relative">
            <i class="fa fa-search search-icon"></i>
            <input class="search-box" id="search-input" name="query" type="text" placeholder='Search for product with algolia' />
        </div>
    </div>
</div>