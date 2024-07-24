<x-app-layout>
    <a href="{{route('product.create')}}">TEST</a>
    <div class='lg:flex pt-4'>
        {{-- categories --}}
        <x-bladewind::centered-content size="tiny">
            <x-category-nav-menu-mobile :categories="$categories"/>
            <x-category-nav-menu :categories="$categories"/>
        </x-bladewind::centered-content>
        {{-- items --}}
        <x-bladewind::centered-content size="xxl">
            <div class="grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1 gap-10">
                @foreach($randomProducts as $product)
                <x-product-component :product="$product"/>
                @endforeach
            </div>
        </x-bladewind::centered-content>
    </div>
</x-app-layout>
