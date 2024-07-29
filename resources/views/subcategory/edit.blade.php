<x-app-layout>
    <x-bladewind::centered-content size="xl">
        <form action="{{route('subcategory.update', $subcategory)}}" method="post" id="editForm">
            @csrf
            @method('PUT')
            {{-- TODO: make value of category id selected --}}
            <x-bladewind::select name="category_id" placeholder="Kategoria produktu" :data="$categoryData" searchable="true"/>
            <x-bladewind::input name="name" placeholder="Nazwa podkategorii" required="true"
            show_error_inline="true" error_message="Nazwa podkategorii jest wymagana" selected_value="{{$subcategory->name}}"/>
            <x-bladewind::button can_submit="true" icon='pencil-square' icon_right="true" color="green" size="medium">Edytuj</x-bladewind::button>
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
