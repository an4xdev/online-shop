<x-app-layout>
    <x-bladewind::centered-content size="xxl">
        <x-bladewind::card class="hover:shadow-gray-300 mt-4">
            <div class='flex'>
                <div class='mb-4 flex-1'>
                    <img src="{{$product->image_path}}" alt="{{$product->name}}">
                </div>
                <div class='flex flex-col ms-4' style='align-items:end'>
                    <div class='mb-4'>
                        <p class='font-semibold'>{{ $product->name }}</p>
                    </div>
                    <div class='mb-4'>
                        <p>
                            <span class='font-semibold'>Cena:</span> {{ $product->price }} zł
                        </p>
                    </div>
                    <div class='mb-4'>
                        <x-bladewind::button tag='a' href="{{route('product.showByCategory', $product->category)}}" icon='arrow-up-right' icon_right="true" type="secondary">{{$product->category->name}}</x-bladewind::button>
                    </div>
                    <div class='mb-4'>
                        <form action="{{route('cart.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="seller_id" value="{{$product->seller_id}}">
                            <input type="hidden" name="quantity" value="1">
                            <x-bladewind::button can_submit="true" icon='shopping-cart' icon_right="true">Dodaj do koszyka</x-bladewind::button>
                        </form>
                    </div>
                    <div>
                        {{-- TODO: --}}
                        <x-bladewind::button tag='a' href='#' icon='wallet' icon_right="true" color='green'>Kup teraz</x-bladewind::button>
                    </div>
                </div>
            </div>
        </x-bladewind::card>
        <x-bladewind::card class="hover:shadow-gray-300 mt-4">
            <div class='mb-4'>
                <h2 class='font-bold text-2xl'>Opis</h2>
            </div>
            <div>
                <p>
                    {{$product->description}}
                </p>
            </div>
        </x-bladewind::card>
        <x-bladewind::card class="hover:shadow-gray-300 mt-4">
            <div class='mb-4'>
                <h2 class='font-bold text-2xl'>Opinie</h2>
            </div>
            <div>
                <x-bladewind::card title="Dodaj nową opinię">
                    <form action="{{route('opinions.store')}}" method="post" id="editForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <x-bladewind::textarea placeholder="Opinia" name="description"></x-bladewind::textarea>
                        <x-bladewind::select name="stars" placeholder="Wybierz ocenę" data="manual" required="true">
                            <x-bladewind::select-item label="1" value="1" />
                            <x-bladewind::select-item label="2" value="2" />
                            <x-bladewind::select-item label="3" value="3" />
                            <x-bladewind::select-item label="4" value="4" />
                            <x-bladewind::select-item label="5" value="5" />
                        </x-bladewind::select>
                        <br>
                        <x-bladewind::button can_submit='true' icon='plus-circle' icon_right="true" color='green'>Dodaj opinię</x-bladewind::button>
                    </form>
                </x-bladewind::card>
               @foreach ($product->opinions as $opinion)
                   <x-bladewind::card class="hover:shadow-gray-300 mt-4" title="Wystawił: {{$opinion->user->email}}">
                        <p class='p-2'>
                            <span class="font-semibold">Opis: </span>
                            @if ($opinion->description == null)
                                Brak opisu.
                            @else
                                {{$opinion->description}}
                            @endif
                        </p>
                        <div class="mt-5">
                        <x-bladewind::rating rating="{{$opinion->stars}}" color="yellow" clickable="false" name="stars{{$opinion->id}}"/>
                        </div>
                   </x-bladewind::card>
               @endforeach
            </div>
        </x-bladewind::card>
    </x-bladewind::centered-content>
    <script>
        dom_el('#editForm').addEventListener('submit', function (e){
            e.preventDefault();
            submitForm();
        });

        submitForm = () => {
            if(validateForm('#editForm'))
            {
                dom_el('#editForm').submit();
            }
        }
    </script>
</x-app-layout>
