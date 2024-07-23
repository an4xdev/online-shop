<x-app-layout>
    @php
        // echo json_encode($purchasesBySeller, JSON_PRETTY_PRINT);
    @endphp
    <x-bladewind::centered-content size="xxl">
        @foreach ($purchasesBySeller as $purchase)
            <x-bladewind::card class='my-8' title="Zamówienie z dnia {{\Carbon\Carbon::parse($purchase->purchase->date)->isoFormat('D MMMM YYYY')}}">
                <x-bladewind::card class='my-2 p-4' title="Szczegóły zamówienia">
                    <div class='flex justify-between'>
                        <div>
                            <span class="font-semibold">Status: </span>{{$purchase->delivery_status->name}}
                        </div>
                        <div>
                            <span class="font-semibold">Kwota: </span>{{$purchase->purchase->total_price}} zł
                        </div>
                    </div>
                </x-bladewind::card>
                <x-bladewind::card class='my-2 p-4' title="Produkty w zamówieniu">
                    @foreach ($purchase->products as $p)
                        <x-bladewind::card class='my-2'>
                            <p>{{$p->product->name}}</p>
                        </x-bladewind::card>
                    @endforeach
                </x-bladewind::card>
            </x-bladewind::card>
        @endforeach
    </x-bladewind::centered-content>
</x-app-layout>
