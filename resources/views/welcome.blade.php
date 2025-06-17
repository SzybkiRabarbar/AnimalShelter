@guest
<x-guest-layout>
    @if (Route::has('login'))
    <nav class="flex items-center justify-end gap-4">
        @auth
        <a
            href="{{ url('/dashboard') }}"
            class="inline-block px-5 py-1.5 text-text border-border hover:border-primary rounded-sm text-sm leading-normal">
            Dashboard
        </a>
        @else
        <a
            href="{{ route('login') }}"
            class="inline-block px-5 py-1.5 text-text border border-transparent hover:border-border rounded-sm text-sm leading-normal">
            Log in
        </a>

        @if (Route::has('register'))
        <a
            href="{{ route('register') }}"
            class="inline-block px-5 py-1.5 text-text border-border hover:border-primary rounded-sm text-sm leading-normal">
            Register
        </a>
        @endif
        @endauth
    </nav>
    @endif
    </header>
    <img src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fstatic3.businessinsider.com%2Fimage%2F5484d9d1eab8ea3017b17e29%2F9-science-backed-reasons-to-own-a-dog.jpg&f=1&nofb=1&ipt=bbfa134dee18b0e5868073f96f466b7c1923efe393e022589378920ea6847725"/>
    {{-- Content for guest users --}}
    <span class="text-text">Hello Guest</span>
</x-guest-layout>
@endguest

@auth
<x-app-layout>
    {{-- Content for authenticated users --}}
    <span class="text-text">Hello Authenticated User</span>
</x-app-layout>
@endauth