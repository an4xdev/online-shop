<x-app-layout>
    <x-bladewind::centered-content size="xxl">
        <x-bladewind::card class="hover:shadow-gray-300 mt-4">
            <div class='flex'>
                <div class='mb-4 flex-1'>
                    <img src="{{$product->image_path}}" alt="{{$product->name}}">
                </div>
                <div class='flex flex-col ms-4' style='align-items:end'>
                    <div class='mb-4'>
                        <p class='font-semibold'>{{ $product->name }}</p>
                    </div>
                    <div class='mb-4'>
                        <p>
                            <span class='font-semibold'>Cena:</span> {{ $product->price }} zł
                        </p>
                    </div>
                    <div class='mb-4'>
                        <x-bladewind::button tag='a' href="{{route('product.showByCategory', $product->category)}}" icon='arrow-up-right' icon_right="true" type="secondary">{{$product->category->name}}</x-bladewind::button>
                    </div>
                    <div class='mb-4'>
                        <form action="{{route('cart.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="seller_id" value="{{$product->seller_id}}">
                            <input type="hidden" name="quantity" value="1">
                            <x-bladewind::button can_submit="true" icon='shopping-cart' icon_right="true">Dodaj do koszyka</x-bladewind::button>
                        </form>
                    </div>
                    <div>
                        {{-- TODO: --}}
                        <x-bladewind::button tag='a' href='#' icon='wallet' icon_right="true" color='green'>Kup teraz</x-bladewind::button>
                    </div>
                </div>
            </div>
        </x-bladewind::card>
        <x-bladewind::card class="hover:shadow-gray-300 mt-4">
            <div class='mb-4'>
                <h2 class='font-bold text-2xl'>Opis</h2>
            </div>
            <div>
                <p>
                    {{$product->description}}
                </p>
            </div>
        </x-bladewind::card>
    </x-bladewind::centered-content>
</x-app-layout>
