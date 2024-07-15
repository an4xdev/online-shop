<div class="lg:hidden mt-4 p-4">
    <details class='flex justify-center' id='mobile-categories'>
    <summary class="cursor-pointer summary p-4">Pokaż kategorie</summary>
    @foreach($categories as $category)
        <details class='my-8'>
            <summary class='summary p-4'>{{ $category->name }}</summary>
            @if($category->subCategories->isNotEmpty())
                    @foreach($category->subCategories as $subCategory)
                        <div class='my-4 flex justify-center'>
                            <x-bladewind::button tag='a' href='{{route("product.showByCategory", $subCategory)}}' icon='arrow-up-right' icon_right="true" size='medium'>{{ $subCategory->name }}</x-bladewind::button>
                        </div>
                    @endforeach
            @else
                <p>Brak podkategorii.</p>
            @endif
        </details>
    @endforeach
    </details>
</div>
