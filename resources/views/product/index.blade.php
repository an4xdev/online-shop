<x-app-layout>
    <x-bladewind::centered-content size="xxl">
        <a href="{{route('product.create')}}">TEST</a>
        @foreach ($products as $product)
            <div>
                <p>{{$product->name}}</p>
            </div>
        @endforeach
    </x-bladewind::centered-content>
</x-app-layout>
