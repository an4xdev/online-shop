<x-app-layout>
    <x-bladewind::centered-content size="xl">
        <form action="{{route('category.store')}}" method="post" id="editForm">
            @csrf
            <x-bladewind::input name="name" placeholder="Nazwa kategorii" required="true"
            show_error_inline="true" error_message="Nazwa kategorii jest wymagana"/>
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
