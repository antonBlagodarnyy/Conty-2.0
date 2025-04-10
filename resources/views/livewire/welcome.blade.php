<div class="container">

    <div class="flex flex-col items-center justify-center mt-20">
        <flux:heading class="p-2" size="xl">Conty 2.0</flux:heading>

        <div class="container-modals flex">
            <div class="container-modals-login mr-5">
                <flux:modal.trigger name="login">
                    <flux:button>Login</flux:button>
                </flux:modal.trigger>
                <flux:modal name="login" class="md:w-96">
                    <div class="space-y-6">
                        <div>
                            <livewire:login></livewire:login>
                        </div>
                    </div>
                </flux:modal>
            </div>

            <div class="container-modals-signup">
                <flux:modal.trigger name="signup">
                    <flux:button>Signup</flux:button>
                </flux:modal.trigger>
                <flux:modal name="signup" class="md:w-96">
                    <div class="space-y-6">
                        <div>
                            <livewire:signup></livewire:signup>
                        </div>
                    </div>
                </flux:modal>
            </div>
        </div>
    </div>

</div>