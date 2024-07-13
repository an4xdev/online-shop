<x-app-layout>
    <x-bladewind::centered-content size="xxl">
        <div class='grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-5'>
            <form action="{{route('search.searchByNameAndCategory')}}" method="GET">
                @csrf
                @foreach ($categoryData as $category)
                    <div>
                        <p class='mb-4 sm:ml-4'>{{$category['label']}}</p>
                        <div class='sm:ml-4'>
                            <x-bladewind::select name="{{$category['label']}}" :data="$category['subcategories']" searchable="true" placeholder="Wybierz podkategorię"/>
                        </div>
                    </div>
                @endforeach
                <input type="hidden" name="search" id='searchAdvanced'>
                <input type="hidden" name="category_id" id="category_id">
                <x-bladewind::button icon='magnifying-glass' icon_right="true" type="primary" can_submit="true">Wyszukaj zaawansowanie</x-bladewind::button>
            </form>
        </div>
        @foreach ($products as $product)
            <div>
                {{$product->name}}
            </div>
        @endforeach
    </x-bladewind::centered-content>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-url-parser/2.3.1/purl.min.js" integrity="sha512-tG/z3oMGIF5+ej4sVH0g+8J6XO/nxq/NtX85TEmnSx5mC8/FXurBybh7jSBv8i2+Fn+BXRclA329a66Axd89/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        const paramName = "search";
        const paramValue = $.url(window.location.href).param(paramName);
        $("#searchAdvanced").val(paramValue);
    });
    $("input:hidden").on("change", function () {
        $("#category_id").val($(this).val());
    });
</script>
