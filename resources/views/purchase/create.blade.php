<x-app-layout>
    <x-bladewind::centered-content size="xxl">
        <x-bladewind::card class='my-4'>
            <x-slot:header>
                <div class="px-4 pt-2 pb-3">
                    <h2>Produkty w zamówieniu</h2>
                </div>
            </x-slot:header>
            <div class="grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1 gap-4">
            @foreach ($purchase->products as $p)
                <x-bladewind::card class='mx-4'>
                    <x-slot:header>
                        <div class="flex px-4 pt-2 pb-3">
                            <div class='mr-4'>
                                <img src="{{$p->image_path}}" alt="{{$p->name}}" />
                            </div>
                            <div>
                                <p>
                                    <span class='font-semibold'>Nazwa: </span>{{$p->name}}
                                </p>
                                <p>
                                    <span class='font-semibold'>Ilość: </span></span>{{$p->pivot->counter}}
                                </p>
                                <p>
                                    <span class='font-semibold'>Cena: </span></span>{{$p->price}} zł
                                </p>
                                <p>
                                    <span class='font-semibold'>Kwota w zakupie: </span>{{$p->pivot->counter * $p->price}} zł
                                </p>
                            </div>
                        </div>
                    </x-slot:header>
                </x-bladewind::card>
                @endforeach
            </div>
            <x-slot:footer>
                <div class="flex justify-end">
                    <div class='mr-4 mb-4'>
                        {{-- TODO: --}}
                        <x-bladewind::button tag='a' href='#' icon='wallet' icon_right="true" color='green'>Zamów jeszcze raz</x-bladewind::button>
                    </div>
                </div>
            </x-slot:footer>
        </x-bladewind::card>

    </x-bladewind::centered-content>
    <x-bladewind::centered-content size="tiny">

    </x-bladewind::centered-content>
</x-app-layout>
