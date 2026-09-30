<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed the Two Admin Users
        $admins = [
            [
                'name' => 'Femi Fasanya',
                'email' => 'fasanyafemi@gmail.com',
                'password' => Hash::make('Password123'),
                'phone' => '+44 7424 928399',
                'role' => 'admin',
                'user_type' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ella Beauty Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Password123'),
                'phone' => '+44 7424 928399',
                'role' => 'admin',
                'user_type' => 'admin',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($admins as $adminData) {
            User::updateOrCreate(['email' => $adminData['email']], $adminData);
        }

        // 2. Seed Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Ella Beauty', 'type' => 'string', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '+44 7424 928399', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'contact@ellabeauty.co.uk', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'primary_location', 'value' => 'Luton & Surrounding Areas, UK', 'type' => 'string', 'group' => 'general'],
            ['key' => 'deposit_percentage', 'value' => '30', 'type' => 'number', 'group' => 'booking'],
            ['key' => 'emergency_fee', 'value' => '30.00', 'type' => 'number', 'group' => 'booking'],
            ['key' => 'late_fee_15min', 'value' => '10.00', 'type' => 'number', 'group' => 'booking'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Seed Service Categories & 25 Services
        $categoriesData = [
            [
                'name' => 'Boho Braids',
                'slug' => 'boho-braids',
                'description' => 'Effortless, bohemian style knotless braids with soft wavy curls and curls interspersed.',
                'sort_order' => 1,
                'services' => [
                    [
                        'name' => 'Small Boho braids - bob / shoulder length',
                        'duration_hours' => '7 hours',
                        'price' => 120.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                    [
                        'name' => 'Small boho braids - mid-back length',
                        'duration_hours' => '8 hours',
                        'price' => 140.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                    [
                        'name' => 'Small boho braids - waist length',
                        'duration_hours' => '10 hours',
                        'price' => 180.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                    [
                        'name' => 'Smedium boho braids - bob / shoulder length',
                        'duration_hours' => '5 hours',
                        'price' => 100.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                    [
                        'name' => 'Smedium boho braids - mid-back length',
                        'duration_hours' => '6 hours',
                        'price' => 120.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                    [
                        'name' => 'Smedium boho braids - waist length',
                        'duration_hours' => '7 hours',
                        'price' => 140.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                    [
                        'name' => 'Medium boho braids - bob / shoulder length',
                        'duration_hours' => '4 hours',
                        'price' => 80.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                    [
                        'name' => 'Medium boho braids - mid-back length',
                        'duration_hours' => '5 hours',
                        'price' => 100.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                    [
                        'name' => 'Medium boho braids - waist length',
                        'duration_hours' => '6 hours',
                        'price' => 120.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided. Human hair bulk bundle is not included and must be selected as an add-on.',
                    ],
                ]
            ],
            [
                'name' => 'Knotless Braids',
                'slug' => 'knotless-braids',
                'description' => 'Tension-free, natural scalp-finish protective knotless braids.',
                'sort_order' => 2,
                'services' => [
                    [
                        'name' => 'Small knotless braids - mid-back length',
                        'duration_hours' => '6 hours',
                        'price' => 120.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided.',
                    ],
                    [
                        'name' => 'Small knotless braids - waist length',
                        'duration_hours' => '8 hours',
                        'price' => 140.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided.',
                    ],
                    [
                        'name' => 'Smedium knotless braids - mid-back length',
                        'duration_hours' => '5 hours',
                        'price' => 100.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided.',
                    ],
                    [
                        'name' => 'Smedium knotless braids - waist length',
                        'duration_hours' => '6 hours',
                        'price' => 120.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided.',
                    ],
                    [
                        'name' => 'Medium knotless braids - mid-back length',
                        'duration_hours' => '4 hours',
                        'price' => 80.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided.',
                    ],
                    [
                        'name' => 'Medium knotless braids - waist length',
                        'duration_hours' => '5 hours',
                        'price' => 100.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price and will be provided.',
                    ],
                ]
            ],
            [
                'name' => 'Fulani / Tribal Braids',
                'slug' => 'fulani-tribal-braids',
                'description' => 'Intricate tribal cornrows in the front paired with knotless braids or sew-in in the back.',
                'sort_order' => 3,
                'services' => [
                    [
                        'name' => 'Fulani / Tribal Braids (standard style)',
                        'duration_hours' => '6 hours',
                        'price' => 130.00,
                        'hair_extensions_note' => 'Braiding hair is included. Any accessories/beads can be provided or brought by client.',
                    ]
                ]
            ],
            [
                'name' => 'Stitch Braids',
                'slug' => 'stitch-braids',
                'description' => 'Ultra-clean, razor-sharp straight-back and designer stitch braids.',
                'sort_order' => 4,
                'services' => [
                    [
                        'name' => 'Stitch Braids (4 - 8 straight backs)',
                        'duration_hours' => '3 hours',
                        'price' => 70.00,
                        'hair_extensions_note' => 'Braiding hair is included in the service price.',
                    ]
                ]
            ],
            [
                'name' => 'Half Weave / Sew-Ins',
                'slug' => 'half-weave-sew-ins',
                'description' => 'Versatile half cornrows, half sew-in weave protective installation.',
                'sort_order' => 5,
                'services' => [
                    [
                        'name' => 'Half Weave / Sew-In Installation',
                        'duration_hours' => '4 hours',
                        'price' => 90.00,
                        'hair_extensions_note' => 'Hair weave bundles to be provided by client or purchased as add-on.',
                    ]
                ]
            ],
            [
                'name' => 'Twists (With Extensions)',
                'slug' => 'twists-with-extensions',
                'description' => 'Passion twists, Marley twists, and Senegalese twists with extension hair.',
                'sort_order' => 6,
                'services' => [
                    [
                        'name' => 'Twists with Extensions - Mid-Back',
                        'duration_hours' => '5 hours',
                        'price' => 110.00,
                        'hair_extensions_note' => 'Twist hair extensions are included in service.',
                    ],
                    [
                        'name' => 'Twists with Extensions - Waist Length',
                        'duration_hours' => '7 hours',
                        'price' => 135.00,
                        'hair_extensions_note' => 'Twist hair extensions are included in service.',
                    ]
                ]
            ],
            [
                'name' => 'Twists (Natural Hair)',
                'slug' => 'twists-natural-hair',
                'description' => 'Two-strand twists, flat twists, and mini twists on chemical-free natural hair.',
                'sort_order' => 7,
                'services' => [
                    [
                        'name' => 'Two-Strand Twists on Natural Hair',
                        'duration_hours' => '2.5 hours',
                        'price' => 55.00,
                        'hair_extensions_note' => 'No extensions required. Nourishing oils and butters applied.',
                    ]
                ]
            ],
            [
                'name' => 'French Curls / Italian Curls (Boho Style)',
                'slug' => 'french-curls-boho-style',
                'description' => 'Luxurious bouncy curled tips with bouncy French or Italian curl extensions.',
                'sort_order' => 8,
                'services' => [
                    [
                        'name' => 'French Curl Knotless Braids - Mid-Back',
                        'duration_hours' => '6 hours',
                        'price' => 135.00,
                        'hair_extensions_note' => 'French curl extensions included in service price.',
                    ],
                    [
                        'name' => 'French Curl Knotless Braids - Waist Length',
                        'duration_hours' => '8 hours',
                        'price' => 160.00,
                        'hair_extensions_note' => 'French curl extensions included in service price.',
                    ]
                ]
            ],
            [
                'name' => 'DIY (Pre-Parting & Cornrows)',
                'slug' => 'diy-pre-parting-cornrows',
                'description' => 'Professional parting and base foundation cornrows for wigs and self-installs.',
                'sort_order' => 9,
                'services' => [
                    [
                        'name' => 'Wig Foundation Flat Cornrows (6-10 rows)',
                        'duration_hours' => '1.5 hours',
                        'price' => 40.00,
                        'hair_extensions_note' => 'Natural hair prepped, oiled, and neatly braided flat for flawless wig install.',
                    ],
                    [
                        'name' => 'Precision Sectioning & Pre-Parting Base',
                        'duration_hours' => '1 hour',
                        'price' => 35.00,
                        'hair_extensions_note' => 'Crisp clean geometric parts prepared for DIY home braiding.',
                    ]
                ]
            ]
        ];

        $sortIdx = 1;
        foreach ($categoriesData as $catData) {
            $services = $catData['services'];
            unset($catData['services']);

            $category = ServiceCategory::updateOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );

            foreach ($services as $serv) {
                $deposit = round(($serv['price'] * 30) / 100, 2);
                Service::updateOrCreate(
                    [
                        'name' => $serv['name'],
                        'service_category_id' => $category->id
                    ],
                    [
                        'slug' => Str::slug($serv['name']),
                        'duration_hours' => $serv['duration_hours'],
                        'price' => $serv['price'],
                        'deposit_percentage' => 30.00,
                        'deposit_amount' => $deposit,
                        'hair_extensions_note' => $serv['hair_extensions_note'],
                        'hair_included' => str_contains(strtolower($serv['hair_extensions_note']), 'included'),
                        'sort_order' => $sortIdx++,
                        'is_active' => true,
                    ]
                );
            }
        }

        // 4. Seed Client Reviews
        $reviewsData = [
            [
                'client_name' => 'Vanessa Johnson',
                'rating' => 5,
                'comment' => 'I usually get so much anxiety before getting braids because my scalp is sensitive. Ella was so incredibly gentle! Not a single headache, no tight edges, and the bohemian curls are still neat and gorgeous weeks later.',
                'service_rendered' => 'Bohemian Knotless Braids',
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Amara Lewis',
                'rating' => 5,
                'comment' => 'Having Ella come over for a home service was an absolute lifesaver. She arrived on time with everything needed, was patient with my daughter, and her braids look stunning. Best mobile stylist in Luton!',
                'service_rendered' => "Kids' Braids & Mobile Service",
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'Stephanie Taylor',
                'rating' => 5,
                'comment' => 'The precision partings and clean finish on my twists were unmatched. Everyone kept complimenting my hair at work. Professional, punctual, and worth every penny. Ella Beauty is my forever braider.',
                'service_rendered' => 'Passion Twists',
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 3,
            ],
            [
                'client_name' => 'Chiamaka Eze',
                'rating' => 5,
                'comment' => 'Booked for French Curl Knotless Braids and I was blown away by the neatness! She gave great advice on maintenance and the curls stayed super bouncy for over 6 weeks. 10/10 experience!',
                'service_rendered' => 'French Curl Knotless Braids',
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 4,
            ],
            [
                'client_name' => 'Keisha Morgan',
                'rating' => 5,
                'comment' => 'I requested no gel because of my sensitive scalp, and Ella accommodated it seamlessly without compromising the clean, sharp lines. Amazing service and lovely warm energy.',
                'service_rendered' => 'Stitch Braids (No Gel Option)',
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 5,
            ],
            [
                'client_name' => 'Blessing Adeleke',
                'rating' => 5,
                'comment' => 'Punctual, friendly, and very fast without compromising quality. The 30% deposit process and online booking were effortless. Highly recommend Ella to anyone in Luton & Beds!',
                'service_rendered' => 'Smedium Boho Braids',
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($reviewsData as $rev) {
            \App\Models\Review::updateOrCreate(
                ['client_name' => $rev['client_name'], 'service_rendered' => $rev['service_rendered']],
                $rev
            );
        }

        // 5. Seed Lookbook Gallery Items with service associations
        $bohoService = \App\Models\Service::where('name', 'like', '%Boho%')->first();
        $knotlessService = \App\Models\Service::where('name', 'like', '%Knotless%')->first();
        $kidsService = \App\Models\Service::where('name', 'like', '%Kid%')->orWhere('name', 'like', '%Cornrow%')->first();
        $frenchService = \App\Models\Service::where('name', 'like', '%French%')->first();
        $stitchService = \App\Models\Service::where('name', 'like', '%Stitch%')->first();
        $fulaniService = \App\Models\Service::where('name', 'like', '%Fulani%')->orWhere('name', 'like', '%Tribal%')->first();

        $galleryData = [
            [
                'service_id' => $bohoService?->id,
                'title' => 'Boho Goddess Braids',
                'category' => 'Boho Braids',
                'image_path' => '/assets/images/braided4.avif',
                'caption' => 'Waist length boho knotless braids with soft defined human hair curls.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'service_id' => $knotlessService?->id,
                'title' => 'Signature Knotless Braids',
                'category' => 'Knotless Braids',
                'image_path' => '/assets/images/hero1.jpg',
                'caption' => 'Flawless root tension, neat geometric partings, and lightweight feel.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'service_id' => $bohoService?->id,
                'title' => 'Radiant Protective Styling',
                'category' => 'Protective Styles',
                'image_path' => '/assets/images/hero2.jpg',
                'caption' => 'Healthy scalp maintenance and long-lasting protective artistry.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'service_id' => $kidsService?->id,
                'title' => 'Gentle Kids Hair Artistry',
                'category' => 'Kids Hair',
                'image_path' => '/assets/images/hero3.avif',
                'caption' => 'Tender scalp care, fun designs, and pain-free experience for young queens.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'service_id' => $knotlessService?->id,
                'title' => 'Luxury VIP Travel Glam',
                'category' => 'Mobile Appointments',
                'image_path' => '/assets/images/hero4.jpg',
                'caption' => 'Professional in-home styling with salon-grade precision and comfort.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'service_id' => $fulaniService?->id,
                'title' => 'Fulani Tribal Braids',
                'category' => 'Tribal & Fulani',
                'image_path' => '/assets/images/pexels-territory-480811054-27944873.jpg',
                'caption' => 'Intricate center parts, symmetrical side braids, and elegant bead accents.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'service_id' => $frenchService?->id,
                'title' => 'French Curl Knotless',
                'category' => 'French Curls',
                'image_path' => '/assets/images/pexels-vurzie-kim-325095862-15576674.jpg',
                'caption' => 'Ultra-silky curls with bouncy tips and long-lasting sleekness.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'service_id' => $stitchService?->id,
                'title' => 'Precision Stitch Cornrows',
                'category' => 'Cornrows',
                'image_path' => '/assets/images/pexels-gen-us-grapher-452619136-16684786.jpg',
                'caption' => 'Razor-sharp partings and clean feeding technique.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($galleryData as $gItem) {
            \App\Models\Gallery::updateOrCreate(
                ['title' => $gItem['title']],
                $gItem
            );
        }
    }
}
