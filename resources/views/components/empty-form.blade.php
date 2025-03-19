<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-label for="client" value="{{ __('Client') }}" />
            <x-input id="client" class="block mt-1 w-full" type="text" name="client" :value="old('client')" required autofocus autocomplete="client" />
        </div>

        <div class="mt-4">
            <x-label for="project" value="{{ __('Project') }}" />
            <x-input id="project" class="block mt-1 w-full" type="text" name="project" required autocomplete="project" />
        </div>

        <div class="mt-4">
            <x-label for="po" value="{{ __('PO') }}" />
            <x-input id="po" class="block mt-1 w-full" type="text" name="po" required autocomplete="po" />
        </div>

        <div class="mt-4">
            <x-label for="status" value="{{ __('Status') }}" />
            <x-input id="status" class="block mt-1 w-full" type="text" name="status" required autocomplete="status" />
        </div>
        
        <div class="mt-4">
            <x-label for="completion_date" value="{{ __('Completion Date') }}" />
            <x-input id="completion_date" class="block mt-1 w-full" type="date" name="completion_date" required autocomplete="completion_date" />
        </div>

        <div class="mt-4">
            <x-label for="invoice" value="{{ __('Invoice') }}" />
            <x-input id="invoice" class="block mt-1 w-full" type="text" name="invoice" required autocomplete="invoice" />
        </div>

        
        <div class="flex flex-col items-center w-full mt-4"> 
            <!-- Log in button covers full width -->
            <div class="flex items-center w-full">
                <x-button class="w-full">
                    {{ __('Create Form') }}
                </x-button>
            </div>
    </form>
</div>