<section class="w-full max-w-4xl mx-auto space-y-8 animate-in fade-in duration-500">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Profile Settings') }}</flux:heading>

    {{-- Container Utama dengan Efek Glass --}}
    <div class="p-1 rounded-3xl bg-gradient-to-b from-white/10 to-transparent border border-white/5">
        <div class="bg-[#0b1222]/80 backdrop-blur-2xl rounded-[calc(1.5rem-1px)] p-8 shadow-2xl">
            
            <x-settings.layout :heading="__('Profile Information')" :subheading="__('Update your identity within the SmartPark ecosystem.')">
                
                <form wire:submit="updateProfileInformation" class="mt-8 space-y-6">
                    {{-- Grid untuk input agar lebih rapi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:input 
                                wire:model="name" 
                                :label="__('Full Name')" 
                                type="text" 
                                required 
                                autofocus 
                                autocomplete="name"
                                class="bg-white/5 border-white/10 focus:border-indigo-500/50 transition-all"
                            />
                        </div>

                        <div class="space-y-2">
                            <flux:input 
                                wire:model="email" 
                                :label="__('Email Address')" 
                                type="email" 
                                required 
                                autocomplete="email"
                                class="bg-white/5 border-white/10 focus:border-indigo-500/50 transition-all"
                            />
                        </div>
                    </div>

                    {{-- Status Verifikasi Email --}}
                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                        <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20">
                            <flux:text class="text-amber-200 text-sm flex items-center gap-2">
                                <flux:icon name="exclamation-triangle" variant="micro" />
                                {{ __('Your email address is unverified.') }}
                            </flux:text>

                            <flux:link class="text-xs font-bold uppercase tracking-wider text-amber-500 hover:text-amber-400 mt-2 block" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send verification') }}
                            </flux:link>

                            @if (session('status') === 'verification-link-sent')
                                <flux:text class="mt-2 text-[10px] font-bold text-emerald-400 uppercase tracking-widest">
                                    {{ __('Verification link dispatched.') }}
                                </flux:text>
                            @endif
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="pt-6 border-t border-white/5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <flux:button variant="primary" type="submit" class="shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:scale-105 transition-all">
                                {{ __('Save Changes') }}
                            </flux:button>

                            <x-action-message on="profile-updated">
                                <span class="text-xs font-bold text-emerald-500 uppercase tracking-widest flex items-center gap-1">
                                    <flux:icon name="check-circle" variant="micro" />
                                    {{ __('Sync Complete') }}
                                </span>
                            </x-action-message>
                        </div>
                    </div>
                </form>

            </x-settings.layout>
        </div>
    </div>

    {{-- Danger Zone (Delete Account) --}}
    <div class="p-1 rounded-3xl bg-red-500/5 border border-red-500/10">
        <div class="bg-[#0b1222]/40 rounded-[calc(1.5rem-1px)] p-8">
            <livewire:settings.delete-user-form />
        </div>
    </div>
</section>