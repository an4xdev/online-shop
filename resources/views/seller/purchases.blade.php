<x-app-layout>
    @php
        // echo json_encode($purchasesBySeller, JSON_PRETTY_PRINT);
    @endphp
    <x-bladewind::centered-content size="xxl">
        @foreach ($purchasesBySeller as $bySeller)
            <x-bladewind::card class='my-8'>
                <x-slot:header>
                    <div class="flex px-4 pt-2 pb-3 justify-between">
                        <div>
                            <span class='font-semibold'>Data:</span> {{ \Carbon\Carbon::parse($bySeller->purchase->date)->isoFormat('D MMMM YYYY') }}
                        </div>
                        <div>
                            <x-bladewind::button tag="a" href="{{route('messages.show', $bySeller)}}" icon="chat-bubble-oval-left-ellipsis" icon_right="true">Czat</x-bladewind::button>
                        </div>
                        <div>
                            <span class='font-semibold'>Zapłacona kwota:</span> {{$bySeller->purchase->total_price}} zł
                        </div>
                    </div>
                </x-slot:header>
                    <div class='grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1 gap-4 p-4'>
                        @foreach ($bySeller->products as $p)
                            <x-bladewind::card class='my-4'>
                                <div class="px-4 pt-2 pb-3">
                                    <p>
                                        <span class='font-semibold'>Nazwa: </span>{{$p->product->name}}
                                    </p>
                                    <p>
                                        <span class='font-semibold'>Ilość: </span></span>{{$p->counter}}
                                    </p>
                                    <p>
                                        <span class='font-semibold'>Cena: </span></span>{{$p->product->price}} zł
                                    </p>
                                    <p>
                                        <span class='font-semibold'>Kwota w zakupie: </span>{{$p->counter * $p->product->price}} zł
                                    </p>
                                </div>

                            </x-bladewind::card>
                        @endforeach
                    </div>
                </x-bladewind::card>
            @endforeach
    </x-bladewind::centered-content>
</x-app-layout>
