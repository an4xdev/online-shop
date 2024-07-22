<x-app-layout>
    @php
        // echo json_encode($purchasesBySeller, JSON_PRETTY_PRINT);
    @endphp
    @foreach ($purchasesBySeller as $purchase)
        <div>
            @foreach ($purchase->products as $p)
                <div>
                   {{$p->product->name}}
                </div>
            @endforeach
        </div>
    @endforeach
</x-app-layout>
