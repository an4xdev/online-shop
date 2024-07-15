<x-app-layout>
    @if(count($productsInCart) > 0)
    <ul>
        @foreach($productsInCart as $productInCart)
            <li>
                <div>Nazwa produktu: {{ $productInCart['product']->name }}</div>
                <div>Ilość: {{ $productInCart['quantity'] }}</div>
                <div>Cena: {{ $productInCart['product']->price }}</div>
            </li>
        @endforeach
    </ul>
@else
    <p>Koszyk jest pusty.</p>
@endif
</x-app-layout>
