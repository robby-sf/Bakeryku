{{-- resources/views/Admin/Promo/create.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Buat Promo Baru | Slice Bread Bakery')

@section('header_title', 'Buat Promo Baru')
@section('header_subtitle', 'Atur penawaran, diskon, atau paket bundel untuk pelanggan.')

@section('content')

    <div class="mb-6">
        <a href="{{ route('admin.promos') ?? '#' }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#855333] hover:text-[#452A1B] transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Promo
        </a>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        
        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-[#EAE2D6]">
            <h2 class="font-heading text-xl font-bold text-[#452A1B] mb-6 border-b border-[#EAE2D6] pb-4">Detail Promosi</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-[#855333] mb-2">Nama Promo / Kampanye <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" required placeholder="Cth: Ramadan Flash Sale / Promo Beli 1 Gratis 1"
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400">
                </div>

                <div>
                    <label for="type" class="block text-sm font-bold text-[#855333] mb-2">Tipe Promo <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="type" name="type" required
                            class="w-full appearance-none bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors cursor-pointer">
                            <option value="" disabled selected>Pilih Tipe...</option>
                            <option value="discount_percent">Diskon Persentase (%)</option>
                            <option value="discount_nominal">Potongan Harga (Rp)</option>
                            <option value="bundle">Paket Bundel</option>
                            <option value="buy_1_get_1">Buy 1 Get 1 (Beli 1 Gratis 1)</option>
                            <option value="buy_2_get_1">Buy 2 Get 1 (Beli 2 Gratis 1)</option>
                            <option value="free_shipping">Gratis Ongkir</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="value" class="block text-sm font-bold text-[#855333] mb-2">Nilai Potongan <span class="text-gray-400 font-normal">(Abaikan jika B1G1)</span></label>
                    <input type="number" id="value" name="value" placeholder="Cth: 20 (untuk 20%)" min="0"
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-bold focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400">
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-bold text-[#855333] mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                    <input type="date" id="start_date" name="start_date" required
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors cursor-pointer">
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-bold text-[#855333] mb-2">Tanggal Berakhir <span class="text-red-500">*</span></label>
                    <input type="date" id="end_date" name="end_date" required
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors cursor-pointer">
                </div>

                <div class="md:col-span-2 mt-2">
                    <label for="description" class="block text-sm font-bold text-[#855333] mb-2">Deskripsi Lengkap & Syarat Ketentuan</label>
                    <textarea id="description" name="description" rows="3" placeholder="Jelaskan syarat dan ketentuan promo ini (misal: Berlaku khusus untuk varian Roti Manis)..."
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400"></textarea>
                </div>

                <div class="md:col-span-2 mt-2">
                    <label class="block text-sm font-bold text-[#855333] mb-2">Gambar / Banner Promo <span class="text-red-500">*</span></label>
                    
                    <div class="w-full border-2 border-dashed border-[#BA8E60] bg-[#FAF8F5] hover:bg-[#EAE2D6]/50 transition-colors rounded-2xl p-8 flex flex-col justify-center items-center cursor-pointer relative" id="dropzone">
                        
                        <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        
                        <div id="upload-placeholder" class="text-center">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm border border-[#EAE2D6] text-[#855333] text-2xl">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <p class="text-sm font-bold text-[#452A1B]">Upload Banner Promo di sini</p>
                            <p class="text-xs text-gray-500 mt-1">Gunakan resolusi landscape (16:9) agar maksimal</p>
                        </div>

                        <div id="image-preview-container" class="hidden flex-col items-center w-full z-20">
                            <img id="image-preview" src="" alt="Preview Banner" class="w-full max-w-sm h-40 object-cover rounded-xl shadow-sm border border-gray-200 mb-3">
                            <p id="file-name" class="text-xs font-bold text-[#855333] truncate max-w-[200px] mb-2"></p>
                            <button type="button" id="remove-image" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-lg transition relative z-30">
                                Hapus Gambar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex justify-end gap-4 mt-6">
            <a href="{{ route('admin.promos') ?? '#' }}" class="px-6 py-3 rounded-xl text-sm font-bold text-[#855333] hover:bg-[#EAE2D6] transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-[#452A1B] hover:bg-[#5C3925] text-white px-8 py-3 rounded-xl text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                <i class="fa-solid fa-rocket"></i> Terbitkan Promo
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