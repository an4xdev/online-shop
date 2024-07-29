<x-app-layout>
    <x-bladewind::centered-content size="xl">
        <form action="{{route('subcategory.store')}}" method="post" id="editForm">
            @csrf
            @if (isset($categoryData))
                <x-bladewind::select name="category_id" placeholder="Kategoria produktu" :data="$categoryData" searchable="true"/>
            @elseif (isset($cat_id))
                <input type="hidden" name="category_id" value="{{$cat_id}}">
            @endif
            <x-bladewind::input name="name" placeholder="Nazwa podkategorii" required="true"
            show_error_inline="true" error_message="Nazwa podkategorii jest wymagana"/>
            <x-bladewind::button can_submit="true" icon='plus-circle' icon_right="true" color="green" size="medium">Dodaj</x-bladewind::button>
        </form>
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
