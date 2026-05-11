{{-- resources/views/Admin/Product/edit.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Edit Menu - ' . $product->name . ' | Bakeryku')

@section('header_title', 'Edit Menu')
@section('header_subtitle', 'Ubah detail informasi produk di katalog.')

@section('content')

    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#855333] hover:text-[#452A1B] transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Menu
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-[#EAE2D6]">
            <h2 class="font-heading text-xl font-bold text-[#452A1B] mb-6 border-b border-[#EAE2D6] pb-4">Informasi Produk</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-bold text-[#855333] mb-2">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" required placeholder="Cth: Classic Butter Croissant" value="{{ old('name', $product->name) }}"
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400">
                </div>

                <div>
                    <label for="category" class="block text-sm font-bold text-[#855333] mb-2">Kategori <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="category" name="category" required
                            class="w-full appearance-none bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors cursor-pointer">
                            <option value="" disabled>Pilih Kategori...</option>
                            <option value="Pastry" {{ old('category', $product->category) === 'Pastry' ? 'selected' : '' }}>Pastry</option>
                            <option value="Roti Manis" {{ old('category', $product->category) === 'Roti Manis' ? 'selected' : '' }}>Roti Manis</option>
                            <option value="Roti Asin" {{ old('category', $product->category) === 'Roti Asin' ? 'selected' : '' }}>Roti Asin</option>
                            <option value="Cakes" {{ old('category', $product->category) === 'Cakes' ? 'selected' : '' }}>Cakes</option>
                            <option value="Chocolate" {{ old('category', $product->category) === 'Chocolate' ? 'selected' : '' }}>Chocolate</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="price" class="block text-sm font-bold text-[#855333] mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold text-sm">Rp</span>
                        </div>
                        <input type="number" id="price" name="price" required placeholder="0" min="0" value="{{ old('price', $product->price) }}"
                            class="w-full pl-10 pr-4 py-3 bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl text-sm text-[#452A1B] font-bold focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400">
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-bold text-[#855333] mb-2">Status Ketersediaan</label>
                    <div class="flex gap-4 mt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="Tersedia" {{ old('status', $product->status) === 'Tersedia' ? 'checked' : '' }} class="w-4 h-4 text-[#855333] focus:ring-[#855333] border-gray-300">
                            <span class="text-sm font-medium text-[#452A1B]">Tersedia</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="Habis" {{ old('status', $product->status) === 'Habis' ? 'checked' : '' }} class="w-4 h-4 text-[#855333] focus:ring-[#855333] border-gray-300">
                            <span class="text-sm font-medium text-gray-500">Habis</span>
                        </label>
                    </div>
                </div>

                <div class="md:col-span-2 mt-2">
                    <label for="description" class="block text-sm font-bold text-[#855333] mb-2">Deskripsi Produk</label>
                    <textarea id="description" name="description" rows="4" placeholder="Tuliskan komposisi, rasa, atau deskripsi menarik tentang produk ini..."
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="md:col-span-2 mt-2">
                    <label class="block text-sm font-bold text-[#855333] mb-2">Gambar Produk</label>
                    
                    <div class="w-full border-2 border-dashed border-[#BA8E60] bg-[#FAF8F5] hover:bg-[#EAE2D6]/50 transition-colors rounded-2xl p-8 flex flex-col justify-center items-center cursor-pointer relative" id="dropzone">
                        
                        <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        
                        <div id="upload-placeholder" class="text-center {{ $product->image ? 'hidden' : '' }}">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm border border-[#EAE2D6] text-[#855333] text-2xl">
                                <i class="fa-regular fa-image"></i>
                            </div>
                            <p class="text-sm font-bold text-[#452A1B]">Klik atau Drag & Drop gambar ke sini</p>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                        </div>

                        <div id="image-preview-container" class="{{ $product->image ? 'flex' : 'hidden' }} flex-col items-center w-full z-20">
                            @if($product->image)
                                <img id="image-preview" src="{{ Storage::url($product->image) }}" alt="Preview" class="w-32 h-32 object-cover rounded-xl shadow-sm border border-gray-200 mb-3">
                                <p id="file-name" class="text-xs font-bold text-[#855333] truncate max-w-[200px] mb-2">{{ basename($product->image) }}</p>
                            @else
                                <img id="image-preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-xl shadow-sm border border-gray-200 mb-3">
                                <p id="file-name" class="text-xs font-bold text-[#855333] truncate max-w-[200px] mb-2"></p>
                            @endif
                            <button type="button" id="remove-image" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-lg transition relative z-30">
                                Hapus Gambar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label for="image_2" class="block text-sm font-bold text-[#855333] mb-2">Gambar Produk 2 <span class="text-gray-400 text-xs">(Opsional)</span></label>
                    <input type="file" name="image_2" id="image_2" accept="image/*" class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors" />
                    <p class="text-xs text-gray-500 mt-2">Opsional. Akan muncul sebagai gambar galeri tambahan. Gambar utama tetap diambil dari kolom Gambar Produk pertama.</p>
                    @if($product->image_2)
                        <p class="text-xs text-gray-500 mt-2">Gambar saat ini: {{ basename($product->image_2) }}</p>
                    @endif
                </div>

                <div class="md:col-span-2 mt-4">
                    <label for="image_3" class="block text-sm font-bold text-[#855333] mb-2">Gambar Produk 3 <span class="text-gray-400 text-xs">(Opsional)</span></label>
                    <input type="file" name="image_3" id="image_3" accept="image/*" class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors" />
                    <p class="text-xs text-gray-500 mt-2">Opsional. Akan muncul sebagai gambar galeri tambahan. Gambar utama tetap diambil dari kolom Gambar Produk pertama.</p>
                    @if($product->image_3)
                        <p class="text-xs text-gray-500 mt-2">Gambar saat ini: {{ basename($product->image_3) }}</p>
                    @endif
                </div>

            </div>
        </div>

        <div class="flex justify-end gap-4 mt-6">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-[#855333] hover:bg-[#EAE2D6] transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-[#452A1B] hover:bg-[#5C3925] text-white px-8 py-3 rounded-xl text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                <i class="fa-regular fa-floppy-disk"></i> Perbarui Menu
            </button>
        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const placeholder = document.getElementById('upload-placeholder');
            const previewContainer = document.getElementById('image-preview-container');
            const imagePreview = document.getElementById('image-preview');
            const fileNameDisplay = document.getElementById('file-name');
            const removeBtn = document.getElementById('remove-image');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        fileNameDisplay.textContent = file.name;
                        
                        placeholder.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        previewContainer.classList.add('flex');
                    }
                    reader.readAsDataURL(file);
                }
            });

            removeBtn.addEventListener('click', function(e) {
                e.preventDefault(); 
                imageInput.value = ''; 
                
                placeholder.classList.remove('hidden');
                previewContainer.classList.add('hidden');
                previewContainer.classList.remove('flex');
            });
        });
    </script>

@endsection
