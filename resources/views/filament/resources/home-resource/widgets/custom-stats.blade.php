<x-filament-widgets::widget>
    <x-filament::section>
        <x-filament::card>
            <h2 class="text-xl font-bold">👋 Welcome back, {{ auth()->user()->name }}!</h2>
            <p class="mt-2 text-gray-500">Here’s a quick overview of tasks management.</p>
            <a href="{{route('tasks.index')}}" style="color: #9a3412"> <h1>Task management page</h1> </a>
        </x-filament::card>
        <x-filament::card>
            <h2 class="text-xl font-bold">👋 Welcome back, {{ auth()->user()->name }}!</h2>
            <p class="mt-2 text-gray-500">Here’s a quick overview of user roles management.</p>
            <a href="{{url('/admin/users')}}" style="color: #9a3412"> <h1>Users management page</h1> </a>
        </x-filament::card>
    </x-filament::section>
</x-filament-widgets::widget>
