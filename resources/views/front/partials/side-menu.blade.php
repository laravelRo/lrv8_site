<nav id="menu">
    <ul>
        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i>
                Homepage</a></li>
        <li>
            <span class="opener"> <i class="fas fa-clipboard-list"> </i>
                Categorii</span>
            <ul>

                @foreach ($menu_categories as $category)
                    <li>
                        <a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                    </li>
                @endforeach

            </ul>
        </li>
        <li><a href="{{ route('articles', ['all_articles' => 'all_articles']) }}">Articole</a></li>
        <li><a href="{{ route('category.info') }}">Site info</a></li>
        <li>
            <span class="opener">Dropdown Two</span>
            <ul>
                <li><a href="#">Sub Menu #1</a></li>
                <li><a href="#">Sub Menu #2</a></li>
                <li><a href="#">Sub Menu #3</a></li>
            </ul>
        </li>
        <li><a href="https://www.google.com">External Link</a></li>
    </ul>
</nav>
