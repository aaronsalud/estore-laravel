<ul>
    @foreach($items as $menu_item)
    <li>
        <a href="{{ $menu_item->link() }}" target="{{$menu_item->target}}">
            {{ $menu_item->title }}
            @if($menu_item->title === 'Cart')
                @if(Cart::instance('default')->count() > 0)<span class="cart-count"><span>{{Cart::instance('default')->count() }}</span></span>@endif
            @endif
        </a>
    </li>
    @endforeach
</ul>