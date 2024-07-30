<x-app-layout>
    {{-- @php
        echo json_encode($purchase_by_seller, JSON_PRETTY_PRINT);
    @endphp --}}
    <x-bladewind::centered-content size="xxl">
        <h2>Wiadmości</h2>
        <x-bladewind::card class="hover:shadow-gray-300 mt-4 mb-44">
            @foreach ($purchase_by_seller->messages as $message)
                @if ($message->sender_id == auth()->id())
                    <div class='flex'>
                        <div class='flex-1'></div>
                        <div class='flex-1'>
                            <x-bladewind::card class="hover:shadow-gray-300" title="Twoja wiadomość">
                                <p class='text-right'>
                                    {{$message->text}}
                                </p>
                            </x-bladewind::card>
                        </div>
                    </div>
                @else
                    <div class='flex'>
                        <div class='flex-1'>
                            <x-bladewind::card class="hover:shadow-gray-300" title="{{$message->user->email}}">
                                <p class='text-left'>
                                    {{$message->text}}
                                </p>
                            </x-bladewind::card>
                        </div>
                        <div class='flex-1'></div>
                    </div>
                @endif
            @endforeach
        </x-bladewind::card>
        <x-bladewind::card class="hover:shadow-gray-300 fixed-bottom" title="Wyślij nową wiadomość">
            <form method="POST" action="{{route('messages.store')}}" id="editForm">
                @csrf
                <input type="hidden" name="purchase_by_seller_id" value="{{ $purchase_by_seller->id }}">
                <div class="flex justify-between">
                    <div class='w-3/4 mx-auto'>
                        <x-bladewind::input placeholder="Napisz wiadomość..."  name="text" required="true" error_message="Treść wiadomości jest wymagana" show_error_inline="true"/>
                    </div>
                    <div class='mr-auto'>
                        <x-bladewind::button can_submit="true" icon='paper-airplane' icon_right="true" size="medium">Wyslij</x-bladewind::button>
                    </div>
                </div>
            </form>
        </x-bladewind::card>
        <script>
            dom_el('#editForm').addEventListener('submit', function (e){
                e.preventDefault();
                submitForm(e);
            });

            submitForm = () => {
                if(validateForm('#editForm'))
                {
                    dom_el('#editForm').submit();
                }
            }
        </script>
    </x-bladewind::centered-content>
</x-app-layout>
