<div class='hidden lg:block'>
    @foreach($categories as $category)
        <details class='my-4'>
            <summary class='summary p-2'>{{ $category->name }}</summary>
            @if($category->subCategories->isNotEmpty())
                    @foreach($category->subCategories as $subCategory)
                        <div class='my-2'>
                            <x-bladewind::button tag='a' href='{{route("product.showByCategory", $subCategory)}}' icon='arrow-up-right' icon_right="true">{{ $subCategory->name }}</x-bladewind::button>
                        </div>
                    @endforeach
            @else
                <p>No subcategories available.</p>
            @endif
        </details>
    @endforeach
</div>
