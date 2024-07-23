<x-app-layout>
    @php
        // echo json_encode($purchasesBySeller, JSON_PRETTY_PRINT);
    @endphp
    <x-bladewind::centered-content size="xxl">
        @foreach ($purchasesBySeller as $purchase)
            <x-bladewind::card class='my-8'>
                @foreach ($purchase->products as $p)
                    {{$p->product->name}}
                @endforeach
            </x-bladewind::card>
        @endforeach
    </x-bladewind::centered-content>
</x-app-layout>
