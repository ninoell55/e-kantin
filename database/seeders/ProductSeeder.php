<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $shop1 = Shop::where('name', 'Warung Lestari')->first();
        $shop2 = Shop::where('name', 'Dapur SMK')->first();

        $makanan = Category::where('name', 'Makanan')->first();
        $minuman = Category::where('name', 'Minuman')->first();
        $snack   = Category::where('name', 'Snack')->first();
        $paket   = Category::where('name', 'Paket Hemat')->first();

        // ── PRODUK WARUNG LESTARI (shop1) ─────────────────────────────
        $products1 = [

            // MAKANAN
            [
                'name'        => 'Nasi Goreng',
                'slug'        => 'nasi-goreng',
                'description' => 'Nasi goreng spesial dengan telur, ayam, dan sayuran segar.',
                'price'       => 17000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/NasiGoreng.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Ayam Geprek',
                'slug'        => 'ayam-geprek',
                'description' => 'Ayam geprek crispy dengan sambal pedas khas.',
                'price'       => 18000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/AyamGeprek.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Mie Ayam Ceker Bakso',
                'slug'        => 'mie-ayam-ceker-bakso',
                'description' => 'Mie ayam dengan ceker empuk dan bakso kenyal.',
                'price'       => 16000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/MieAyamCekerBakso.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Bakso Bakar',
                'slug'        => 'bakso-bakar',
                'description' => 'Bakso bakar bumbu kecap manis dengan tusukan.',
                'price'       => 8000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/BaksoBakar.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Dimsum Ayam',
                'slug'        => 'dimsum-ayam',
                'description' => 'Dimsum ayam kukus dengan saus tiram.',
                'price'       => 12000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/DimsumAyam.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Risoles Ayam',
                'slug'        => 'risoles-ayam',
                'description' => 'Risoles isi ayam dan sayuran, digoreng garing.',
                'price'       => 5000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/RisolesAyam.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Roti Sosis',
                'slug'        => 'roti-sosis',
                'description' => 'Roti empuk dengan isian sosis dan saus.',
                'price'       => 7000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/RotiSosis.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Sosis Telur',
                'slug'        => 'sosis-telur',
                'description' => 'Sosis dimasak dengan telur, cocok untuk sarapan.',
                'price'       => 9000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/SosisTelur.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Sosis Bakar Mayonais',
                'slug'        => 'sosis-bakar-mayonais',
                'description' => 'Sosis bakar gurih dengan taburan mayonais.',
                'price'       => 10000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/SosisBakarMayonais.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Nugget Ayam',
                'slug'        => 'nugget-ayam',
                'description' => 'Nugget ayam crispy siap makan.',
                'price'       => 10000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/NuggetAyam.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Takoyaki',
                'slug'        => 'takoyaki',
                'description' => 'Takoyaki bola gurita khas Jepang dengan saus okonomiyaki.',
                'price'       => 13000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/Takoyaki.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Sushi Gulung',
                'slug'        => 'sushi-gulung',
                'description' => 'Sushi gulung nori dengan isian sayuran segar.',
                'price'       => 15000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/SushiGulung.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Chicken Cordon Bleu',
                'slug'        => 'chicken-cordon-bleu',
                'description' => 'Ayam isi keju dan ham dibalut tepung renyah.',
                'price'       => 20000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/ChickenCordonBleu.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Chikuwa',
                'slug'        => 'chikuwa',
                'description' => 'Chikuwa ikan khas Jepang yang kenyal dan gurih.',
                'price'       => 8000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/Chikuwa.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Sandwich Croissant',
                'slug'        => 'sandwich-croissant',
                'description' => 'Croissant lapis dengan sayuran, keju, dan saus.',
                'price'       => 18000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/Sandwich Croissant.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Pizza Pepperoni',
                'slug'        => 'pizza-pepperoni',
                'description' => 'Pizza mini topping pepperoni dengan saus tomat.',
                'price'       => 22000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/PizzaPepperoni .jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Martabak Manis Mini',
                'slug'        => 'martabak-manis-mini',
                'description' => 'Martabak manis mini dengan isian coklat dan keju.',
                'price'       => 12000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/MartabakManisMini.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Pisang Goreng Coklat',
                'slug'        => 'pisang-goreng-coklat',
                'description' => 'Pisang goreng crispy dengan topping coklat leleh.',
                'price'       => 8000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/PisangGorengCoklat.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Kentang Goreng',
                'slug'        => 'kentang-goreng',
                'description' => 'Kentang goreng renyah dengan pilihan saus sambal.',
                'price'       => 10000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/KentangGoreng.jpg',
                'is_available'=> true,
            ],

            // MINUMAN
            [
                'name'        => 'Es Teh Manis',
                'slug'        => 'es-teh-manis',
                'description' => 'Es teh manis segar untuk menemani istirahat.',
                'price'       => 5000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/EsTehManis.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Es Tea Jus',
                'slug'        => 'es-tea-jus',
                'description' => 'Perpaduan teh segar dengan sari buah.',
                'price'       => 8000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/EsTeajus.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Es Cappuccino Cincau',
                'slug'        => 'es-cappuccino-cincau',
                'description' => 'Cappuccino dingin dengan cincau hitam segar.',
                'price'       => 10000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/EsCappuccinoCincau.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Iced Mocha',
                'slug'        => 'iced-mocha',
                'description' => 'Kopi mocha dingin yang creamy dan manis.',
                'price'       => 12000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/Iced Mocha.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Jus Alpukat',
                'slug'        => 'jus-alpukat',
                'description' => 'Jus alpukat segar dengan susu dan sirup coklat.',
                'price'       => 13000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/JusAlpukat.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Bubble Tea Gula Merah',
                'slug'        => 'bubble-tea-gula-merah',
                'description' => 'Bubble tea dengan sirup gula merah dan pearl tapioka.',
                'price'       => 15000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/BubbleTeaGulaMerah.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Ultra Milk Rasa Coklat',
                'slug'        => 'ultra-milk-rasa-coklat',
                'description' => 'Susu UHT coklat kemasan siap minum.',
                'price'       => 6000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/UltraMilkRasaCoklat.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Miliku Cokelat Premium',
                'slug'        => 'miliku-cokelat-premium',
                'description' => 'Susu coklat premium dengan rasa yang kaya.',
                'price'       => 7000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/MilikuCokelatPremium.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Nobo Oat Milk Creamy Classic',
                'slug'        => 'nobo-oat-milk-creamy-classic',
                'description' => 'Minuman oat milk creamy tanpa laktosa.',
                'price'       => 9000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/NoboOatMilkCreamyClassic.jpg',
                'is_available'=> true,
            ],

            // SNACK
            [
                'name'        => 'Donat Coklat',
                'slug'        => 'donat-coklat',
                'description' => 'Donat empuk dengan topping coklat leleh.',
                'price'       => 6000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/DonatCoklat.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Donat Kentang',
                'slug'        => 'donat-kentang',
                'description' => 'Donat kentang lembut dengan gula halus.',
                'price'       => 5000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/DonatKentang.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Brownies Cokelat',
                'slug'        => 'brownies-cokelat',
                'description' => 'Brownies cokelat legit dan fudgy.',
                'price'       => 8000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/BrowniesCokelat.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Blueberry Cheesecake',
                'slug'        => 'blueberry-cheesecake',
                'description' => 'Cheesecake lembut dengan topping blueberry segar.',
                'price'       => 15000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/BlueberryCheesecake.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Panna Cotta Stroberi',
                'slug'        => 'panna-cotta-stroberi',
                'description' => 'Dessert panna cotta creamy dengan saus stroberi.',
                'price'       => 13000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/PannaCottaStroberi.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Puding Karamel',
                'slug'        => 'puding-karamel',
                'description' => 'Puding susu dengan saus karamel manis.',
                'price'       => 8000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/PudingKaramel.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Kue Mochi',
                'slug'        => 'kue-mochi',
                'description' => 'Kue mochi kenyal dengan isian kacang manis.',
                'price'       => 7000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/KueMochi.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Kue Sus',
                'slug'        => 'kue-sus',
                'description' => 'Kue sus dengan isian krim vanilla lembut.',
                'price'       => 5000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/KueSus.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Kue Rol Oreo',
                'slug'        => 'kue-rol-oreo',
                'description' => 'Bolu gulung dengan krim oreo yang manis.',
                'price'       => 10000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/KueRolOreo.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Es Krim Cokelat',
                'slug'        => 'es-krim-cokelat',
                'description' => 'Es krim cokelat yang lembut dan creamy.',
                'price'       => 8000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/EsKrimCokelat.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Es Krim Oreo',
                'slug'        => 'es-krim-oreo',
                'description' => 'Es krim vanilla dengan remahan biskuit oreo.',
                'price'       => 9000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/EsKrimOreo.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Es Krim Stroberi',
                'slug'        => 'es-krim-stroberi',
                'description' => 'Es krim stroberi segar dengan rasa buah asli.',
                'price'       => 8000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/EsKrimStroberi.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Astor Chocolate Wafer',
                'slug'        => 'astor-chocolate-wafer',
                'description' => 'Wafer stik coklat renyah dan lezat.',
                'price'       => 4000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/AstorChocolateWafer.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Beng Beng',
                'slug'        => 'beng-beng',
                'description' => 'Wafer coklat karamel berlapis coklat renyah.',
                'price'       => 3000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/BengBeng.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Nabati Wafer Richoco',
                'slug'        => 'nabati-wafer-richoco',
                'description' => 'Wafer coklat Nabati renyah dengan krim coklat.',
                'price'       => 3000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/NabatiWaferRichoco.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Nextar Choco Brownies',
                'slug'        => 'nextar-choco-brownies',
                'description' => 'Snack brownies coklat kemasan praktis.',
                'price'       => 4000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/NextarChocoBrownies.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Biskuit Better',
                'slug'        => 'biskuit-better',
                'description' => 'Biskuit manis renyah cocok untuk camilan.',
                'price'       => 3000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/BiskuitBetter.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Chitato Lite Rumput Laut',
                'slug'        => 'chitato-lite-rumput-laut',
                'description' => 'Keripik kentang tipis rasa rumput laut.',
                'price'       => 5000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/ChitatoLiteRumputLaut.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Keripik Potabee',
                'slug'        => 'keripik-potabee',
                'description' => 'Keripik kentang Potabee renyah aneka rasa.',
                'price'       => 5000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/KeripikPotabee.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Qtela Balado',
                'slug'        => 'qtela-balado',
                'description' => 'Keripik singkong balado pedas manis khas.',
                'price'       => 5000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/QtelaBalado.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Tic Tic Crunchy Stick',
                'slug'        => 'tic-tic-crunchy-stick',
                'description' => 'Stik jagung renyah dengan rasa jagung manis.',
                'price'       => 3000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/TicTicCrunchyStick.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Oishi Sponge Crunch',
                'slug'        => 'oishi-sponge-crunch',
                'description' => 'Snack sponge jagung renyah rasa original.',
                'price'       => 3000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/OishiSpongeCrunch.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Cimory UHT Marie Biscuits',
                'slug'        => 'cimory-uht-marie-biscuits',
                'description' => 'Susu UHT Cimory rasa biskuit marie.',
                'price'       => 7000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/CimoryUhtMarieBiscuits.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Cimory Yogurt Bites Blueberry',
                'slug'        => 'cimory-yogurt-bites-blueberry',
                'description' => 'Yogurt bites Cimory rasa blueberry segar.',
                'price'       => 8000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/CimoryYogurtBitesBlueberry.jpg',
                'is_available'=> true,
            ],
        ];

        // ── PRODUK DAPUR SMK (shop2) ──────────────────────────────────
        $products2 = [

            // PAKET HEMAT
            [
                'name'        => 'Paket Hemat 1',
                'slug'        => 'paket-hemat-1',
                'description' => 'Paket nasi + ayam goreng + es teh untuk pelajar aktif.',
                'price'       => 22000,
                'category_id' => $paket?->id,
                'image_path'  => 'asset/img/AyamGeprek.jpg',
                'is_available'=> true,
            ],

            // MAKANAN
            [
                'name'        => 'Jus Jeruk Segar',
                'slug'        => 'jus-jeruk-segar',
                'description' => 'Jus jeruk dingin kaya vitamin C.',
                'price'       => 12000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/EsTeajus.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Kentang Goreng Dapur',
                'slug'        => 'kentang-goreng-dapur',
                'description' => 'Kentang goreng renyah ala Dapur SMK.',
                'price'       => 10000,
                'category_id' => $snack?->id,
                'image_path'  => 'asset/img/KentangGoreng.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Nasi Goreng Dapur',
                'slug'        => 'nasi-goreng-dapur',
                'description' => 'Nasi goreng khas Dapur SMK dengan bumbu rahasia.',
                'price'       => 15000,
                'category_id' => $makanan?->id,
                'image_path'  => 'asset/img/NasiGoreng.jpg',
                'is_available'=> true,
            ],
            [
                'name'        => 'Bubble Tea',
                'slug'        => 'bubble-tea-dapur',
                'description' => 'Bubble tea segar aneka varian rasa.',
                'price'       => 14000,
                'category_id' => $minuman?->id,
                'image_path'  => 'asset/img/BubbleTeaGulaMerah.jpg',
                'is_available'=> true,
            ],
        ];

        // Insert semua produk shop1
        if ($shop1) {
            foreach ($products1 as $data) {
                if (!$data['category_id']) continue;
                Product::firstOrCreate(
                    [
                        'shop_id' => $shop1->id,
                        'slug'    => $data['slug'],
                    ],
                    array_merge($data, ['shop_id' => $shop1->id])
                );
            }
        }

        // Insert semua produk shop2
        if ($shop2) {
            foreach ($products2 as $data) {
                if (!$data['category_id']) continue;
                Product::firstOrCreate(
                    [
                        'shop_id' => $shop2->id,
                        'slug'    => $data['slug'],
                    ],
                    array_merge($data, ['shop_id' => $shop2->id])
                );
            }
        }
    }
}