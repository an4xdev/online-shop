<x-app-layout>
    <x-bladewind::centered-content size="xl">
        <form action="#" method="post" id="editForm" enctype="multipart/form-data">
            @csrf
            {{-- name --}}
            <x-bladewind::input name="name" placeholder="Nazwa produktu" required="true"
            show_error_inline="true" error_message="Nazwa produktu jest wymagana" value="{{$product->name}}"/>
            {{-- description --}}
            <x-bladewind::textarea required="true" name="description" error_message="Opis jest wymagany" show_error_inline="true" placeholder="Opis produktu" selected_value="{{$product->description}}"></x-bladewind::textarea>
            {{-- price --}}
            <label for="price">Cena</label>
            <x-bladewind::input numeric="true" with_dots="true" name="price" min="0" required="true" error_message="Cena produktu jest wymagana oraz musi być powyżej 0 zł" placeholder="0.99" id="price" show_error_inline="true" suffix="zł" value="{{$product->price}}"/>
            {{-- image_path --}}
            <x-bladewind::filepicker name="image" required="true" placeholder="Zdjęcie produktu" accepted_file_types="image/*" error_message="Zdjęcie produktu jest wymagane" url="{{$product->image_path}}"/>
            {{-- counter --}}
            <label for="counter">Ilość</label>
            <x-bladewind::input numeric="true" name="counter" min="0" required="true" error_message="Ilość dostępnych produktów jest wymagana oraz większa niż 0" placeholder="1" id="counter" show_error_inline="true" value="{{$product->price}}"/>
            {{-- sub_category_id --}}
            {{-- TODO: make value selected --}}
            <div class='flex'>
                <div class='flex-1'>
                    <x-bladewind::select name="category_id" placeholder="Kategoria produktu" :data="$categoriesData" filter="sub_category_id" searchable="true"/>
                </div>
                <div class='flex-1'>
                    <x-bladewind::select name="sub_category_id" placeholder="Podkategoria produktu" searchable="true" :data="$subCategoriesData" filter_by="category_id" required="true" show_error_inline="true" error_message="Podkategoria jest wymagana"/>
                </div>
            </div>
            {{-- button --}}
            <div class="flex justify-end">
                <x-bladewind::button can_submit="true" icon='plus-circle' icon_right="true" color="green" size="medium">Dodaj</x-bladewind::button>
            </div>
        </form>
    </x-bladewind::centered-content>
    <script>
        dom_el('#editForm').addEventListener('submit', function (e){
            e.preventDefault();
            submitForm(e);
        });

        submitForm = () => {
            if(validateForm('#editForm'))
            {
                document.getElementById('editForm').submit();
            }
        }
    </script>
</x-app-layout>
