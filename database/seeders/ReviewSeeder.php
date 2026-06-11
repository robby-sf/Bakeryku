<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $hasAdminResponse = Schema::hasColumn('reviews', 'admin_response');
        $hasReviewedAt = Schema::hasColumn('reviews', 'reviewed_at');

        $reviews = [
            // === Produk Lama (14) ===
            ['nadia@example.com', 'Roti Tawar', 5, 'Roti tawarnya lembut banget, cocok buat sandwich pagi.', 'published', 'Terima kasih Nadia, senang jadi pilihan sarapan keluarga!', now()->subDays(20)],
            ['raka@example.com', 'Roti Tawar', 4, 'Teksturnya bagus, pori-porinya halus. Recommended!', 'published', null, now()->subDays(18)],
            ['sinta@example.com', 'Roti Abon', 5, 'Abon sapinya banyak banget, nggak pelit. Enak!', 'published', 'Terima kasih Sinta! Kami selalu pakai abon pilihan.', now()->subDays(17)],
            ['nadia@example.com', 'Roti Abon', 4, 'Rotinya empuk dan abonnya gurih. Suka!', 'published', null, now()->subDays(15)],
            ['raka@example.com', 'Roti Pisang Keju', 5, 'Pisangnya matang pas, kejunya terasa. Kombinasi juara!', 'published', 'Senang banget kamu suka kombinasinya!', now()->subDays(16)],
            ['sinta@example.com', 'Roti Pisang Coklat', 4, 'Coklatnya lumer, pisangnya manis alami. Enak buat camilan.', 'published', null, now()->subDays(14)],
            ['nadia@example.com', 'Roti Coklat Keju', 5, 'Perpaduan coklat dan keju yang pas banget, nggak bikin eneg.', 'published', 'Terima kasih! Ini memang best seller kami.', now()->subDays(13)],
            ['raka@example.com', 'Toast', 4, 'Simple tapi enak, toastnya renyah pas.', 'published', null, now()->subDays(12)],
            ['sinta@example.com', 'Toast', 3, 'Rasanya standar, tapi harganya worth it sih.', 'published', null, now()->subDays(11)],
            ['nadia@example.com', 'Donat Meses', 5, 'Donatnya empuk bukan kopong, mesesinya banyak. Anak-anak suka!', 'published', 'Senang bisa jadi favorit keluarga!', now()->subDays(10)],
            ['raka@example.com', 'Donat Keju', 4, 'Kejunya tebal dan gurih, donatnya lembut. Mantap.', 'published', null, now()->subDays(9)],
            ['sinta@example.com', 'Roll Cake', 5, 'Bolu gulungnya lembut banget, krimnya pas nggak bikin enek. Worth the price!', 'published', 'Terima kasih Sinta! Roll Cake ini favorit banyak pelanggan.', now()->subDays(8)],
            ['nadia@example.com', 'Roti Sosis', 4, 'Sosisnya juicy, rotinya empuk. Cocok buat bekal anak.', 'published', null, now()->subDays(7)],
            ['raka@example.com', 'Roti Choco Boat', 5, 'Bentuknya unik, coklatnya melimpah. Seru!', 'published', 'Terima kasih! Desain kapalnya memang jadi ciri khas kami.', now()->subDays(6)],
            ['sinta@example.com', 'Roti Cheese Boat', 4, 'Kejunya lumer dan gurih, porsinya pas.', 'published', null, now()->subDays(5)],
            ['nadia@example.com', 'Roti Pizza', 5, 'Rasanya mirip pizza asli! Topping saus tomat dan kejunya mantap.', 'published', 'Terima kasih Nadia! Mini pizza ini memang andalan.', now()->subDays(4)],
            ['raka@example.com', 'Roti Tawar Pandan', 4, 'Aroma pandannya harum, warnanya cantik hijau alami.', 'published', null, now()->subDays(3)],
            ['sinta@example.com', 'Roti Tawar Pandan', 5, 'Pandan-nya kerasa banget, lembut, wangi. Favorit sekeluarga!', 'published', 'Senang sekali bisa jadi favorit keluarga!', now()->subDays(2)],

            // === Produk Baru (23) ===
            ['raka@example.com', 'Roti Kopi', 5, 'Toppingnya kriuk dan aroma kopinya harum. Cocok buat pecinta kopi!', 'published', 'Terima kasih Raka! Topping kopi ini resep spesial kami.', now()->subDays(15)],
            ['nadia@example.com', 'Roti Kopi', 4, 'Unik, lapisan luarnya renyah kopi. Beda dari roti biasa.', 'published', null, now()->subDays(12)],
            ['sinta@example.com', 'Blueberry Cup', 4, 'Selai blueberry-nya segar, manis asamnya pas.', 'published', null, now()->subDays(14)],
            ['nadia@example.com', 'Blueberry Cup', 5, 'Kombinasi blueberry dan keju-nya unik. Nagih!', 'published', 'Terima kasih! Resep rahasia kami memang kombinasi itu.', now()->subDays(10)],
            ['raka@example.com', 'Chiffon Cake Big', 5, 'Teksturnya ringan banget kayak awan, nggak bikin berat.', 'published', 'Senang kamu suka! Chiffon kami pakai resep premium.', now()->subDays(13)],
            ['sinta@example.com', 'Chiffon Cake Big', 4, 'Enak buat arisan, ukurannya besar dan cukup buat banyak orang.', 'published', null, now()->subDays(9)],
            ['nadia@example.com', 'Roti Kelapa', 5, 'Isian kelapanya padat dan manis, rotinya empuk. Klasik tapi enak!', 'published', 'Roti kelapa memang nggak pernah gagal ya!', now()->subDays(11)],
            ['raka@example.com', 'Roti Kelapa', 4, 'Nostalgia roti jaman dulu, kelapanya banyak.', 'published', null, now()->subDays(8)],
            ['sinta@example.com', 'Blueberry Cheese', 5, 'Keju dan blueberry-nya perfect match! Seger dan gurih.', 'published', 'Terima kasih Sinta, glad you love it!', now()->subDays(7)],
            ['nadia@example.com', 'Roti Kering (Bagelan Manis)', 4, 'Renyahnya tahan lama, cocok buat ngemil sambil ngeteh.', 'published', null, now()->subDays(10)],
            ['raka@example.com', 'Roti Kering (Bagelan Manis)', 5, 'Olesan mentega gulanya pas, kriuk-kriuk bikin nagih.', 'published', 'Bagelan manis memang teman teh terbaik!', now()->subDays(6)],
            ['sinta@example.com', 'Roti Isi Keju', 4, 'Isian kejunya banyak dan gurih, harganya murah pula.', 'published', null, now()->subDays(9)],
            ['nadia@example.com', 'Roti Isi Keju', 5, 'Keju di dalamnya melimpah! Worth it banget Rp3.500.', 'published', 'Terima kasih! Kami selalu kasih porsi isian yang royal.', now()->subDays(5)],
            ['raka@example.com', 'Roti Vla Vanilla', 5, 'Vla vanilla-nya creamy dan dingin, rotinya lembut. Enak banget!', 'published', 'Senang kamu suka! Vla kami buat fresh setiap hari.', now()->subDays(8)],
            ['sinta@example.com', 'Roti Vla Vanilla', 4, 'Manisnya pas, vla-nya lembut. Cocok buat dessert.', 'published', null, now()->subDays(4)],
            ['nadia@example.com', 'Roti Semir Original', 4, 'Buttercream-nya ringan, nggak nempel di langit-langit. Suka!', 'published', null, now()->subDays(7)],
            ['raka@example.com', 'Roti Semir Meses', 5, 'Meses coklat plus buttercream = kombinasi sempurna.', 'published', 'Terima kasih Raka! Resep buttercream kami memang spesial.', now()->subDays(6)],
            ['sinta@example.com', 'Roti Semir Moca', 4, 'Aroma mokanya kuat dan wangi, buttercream-nya enak.', 'published', null, now()->subDays(5)],
            ['nadia@example.com', 'Roti Semir Moca Meses', 5, 'Full topping! Meses + moca + buttercream, lengkap banget.', 'published', 'Best combo memang! Terima kasih Nadia.', now()->subDays(3)],
            ['raka@example.com', 'Roti Isi Coklat', 4, 'Coklatnya lumer di dalam, rotinya empuk. Pas buat camilan.', 'published', null, now()->subDays(4)],
            ['sinta@example.com', 'Roti Isi Coklat', 5, 'Isian coklatnya banyak dan nggak pelit. Enak!', 'published', 'Terima kasih! Kami pakai coklat berkualitas.', now()->subDays(2)],
            ['nadia@example.com', 'Chiffon Cake Small', 4, 'Ukurannya pas buat 2-3 orang, teksturnya tetap lembut.', 'published', null, now()->subDays(6)],
            ['raka@example.com', 'Chiffon Cake Small', 5, 'Ringan, lembut, nggak bikin eneg. Cocok buat hadiah!', 'published', 'Banyak pelanggan beli untuk gift juga!', now()->subDays(3)],
            ['sinta@example.com', 'Kerumpul Polos', 4, 'Rotinya empuk, gampang disobek-sobek. Enak buat sarapan.', 'published', null, now()->subDays(5)],
            ['nadia@example.com', 'Kerumpul Kombinasi Ekonomis', 5, 'Isinya macam-macam, harga ekonomis tapi rasa premium!', 'published', 'Terima kasih Nadia! Varian ekonomis memang best value.', now()->subDays(4)],
            ['raka@example.com', 'Kerumpul Kombinasi Premium', 5, 'Menteganya lebih terasa dibanding yang ekonomis. Lembut banget.', 'published', null, now()->subDays(3)],
            ['sinta@example.com', 'Kerumpul Coklat Ekonomis', 4, 'Coklatnya enak, harganya terjangkau. Value for money!', 'published', null, now()->subDays(4)],
            ['nadia@example.com', 'Kerumpul Coklat Premium', 5, 'Premium memang beda! Menteganya lebih kaya, coklatnya lebih tebal.', 'published', 'Betul, varian premium pakai mentega lebih banyak!', now()->subDays(2)],
            ['raka@example.com', 'Roti Sobek Coklat', 5, 'Sobek-sobek bareng keluarga, coklatnya di setiap bagian. Seru!', 'published', 'Memang cocok untuk sharing bersama keluarga!', now()->subDays(3)],
            ['sinta@example.com', 'Roti Sobek Coklat', 4, 'Porsinya besar, cocok buat sarapan sekeluarga.', 'published', null, now()->subDays(1)],
            ['nadia@example.com', 'Roti Sobek Coklat Keju', 5, 'Coklat + keju dalam satu roti sobek, kombo terbaik!', 'published', 'Kombinasi favorit pelanggan kami!', now()->subDays(2)],
            ['raka@example.com', 'Roti Sobek Coklat Keju', 4, 'Gurih dan manis-nya seimbang, porsinya royal.', 'published', null, now()->subDays(1)],
            ['sinta@example.com', 'Chiffon Slice', 4, 'Praktis bisa beli per slice, teksturnya tetap lembut.', 'published', null, now()->subDays(3)],
            ['nadia@example.com', 'Chiffon Slice', 5, 'Murah meriah cuma Rp2.500 tapi rasanya premium. Sering beli!', 'published', 'Terima kasih sudah jadi pelanggan setia!', now()->subDays(1)],
            ['raka@example.com', 'Kue Mandarin', 5, 'Kue mandarinnya premium banget, cocok buat oleh-oleh.', 'published', 'Terima kasih! Kue Mandarin kami memang best seller untuk oleh-oleh.', now()->subDays(2)],
            ['sinta@example.com', 'Kue Mandarin', 4, 'Rasanya otentik, cocok buat acara keluarga. Pasti pesan lagi!', 'published', null, now()->subDays(1)],
        ];

        foreach ($reviews as [$email, $productName, $rating, $comment, $status, $adminResponse, $reviewedAt]) {
            $user = User::where('email', $email)->first();
            $product = Product::where('name', $productName)->first();

            if (! $user || ! $product) {
                continue;
            }

            $values = [
                'rating' => $rating,
                'status' => $status,
            ];

            if ($hasAdminResponse) {
                $values['admin_response'] = $adminResponse;
            }

            if ($hasReviewedAt) {
                $values['reviewed_at'] = $reviewedAt;
            }

            $review = Review::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'comment' => $comment,
                ],
                $values
            );

            $review->created_at = $reviewedAt;
            $review->updated_at = $reviewedAt;
            $review->save();
        }
    }
}
