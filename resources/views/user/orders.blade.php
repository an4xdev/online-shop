<x-app-layout>
    <x-bladewind::centered-content size="xxl">
        @if (count($orders) > 0)
            @foreach ($orders as $order)
                <x-bladewind::card class='my-8'>
                    <x-slot:header>
                        <div class="flex px-4 pt-2 pb-3 justify-between">
                            <div>
                                <span class='font-semibold'>Data:</span> {{ \Carbon\Carbon::parse($order->date)->isoFormat('D MMMM YYYY') }}
                            </div>
                            <div>
                                <span class='font-semibold'>Zapłacona kwota:</span> {{$order->total_price}} zł
                            </div>
                        </div>
                    </x-slot:header>
                    <div class='p-4'>
                        @foreach ($order->bySellers as $bySeller)
                            <x-bladewind::card class='my-4'>
                                <x-slot:header>
                                    <div class="flex px-4 pt-3 pb-3 justify-between items-center">
                                        <div>
                                            <span class='font-semibold'>Status:</span> {{ $bySeller->delivery_status->name }}
                                        </div>
                                        @if ($bySeller->delivery_status->id == 3)
                                            <div>
                                                <form action="{{route('purchase.complete')}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="purchase_by_seller_id" value="{{$bySeller->id}}">
                                                    <x-bladewind::button can_submit="true" icon='check-circle' icon_right="true" color="green">Potwierdź otrzymanie</x-bladewind::button>
                                                </form>
                                            </div>
                                        @endif
                                        <div>
                                            <x-bladewind::button tag="a" href="{{route('messages.show', $bySeller)}}" icon="chat-bubble-oval-left-ellipsis" icon_right="true">Czat</x-bladewind::button>
                                        </div>
                                         <div>
                                            <span class='font-semibold'>Od sprzedawcy:</span> {{ $bySeller->seller->name }}
                                        </div>
                                    </div>
                                </x-slot:header>
                                <div class="grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1 gap-4 p-4">
                                    @foreach ($bySeller->products as $p)
                                        <x-bladewind::card class='mx-4'>
                                            <div class="flex px-4 pt-2 pb-3">
                                                <div class='mr-4'>
                                                    <img src="{{$p->product->image_path}}" alt="{{$p->product->name}}" />
                                                </div>
                                                <div>
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
                                            </div>
                                        </x-bladewind::card>
                                    @endforeach
                                </div>
                            </x-bladewind::card>
                        @endforeach
                    </div>
                </x-bladewind::card>
            @endforeach
        @else
            <x-bladewind::alert shade="dark" show_close_icon="false">
                Nie masz żadnych zamówień. Może chcesz zobaczyć swoje <a href="{{route('purchase.user', Auth::user())}}" class='underline hover:text-blue-100'>zakupy</a>
            </x-bladewind::alert>
        @endif
    </x-bladewind::centered-content>
</x-app-layout>
