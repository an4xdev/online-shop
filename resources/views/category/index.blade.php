<x-app-layout>
    <x-bladewind::centered-content size="omg">
        <div class='flex justify-center my-4'>
            <x-bladewind::button tag="a" href="{{route('category.create')}}" icon='plus-circle' icon_right="true" color="green">Dodaj nową kategorią</x-bladewind::button>
        </div>
        <div class='flex justify-center my-4'>
            <x-bladewind::button tag="a" href="{{route('subcategory.create', null)}}" icon='plus-circle' icon_right="true" color="green">Dodaj nową podkategorię</x-bladewind::button>
        </div>
        <div class='grid grid-cols-2 gap-5'>
            @foreach ($categories as $category)
            <x-bladewind::card class='my-2 p-4'>
                <div class='flex justify-between'>
                    <div>
                        {{$category->name}}
                    </div>
                    <div class='flex'>
                        <div>
                            <x-bladewind::button tag="a" href="{{route('category.edit', $category)}}" icon='plus-circle' icon_right="true">Edytuj</x-bladewind::button>
                        </div>
                        <div class='ml-4'>
                            <form action="{{route('category.destroy', $category)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <x-bladewind::button can_submit="true" icon='plus-circle' icon_right="true" color="red">Usuń</x-bladewind::button>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <x-bladewind::button tag="a" href="{{route('subcategory.create', $category->id)}}" icon='plus-circle' icon_right="true" color="green">Dodaj nową podkategorię</x-bladewind::button>
                </div>
                @foreach ($category->subcategories as $sub)
                    <x-bladewind::card class='my-2 p-4'>
                        <div class='flex justify-between'>
                            <div>
                                {{$sub->name}}
                            </div>
                            <div class='flex'>
                                <div>
                                    <x-bladewind::button tag="a" href="#" icon='plus-circle' icon_right="true">Edytuj</x-bladewind::button>
                                </div>
                                <div class='ml-4'>
                                    <form action="{{route('subcategory.destroy', $sub)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <x-bladewind::button can_submit="true" icon='plus-circle' icon_right="true" color="red">Usuń</x-bladewind::button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </x-bladewind::card>
                @endforeach
            </x-bladewind::card>
        @endforeach
        </div>

    </x-bladewind::centered-content>
</x-app-layout>
