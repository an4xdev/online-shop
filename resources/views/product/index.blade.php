<x-app-layout>
    <x-bladewind::centered-content size="xxl">
        <div class='flex justify-center my-4'>
            <x-bladewind::button tag="a" href="{{route('product.create')}}" icon='plus-circle' icon_right="true" color="green">Dodaj nowy przedmiot do oferty</x-bladewind::button>
        </div>
        {{ $products->links() }}
        @foreach ($products as $product)
        <x-bladewind::card class='my-2 p-4'>
            <div class='flex justify-between'>
                <div class='flex'>
                    <div>
                        <img src="{{$product->image_path}}" alt="{{$product->name}}">
                    </div>
                    <div class='ml-4'>
                        <p><span class="font-semibold">Nazwa: </span>{{$product->name}}</p>
                        <p><span class="font-semibold">Cena: </span>{{$product->price}}</p>
                        <p><span class="font-semibold">Ilość ofert: </span>{{$product->counter}}</p>
                    </div>
                </div>
                <div>
                    <x-bladewind::button tag="a" href="{{route('product.edit', $product)}}" icon='plus-circle' icon_right="true">Edytuj</x-bladewind::button>
                    <form action="{{route('product.destroy', $product)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-bladewind::button can_submit="true" icon='plus-circle' icon_right="true" color="red">Usuń</x-bladewind::button>
                    </form>
                </div>
            </div>
        </x-bladewind::card>
        @endforeach
        {{ $products->links() }}
    </x-bladewind::centered-content>
</x-app-layout>
