@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-[#0f172a]">Profil Saya</h2>
        <p class="text-gray-500 mt-2 text-sm">Kelola informasi data diri dan pengaturan keamanan akun Anda.</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        
        <div class="xl:col-span-1">
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm text-center">
                <div class="w-32 h-32 mx-auto rounded-full bg-orange-50 flex items-center justify-center text-orange-600 mb-4 border-4 border-white shadow-md relative group cursor-pointer">
                    <i class="fa-solid fa-user text-4xl"></i>
                    <div class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fa-solid fa-camera text-white text-xl"></i>
                    </div>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900">Agus Prakoso</h3>
                <p class="text-sm text-gray-500 font-medium mt-1">Pelanggan Setia</p>

                <div class="mt-6 pt-6 border-t border-gray-100 text-left space-y-4">
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Lahir</span>
                        <span class="text-sm font-medium text-gray-900">12 Mei 1990</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">No. WhatsApp</span>
                        <span class="text-sm font-medium text-gray-900">0856-7890-1234</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</span>
                        <span class="text-sm font-medium text-gray-900">agus.prakoso@email.com</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="xl:col-span-2 space-y-6">
            
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" value="Agus Prakoso" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#855333] focus:border-[#855333] outline-none transition-all text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" value="1990-05-12" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#855333] focus:border-[#855333] outline-none transition-all text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                                <input type="text" value="0856-7890-1234" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#855333] focus:border-[#855333] outline-none transition-all text-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                                <input type="email" value="agus.prakoso@email.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#855333] focus:border-[#855333] outline-none transition-all text-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman Utama</label>
                                <textarea rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#855333] focus:border-[#855333] outline-none transition-all text-sm">Jl. Mawar No. 12, RT 03 / RW 05, Kelurahan Suka Maju</textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" class="px-6 py-2.5 bg-[#452A1B] text-white text-sm font-bold rounded-lg hover:bg-[#5C3925] focus:ring-4 focus:ring-[#BA8E60]/30 transition-colors shadow-sm">
                                Simpan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">Ubah Kata Sandi</h3>
                </div>
                <div class="p-6">
                    <form>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Saat Ini</label>
                                <input type="password" placeholder="••••••••" class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#855333] focus:border-[#855333] outline-none transition-all text-sm">
                            </div>
                            <div class="border-t border-gray-100 pt-5 mt-5 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Baru</label>
                                    <input type="password" placeholder="Masukkan sandi baru" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#855333] focus:border-[#855333] outline-none transition-all text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Sandi Baru</label>
                                    <input type="password" placeholder="Ulangi sandi baru" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#855333] focus:border-[#855333] outline-none transition-all text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" class="px-6 py-2.5 bg-gray-800 text-white text-sm font-bold rounded-lg hover:bg-gray-900 focus:ring-4 focus:ring-gray-200 transition-colors shadow-sm">
                                Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection