@guest
<x-guest-layout>
    <header class="p-1">
        <nav class="flex items-center justify-end gap-4">
            <a href="{{ route('login') }}">
                <x-secondary-button>
                    Log in
                </x-secondary-button>
            </a>
            <a href="{{ route('register') }}">
                <x-primary-button>
                    Register
                </x-primary-button>
            </a>
        </nav>
    </header>

    <img src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fstatic3.businessinsider.com%2Fimage%2F5484d9d1eab8ea3017b17e29%2F9-science-backed-reasons-to-own-a-dog.jpg&f=1&nofb=1&ipt=bbfa134dee18b0e5868073f96f466b7c1923efe393e022589378920ea6847725" />
    {{-- Content for guest users --}}
    <span class="text-text">Hello Guest</span>
</x-guest-layout>
@endguest

@auth
<x-app-layout>
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
</x-app-layout>
@endauth