<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avatar" :value="__('Change Avatar')" />
            <main class="mt-1 block w-full" id="dropzone" x-data="{
                isOver: false,
                fileName: '',
                isClicked: false,
                handleFile(file) {
                    if (file) {
                        this.file = {
                            name: file.name,
                            size: (file.size / 1024).toFixed(2) + ' KB',
                            type: file.type || 'Unknown'
                        };
                    }
                }
            }"
                @drop.prevent="isOver = false; handleFile($event.dataTransfer.files[0]); $refs.fileInput.value = ''"
                @dragover.prevent="isOver = true" @dragleave.prevent="isOver = false"
                @click="if (!isClicked) { isClicked = true; $refs.fileInput.click(); setTimeout(() => isClicked = false, 100); }"
                :class="{ 'border-indigo-500': isOver, 'border-gray-300': !isOver }">

                <label for="dropzone-file"
                    class="mx-auto cursor-pointer flex flex-col items-center 
                  rounded-xl border-2 border-dashed bg-white 
                  dark:bg-gray-800 p-6 text-center"
                    :class="{ 'border-indigo-500': isOver, 'border-gray-300': !isOver }">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>

                    <h2 class="mt-4 text-xl font-medium text-gray-700 dark:text-white tracking-wide">
                        Payment File
                    </h2>

                    <p class="mt-2 text-gray-500 dark:text-gray-300 tracking-wide">
                        Upload or drag & drop your file: SVG, PNG, JPG, or GIF.
                    </p>

                    <template x-if="file">
                        <div class="mt-2 text-green-600 font-medium">
                            <p>File Name: <span x-text="file.name"></span></p>
                            <p>File Size: <span x-text="file.size"></span></p>
                            <p>File Type: <span x-text="file.type"></span></p>
                        </div>
                    </template>

                    <input id="avatar" name="avatar" type="file" hidden x-ref="fileInput"
                        @change="handleFile($refs.fileInput.files[0])" />
                </label>

            </main>

            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>                            

        <div>
            <x-input-label for="username" :value="__('Name')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
