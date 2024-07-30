<x-app-layout>
    <x-bladewind::centered-content size="xl">
        <div class='my-4'>
            {{$products->links()}}
        </div>
        @foreach ($products as $product)
        <x-bladewind::card>
            <span class="font-semibold">Opinie do produktu: </span> {{$product->name}}
             @foreach ($product->opinions as $op)
                <x-bladewind::card>
                    <p class='p-1 mb-1'>
                        <span class="font-semibold">Od: </span> {{$op->user->email}} <br>
                        <span class="font-semibold">Opinia: </span>
                         @if ($op->description == null)
                                    Brak opisu.
                                @else
                                    {{$op->description}}
                                @endif
                        <br>
                    </p>
                    <x-bladewind::rating rating="{{$op->stars}}" color="yellow" clickable="false"/>
                    <br>
                </x-bladewind::card>
            @endforeach
        </x-bladewind::card>
        @endforeach
        <div class='my-4'>
            {{$products->links()}}
        </div>
    </x-bladewind::centered-content>
</x-app-layout>
