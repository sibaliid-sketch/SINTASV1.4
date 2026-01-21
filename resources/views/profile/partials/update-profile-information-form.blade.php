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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Avatar Upload Section -->
        <div>
            <x-input-label :value="__('Profile Photo')" />
            <div class="mt-2 flex items-center space-x-6">
                <div class="relative">
                    @if($user->avatar)
                        <img src="{{ $user->avatar_url }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg">
                    @else
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                            <span class="text-2xl font-bold text-white">{{ $user->initials }}</span>
                        </div>
                    @endif
                    <button type="button" id="change-avatar-btn" class="absolute bottom-0 right-0 bg-blue-600 text-white p-1 rounded-full hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Upload a new profile photo. JPG, PNG or GIF (max 5MB)</p>
                    <input type="file" id="avatar-input" accept="image/*" class="hidden">
                    <button type="button" id="upload-avatar-btn" class="mt-2 text-blue-600 hover:text-blue-800 text-sm font-medium">Upload new photo</button>
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
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

    <!-- Avatar Crop Modal -->
    <div id="avatar-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-10/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Crop Profile Photo</h3>
                    <button type="button" id="close-modal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <img id="cropper-image" src="" alt="Image to crop" class="max-w-full">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancel-crop" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="button" id="save-crop" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cropper.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    let cropper;
    const modal = document.getElementById('avatar-modal');
    const image = document.getElementById('cropper-image');
    const uploadBtn = document.getElementById('upload-avatar-btn');
    const changeBtn = document.getElementById('change-avatar-btn');
    const fileInput = document.getElementById('avatar-input');
    const closeModal = document.getElementById('close-modal');
    const cancelCrop = document.getElementById('cancel-crop');
    const saveCrop = document.getElementById('save-crop');

    function openModal() {
        modal.classList.remove('hidden');
    }

    function closeModalFunc() {
        modal.classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    function handleFileSelect(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                openModal();
                setTimeout(() => {
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                        responsive: true,
                        restore: false,
                        checkCrossOrigin: false,
                        checkOrientation: false,
                        modal: true,
                        guides: true,
                        center: true,
                        highlight: false,
                        background: false,
                        autoCropArea: 0.8,
                        movable: true,
                        rotatable: true,
                        scalable: true,
                        zoomable: true,
                        zoomOnTouch: true,
                        zoomOnWheel: true,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: true,
                    });
                }, 100);
            };
            reader.readAsDataURL(file);
        }
    }

    uploadBtn.addEventListener('click', () => fileInput.click());
    changeBtn.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', handleFileSelect);
    closeModal.addEventListener('click', () => {
        closeModalFunc();
        fileInput.value = '';
    });
    cancelCrop.addEventListener('click', () => {
        closeModalFunc();
        fileInput.value = '';
    });

    saveCrop.addEventListener('click', function() {
        if (cropper) {
            cropper.getCroppedCanvas({
                width: 300,
                height: 300,
                fillColor: '#fff',
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            }).toBlob(function(blob) {
                const formData = new FormData();
                formData.append('avatar', blob, 'avatar.jpg');
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch('/profile/avatar', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error uploading avatar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error uploading avatar');
                });
            }, 'image/jpeg', 0.9);
        }
        closeModalFunc();
        // Reset file input to allow re-uploading the same file
        fileInput.value = '';
    });
});
</script>
