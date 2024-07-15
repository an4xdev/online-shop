<x-bladewind::card class="hover:shadow-gray-300">
    <div class='flex'>
        <div class='mb-4 flex-1'>
            <img src="{{$product->image_path}}" alt="{{$product->name}}">
        </div>
        <div class='flex flex-col ms-4' style='align-items:end'>
            <div class='mb-4'>
                <a href="{{route('product.show', $product)}}" class='cursor-pointer hover:shadow-black'>{{ $product->name }}</a>
            </div>
            <div class='mb-4'>
                <p>
                    {{ $product->price }} zł
                </p>
            </div>
            <div class='mb-4'>
                <x-bladewind::button tag='a' href='#' icon='arrow-up-right' icon_right="true" type="secondary">{{$product->category->name}}</x-bladewind::button>
            </div>
        </div>
    </div>
    <div class='flex justify-between'>
        <div>
            <x-bladewind::button tag='a' href='#' icon='shopping-cart' icon_right="true">Dodaj do koszyka</x-bladewind::button>
        </div>
        <div>
            <x-bladewind::button tag='a' href='#' icon='wallet' icon_right="true" color='green'>Kup teraz</x-bladewind::button>
        </div>
    </div>
</x-bladewind::card>