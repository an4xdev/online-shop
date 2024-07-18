<x-app-layout>
    <div class="flex flex-col-reverse pt-4 lg:flex-row">
        <x-bladewind::centered-content size="xxl" class='flex-1'>
            @if(count($productsInCart) > 0)
                <x-bladewind::card class="hover:shadow-gray-300" title="Wybierz formę płatności">
                    <form action="{{route('purchase.changeDeliveryMethod')}}" method="post" class='flex justify-between'>
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col">
                            @foreach ($deliveryTypes as $deliveryType)
                            @if ($deliveryType->id == $delivery['id'])
                                <x-bladewind::radio-button label="{{$deliveryType->name}} - {{$deliveryType->price}} zł" name="deliveryType" checked="true" value="{{$deliveryType->id}}"/>
                            @else
                                <x-bladewind::radio-button label="{{$deliveryType->name}} - {{$deliveryType->price}} zł" name="deliveryType" value="{{$deliveryType->id}}"/>
                            @endif
                            @endforeach
                        </div>
                        <div>
                            <x-bladewind::button icon='pencil-square' icon_right="true" type="primary" can_submit='true'>Zmień formę płatności</x-bladewind::button>
                        </div>
                    </form>
                </x-bladewind::card>
                @foreach($productsInCart as $productInCart)
                    <x-bladewind::card class="hover:shadow-gray-300">
                        <div class='flex'>
                            <div class='mb-4 flex-1'>
                                <img src="{{$productInCart['product']->image_path}}" alt="{{$productInCart['product']->name}}">
                            </div>
                            <div class='flex flex-col ms-4' style='align-items:end'>
                                <div class='mb-4'>
                                    <span class='font-semibold'>Nazwa: </span><a href="{{route('product.show', $productInCart['product'])}}" class='cursor-pointer hover:shadow-black'>{{ $productInCart['product']->name }}</a>
                                </div>
                                <div class='mb-4'>
                                    <p>
                                        <span class='font-semibold'>Cena: </span>{{ $productInCart['product']->price }} zł
                                    </p>
                                </div>
                                <div class='mb-4'>
                                    <x-bladewind::button tag='a' href="{{route('product.showByCategory', $productInCart['product']->category)}}" icon='arrow-up-right' icon_right="true" type="secondary">{{$productInCart['product']->category->name}}</x-bladewind::button>
                                </div>
                                <div class="mb-4">
                                    <p>
                                        <span class="font-semibold">Dostępna ilość ofert: </span> {{$productInCart['product']->counter}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class='flex justify-end'>
                            <div class='mr-4'>
                                <form action="{{route('cart.delete')}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="product_id" value='{{$productInCart['product']->id}}'>
                                    <x-bladewind::button can_submit="true" icon='trash' icon_right="true" color='red'>Usuń z koszyka</x-bladewind::button>
                                </form>
                            </div>
                            <div class='mr-4 ml-4'>
                                <form action="{{route('cart.update')}}" method="post" class='flex items-baseline'>
                                    @csrf
                                    @method('PUT')
                                    <div class='mr-2'>
                                        <input type="hidden" name="product_id" value="{{$productInCart['product']->id}}">
                                        <x-bladewind::input label="Ilość w zakupie" error_message="Minimalnie można zakupić 1 ofertę przedmiotu" name="quantity" value="{{$productInCart['quantity']}}" min="1" max="{{$productInCart['product']->counter}}" numeric="true" show_error_inline="true" class='mr-2' />
                                    </div>
                                    <div>
                                        <x-bladewind::button can_submit="true" icon='pencil-square' icon_right="true">Zmień ilość</x-bladewind::button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </x-bladewind::card>
                @endforeach
            @else
                <div class='mt-4'>
                    <x-bladewind::alert shade="dark" show_close_icon="false">Twój koszyk jest pusty.</x-bladewind::alert>
                </div>
            @endif

        </x-bladewind::centered-content>
        <x-bladewind::centered-content size="tiny">
            <x-bladewind::card class="hover:shadow-gray-300">
                <div class='flex justify-end'>
                    <span class="font-semibold mr-1">Kwota zakupu: </span> {{$priceWithDelivery}}zł ({{$totalPrice}} + dostawa: {{$delivery['price']}})
                </div>
            </x-bladewind::card>
            <x-bladewind::card class="hover:shadow-gray-300">
                <div class='flex justify-end'>
                    {{-- TODO: --}}
                    <x-bladewind::button tag='a' href="#" icon='wallet' icon_right="true" color='green'>Zamów i zapłać</x-bladewind::button>
                </div>
            </x-bladewind::card>
        </x-bladewind::centered-content>
    </div>
</x-app-layout>
