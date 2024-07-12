<x-app-layout>
    <div class='lg:flex pt-4'>
        {{-- categories --}}
        <x-bladewind::centered-content size="tiny">
            {{-- Mobile --}}
            <div class="lg:hidden mt-4 p-4">
                <details class='flex justify-center' id='mobile-categories'>
                <summary class="cursor-pointer summary p-4">Pokaż kategorie</summary>
                @foreach($categories as $category)
                    <details class='my-8'>
                        <summary class='summary p-4'>{{ $category->name }}</summary>
                        @if($category->subCategories->isNotEmpty())
                                @foreach($category->subCategories as $subCategory)
                                    <div class='my-4 flex justify-center'>
                                        <x-bladewind::button tag='a' href='#' icon='arrow-up-right' icon_right="true" size='medium'>{{ $subCategory->name }}</x-bladewind::button>
                                    </div>
                                @endforeach
                        @else
                            <p>No subcategories available.</p>
                        @endif
                    </details>
                @endforeach
                </details>
            </div>
            {{-- desktop --}}
            <div class='hidden lg:block'>
                @foreach($categories as $category)
                    <details class='my-4'>
                        <summary class='summary p-2'>{{ $category->name }}</summary>
                        @if($category->subCategories->isNotEmpty())
                                @foreach($category->subCategories as $subCategory)
                                    <div class='my-2'>
                                        <x-bladewind::button tag='a' href='#' icon='arrow-up-right' icon_right="true">{{ $subCategory->name }}</x-bladewind::button>
                                    </div>
                                @endforeach
                        @else
                            <p>No subcategories available.</p>
                        @endif
                    </details>
                @endforeach
            </div>
        </x-bladewind::centered-content>
        {{-- items --}}
        <x-bladewind::centered-content size="xxl">
            <div class="grid lg:grid-cols-3 sm:grid-cols-1 md:grid-cols-2 gap-10">
                @foreach($randomProducts as $product)
                    <x-bladewind::card class="hover:shadow-gray-300">
                        <div class='flex'>
                            <div>
                                <img src="{{$product->image_path}}" alt="{{$product->name}}">
                            </div>
                            <div class='flex flex-col ms-4' style='align-items:end'>
                                <div class='mb-4'>
                                    <p>{{ $product->name }}</p>
                                </div>
                                <div class='mb-4'>
                                    <p>
                                        {{ $product->price }} zł
                                    </p>
                                </div>
                                <div class='mb-4'>
                                    <p>
                                        {{$product->category->name}}
                                    </p>
                                </div>
                                <div>
                                    <x-bladewind::button tag='a' href='#' icon='shopping-cart' icon_right="true">Dodaj do koszyka</x-bladewind::button>
                                </div>
                                <div>
                                    <x-bladewind::button tag='a' href='#' icon='wallet' icon_right="true">Kup teraz</x-bladewind::button>
                                </div>
                            </div>
                        </div>
                    </x-bladewind::card>
                @endforeach
            </div>
        </x-bladewind::centered-content>
    </div>
</x-app-layout>
