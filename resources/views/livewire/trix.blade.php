<div wire:ignore>
    <input id="trix-content-{{ $this->id }}" type="hidden" value="{{ $value }}" name="content">
    <trix-editor input="trix-content-{{ $this->id }}"></trix-editor>
</div>

@push('scripts')
<script>
    document.addEventListener("livewire:load", function () {
        const input = document.querySelector('#trix-content-{{ $this->id }}');
        const editor = document.querySelector('trix-editor[input="trix-content-{{ $this->id }}"]');

        if (input && editor) {
            editor.addEventListener("trix-change", function () {
                input.dispatchEvent(new Event('input', { bubbles: true }));
            });
        }
    });
</script>
@endpush
