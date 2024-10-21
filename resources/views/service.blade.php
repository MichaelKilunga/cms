<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services Report') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white1 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="print-now p-6 text-gray-900">
                    {{-- {{ __("This is member's panel!") }} --}}
                    @include('attendance.navigation')
                </div>
                <div class="p-0 text-gray-900">
                    @if (session('alert_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('alert_success') }}
                            <button type="button" class="" data-bs-dismiss="alert" aria-label="Close"><span class="btn-close"></span></button>
                        </div>
                    @endif
                    @if (session('alert_failure'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('alert_failure') }}
                            <button type="button" class="" data-bs-dismiss="alert" aria-label="Close"><span class="btn-close"></span></button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
