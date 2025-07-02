<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class Gallery extends Component
{
    use WithFileUploads;

    public $image_upload;
    public $images = [];


    public function mount()
    {
        $this->loadImages();
    }

    public function loadImages()
    {
        $this->images = collect(Storage::disk('public')->files('images'))
            ->filter(fn($file) => in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']));
    }

    public function store()
    {
        try {
            $this->validate([
                'image_upload' => 'image|max:2048',
            ]);

            $this->image_upload->store('images', 'public');
            $this->reset('image_upload');

            $this->loadImages(); // 💡 Panggil lagi untuk refresh list
            session()->flash('message', 'Gambar berhasil di-upload!');
        } catch (\Throwable $e) {
            \Log::error('Upload error: ' . $e->getMessage());
            session()->flash('error', $e->getMessage());
        }
    }

    public function delete($path)
    {
        try {
            Storage::disk('public')->delete($path); // ✅ gunakan disk 'public'
            $this->loadImages(); // Refresh daftar gambar
            session()->flash('message', 'Gambar berhasil dihapus!');
        } catch (\Throwable $e) {
            \Log::error('Gagal hapus gambar: ' . $e->getMessage());
            session()->flash('error', 'Gagal menghapus gambar.');
        }
    }


    public function render()
    {
        return view('livewire.admin.gallery.gallery');
    }
}
