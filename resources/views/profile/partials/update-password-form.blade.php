<section>
    <div class="card w-50">
        <h5 class="card-header">Edit Password</h5>
        <div class="card-body">
            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                    <div class="input-group">
                        <x-text-input id="update_password_current_password" name="current_password" type="password"
                            class="form-control" autocomplete="current-password" />
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="update_password_password" :value="__('New Password')" />
                    <div class="input-group">
                        <x-text-input id="update_password_password" name="password" type="password" class="form-control"
                            autocomplete="new-password" />
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                    <div class="input-group">
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                            type="password" class="form-control" autocomplete="new-password" />
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="fa-regular fa-floppy-disk"></i> Save
                    </button>
                </div>
            </form>

        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordButtons = document.querySelectorAll('.toggle-password');

            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling; // Input field before the button
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>

</section>
