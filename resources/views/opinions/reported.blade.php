<x-app-layout>
    <x-bladewind::centered-content size="xl">
        <div class='my-4 text-center'>
            <h2>Zgłoszone opinie</h2>
        </div>
        <div class='my-4'>
            {{$reported->links()}}
        </div>
        @foreach ($reported as $reported_op)
        <x-bladewind::card>
            <p class='p-1 mb-1'>
                <span class="font-semibold">Opinia do produktu: </span> {{$reported_op->opinion->product->name}}
                <br>
                <span class="font-semibold">Od: </span> {{$reported_op->opinion->user->email}} <br>
                <span class="font-semibold">Opinia: </span>
                @if ($reported_op->opinion->description == null)
                    Brak opisu.
                @else
                    {{$reported_op->opinion->description}}
                @endif
                <br>
            </p>
            <x-bladewind::rating rating="{{$reported_op->opinion->stars}}" color="yellow" clickable="false"/>
            <form action="{{route('opinion.destroy', $reported_op)}}" method="post">
                @csrf
                @method('DELETE')
                 <x-bladewind::button can_submit='true' icon='trash' icon_right="true" color='red'>Usuń opinie</x-bladewind::button>
            </form>
        </x-bladewind::card>
        @endforeach
        <div class='my-4'>
            {{$reported->links()}}
        </div>
    </x-bladewind::centered-content>
</x-app-layout>
