<ul>
    <li> <a href="{{ route('register') }}">Register</a></li>
    <li> <a href="{{ route('login') }}">Sign In</a></li>
    <li> 
        <a href="{{ route('cart.index') }}">Cart   
            @if(Cart::instance('default')->count() > 0)<span class="cart-count"><span>{{Cart::instance('default')->count() }}</span></span>@endif
        </a>
    </li>
</ul>