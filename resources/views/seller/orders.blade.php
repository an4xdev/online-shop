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
                        <div><span class="font-semibold">Rodzaj dostawy: </span>{{$purchase->delivery_method->name}}</div>
                        <div>
                            <span class="font-semibold">Kwota: </span>{{$purchase->purchase->total_price}} zł
                        </div>
                        <div>
                            <x-bladewind::button tag="a" href="{{route('messages.show', $purchase)}}" icon="chat-bubble-oval-left-ellipsis" icon_right="true">Czat</x-bladewind::button>
                        </div>
                    </div>
                </x-bladewind::card>
                <x-bladewind::card class='my-2 p-4' title="Zmień status zamówienia">
                    <div class='flex justify-start flex-row'>
                        @foreach ($delivery_statuses as $ds)
                        <div>
                            <form action="{{route('purchase.changeStatus')}}" method="post" class='mr-4'>
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="purchase_by_seller_id" value="{{$purchase->id}}">
                                <input type="hidden" name="delivery_status_id" value="{{$ds->id}}">
                                @if ($ds->id - $purchase->delivery_status->id == 1 )
                                    <x-bladewind::button can_submit="true" icon='pencil-square' icon_right="true">{{$ds->name}}</x-bladewind::button>
                                @else
                                    <x-bladewind::button can_submit="true" icon='pencil-square' icon_right="true" disabled="true">{{$ds->name}}</x-bladewind::button>
                                @endif
                            </form>
                        </div>
                        @endforeach
                    </div>
                </x-bladewind::card>
                <x-bladewind::card class='my-2 p-4' title="Produkty w zamówieniu">
                    @foreach ($purchase->products as $p)
                        <x-bladewind::card class='my-2'>
                            <div class='flex justify-between'>
                                <div><span class="font-semibold">Nazwa: </span>{{$p->product->name}}</div>
                                <div><span class="font-semibold">Ilość: </span>{{$p->counter}}</div>
                            </div>
                        </x-bladewind::card>
                    @endforeach
                </x-bladewind::card>
            </x-bladewind::card>
        @endforeach
    </x-bladewind::centered-content>
</x-app-layout>
