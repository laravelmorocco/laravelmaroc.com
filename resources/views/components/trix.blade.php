@props([
    'label' => '',
    'name' => '',
])

@php 
    $id = $name ? str_replace(' ', '', $name) : uniqid();
@endphp

<div>
    @if ($label) 
        <label for="{{ $id }}" class="block font-semibold mb-1">{{ $label }}</label>
    @endif

    <div x-data="{ value: @entangle($attributes->wire('model')) }" wire:ignore>
        <trix-editor {{ $attributes }} 
        x-on:trix-change="value = $event.target.value"></trix-editor>
    </div>

    @error($name)
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>

{{-- 
@push('scripts')
<script>
    var trixEditor = document.querySelector("trix-editor");
    var mimeTypes = ["image/png", "image/jpeg", "image/jpg"];

    addEventListener("trix-file-accept", function(event) {
        if (!mimeTypes.includes(event.file.type)) {
            // file type not allowed, prevent default upload
            return event.preventDefault();
        }
    });

    addEventListener("trix-attachment-add", function(event) {
        uploadTrixImage(event.attachment);
    });

    function uploadTrixImage(attachment) {
        // upload with livewire
        @this.upload(
            'photos',
            attachment.file,
            function(uploadedURL) {

                // We need to create a custom event.
                // This event will create a pause in thread execution until we get the Response URL from the Trix Component @completeUpload
                const trixUploadCompletedEvent = `trix-upload-completed:${btoa(uploadedURL)}`;
                const trixUploadCompletedListener = function(event) {
                    attachment.setAttributes(event.detail);
                    window.removeEventListener(trixUploadCompletedEvent, trixUploadCompletedListener);
                }

                window.addEventListener(trixUploadCompletedEvent, trixUploadCompletedListener);

                // call the Trix Component @completeUpload below
                @this.call('completeUpload', uploadedURL, trixUploadCompletedEvent);
            },
            function() {},
            function(event) {
                attachment.setUploadProgress(event.detail.progress);
            },
        )
        // complete the upload and get the actual file URL
    }
</script>
@endpush --}}