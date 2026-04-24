<?php

function seedVehicles(): array
{
    return [
        [
            'id' => 'vehicle_urbania_10',
            'name' => 'Force Urbania 10 Seater',
            'slug' => 'force-urbania-10-seater',
            'capacity' => '10 Seater',
            'type' => 'Urbania',
            'summary' => 'A chauffeur-driven premium van with plush captain seats, silent cabin comfort, and luxury airport-style interiors.',
            'highlights' => [
                'Executive lounge-style seating',
                'Powerful AC for all seasons',
                'Premium ambient lighting',
                'Ideal for VIP family and corporate travel',
            ],
            'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80',
            'accent' => 'Copper Signature',
        ],
        [
            'id' => 'vehicle_urbania_11',
            'name' => 'Force Urbania 11 Seater',
            'slug' => 'force-urbania-11-seater',
            'capacity' => '11 Seater',
            'type' => 'Urbania',
            'summary' => 'Built for longer intercity trips with extra legroom, reclining comfort, and a smooth luxury ride profile.',
            'highlights' => [
                'Recliner seats with generous leg space',
                'Perfect for pilgrimage and event groups',
                'Large luggage support',
                'Premium chauffeur assistance',
            ],
            'image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1200&q=80',
            'accent' => 'Long-Ride Comfort',
        ],
        [
            'id' => 'vehicle_urbania_14',
            'name' => 'Force Urbania 14 Seater',
            'slug' => 'force-urbania-14-seater',
            'capacity' => '14 Seater',
            'type' => 'Urbania',
            'summary' => 'A polished solution for medium groups that need premium finishing, comfort-first travel, and memorable road-trip presence.',
            'highlights' => [
                'Spacious premium cabin',
                'Balanced comfort for group travel',
                'Great for weddings and tours',
                'Refined fit and finish',
            ],
            'image' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80',
            'accent' => 'Group Luxury',
        ],
        [
            'id' => 'vehicle_tempo_12',
            'name' => 'Luxury Tempo Traveller 12 Seater',
            'slug' => 'luxury-tempo-traveller-12-seater',
            'capacity' => '12 Seater',
            'type' => 'Tempo Traveller',
            'summary' => 'A budget-conscious luxury option with dependable AC performance, generous space, and dependable trip economics.',
            'highlights' => [
                'Comfortable seating for smaller groups',
                'Strong AC and luggage space',
                'Affordable luxury positioning',
                'Useful for local and regional tours',
            ],
            'image' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=1200&q=80',
            'accent' => 'Smart Luxury',
        ],
        [
            'id' => 'vehicle_tempo_17',
            'name' => 'Luxury Tempo Traveller 17 Seater',
            'slug' => 'luxury-tempo-traveller-17-seater',
            'capacity' => '17 Seater',
            'type' => 'Tempo Traveller',
            'summary' => 'Our large-group option for tours, yatras, employee movement, and event transfers with comfort-led seating plans.',
            'highlights' => [
                'Large-capacity seating',
                'Strong fit for group and event movement',
                'Smooth long-route ride',
                'Trusted choice for coordinators and agents',
            ],
            'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
            'accent' => 'Big Group Ease',
        ],
    ];
}

function seedReviews(): array
{
    return [
        [
            'id' => 'review_google_1',
            'category' => 'google',
            'type' => 'text',
            'title' => 'Smooth Chandigarh to Shimla family trip',
            'name' => 'Amanpreet Singh',
            'route' => 'Chandigarh to Shimla',
            'traveler_from' => 'Mohali',
            'date' => '2026-02-12',
            'rating' => 5,
            'content' => 'Clean vehicle, polite driver, and quick coordination from enquiry to drop-off. The family loved the comfort.',
            'media_url' => '',
        ],
        [
            'id' => 'review_google_2',
            'category' => 'google',
            'type' => 'text',
            'title' => 'Excellent Prayagraj coordination',
            'name' => 'Sneha Batra',
            'route' => 'Chandigarh to Prayagraj',
            'traveler_from' => 'Chandigarh',
            'date' => '2026-01-25',
            'rating' => 5,
            'content' => 'The booking team stayed in touch throughout the route, and the Urbania felt premium from start to finish.',
            'media_url' => '',
        ],
        [
            'id' => 'review_google_3',
            'category' => 'google',
            'type' => 'text',
            'title' => 'Corporate event pickup done right',
            'name' => 'Rohit Mehra',
            'route' => 'Chandigarh airport transfer',
            'traveler_from' => 'Delhi NCR',
            'date' => '2025-12-18',
            'rating' => 5,
            'content' => 'Reliable timing, professional driver presentation, and easy communication for our corporate guests.',
            'media_url' => '',
        ],
        [
            'id' => 'review_domestic_1',
            'category' => 'domestic',
            'type' => 'video',
            'title' => 'Vaishno Devi family testimonial',
            'name' => 'Pooja Arora',
            'route' => 'Chandigarh to Katra',
            'traveler_from' => 'Ludhiana',
            'date' => '2026-02-03',
            'rating' => 5,
            'content' => 'Warm driver support and a very peaceful trip for the entire family.',
            'media_url' => 'https://res.cloudinary.com/demo/video/upload/samples/elephants.mp4',
        ],
        [
            'id' => 'review_domestic_2',
            'category' => 'domestic',
            'type' => 'video',
            'title' => 'Wedding guest transfer review',
            'name' => 'Karan Malhotra',
            'route' => 'Chandigarh to Jaipur',
            'traveler_from' => 'Panchkula',
            'date' => '2026-01-09',
            'rating' => 5,
            'content' => 'The interiors looked premium and the travel felt effortless even for a long event run.',
            'media_url' => 'https://res.cloudinary.com/demo/video/upload/samples/elephants.mp4',
        ],
        [
            'id' => 'review_local_1',
            'category' => 'local',
            'type' => 'video',
            'title' => 'Chandigarh city luxury transfer',
            'name' => 'Ishita Jain',
            'route' => 'Local Chandigarh movement',
            'traveler_from' => 'Chandigarh',
            'date' => '2026-02-20',
            'rating' => 5,
            'content' => 'A premium local experience for family guests with professional and punctual service.',
            'media_url' => 'https://res.cloudinary.com/demo/video/upload/samples/elephants.mp4',
        ],
        [
            'id' => 'review_local_2',
            'category' => 'local',
            'type' => 'video',
            'title' => 'Conference day transfer',
            'name' => 'Nikhil Sood',
            'route' => 'Chandigarh to Zirakpur',
            'traveler_from' => 'Mohali',
            'date' => '2026-01-28',
            'rating' => 5,
            'content' => 'Professional coordination and clean seating across multiple venue drop-offs.',
            'media_url' => 'https://res.cloudinary.com/demo/video/upload/samples/elephants.mp4',
        ],
        [
            'id' => 'review_international_1',
            'category' => 'international',
            'type' => 'video',
            'title' => 'NRI family Punjab tour',
            'name' => 'Rajiv Bansal',
            'route' => 'Chandigarh to Amritsar and Himachal',
            'traveler_from' => 'Toronto',
            'date' => '2025-11-14',
            'rating' => 5,
            'content' => 'The team handled luggage, route changes, and timing beautifully for our overseas family visit.',
            'media_url' => 'https://res.cloudinary.com/demo/video/upload/samples/elephants.mp4',
        ],
        [
            'id' => 'review_international_2',
            'category' => 'international',
            'type' => 'video',
            'title' => 'Luxury North India circuit',
            'name' => 'Meera Khanna',
            'route' => 'Chandigarh to Agra and Jaipur',
            'traveler_from' => 'London',
            'date' => '2025-10-06',
            'rating' => 5,
            'content' => 'Very comfortable for a longer itinerary and the booking process was seamless from abroad.',
            'media_url' => 'https://res.cloudinary.com/demo/video/upload/samples/elephants.mp4',
        ],
    ];
}

function seedGallery(): array
{
    return [
        [
            'id' => 'gallery_1',
            'title' => 'Urbania premium front profile',
            'media_type' => 'image',
            'media_url' => 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'gallery_2',
            'title' => 'Luxury cabin mood lighting',
            'media_type' => 'image',
            'media_url' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'gallery_3',
            'title' => 'Road trip mountain frame',
            'media_type' => 'image',
            'media_url' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'gallery_4',
            'title' => 'Executive airport arrival',
            'media_type' => 'image',
            'media_url' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'gallery_5',
            'title' => 'Traveler moments',
            'media_type' => 'image',
            'media_url' => 'https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'gallery_6',
            'title' => 'Scenic route stop',
            'media_type' => 'image',
            'media_url' => 'https://images.unsplash.com/photo-1500534314209-a26db0f0b4c0?auto=format&fit=crop&w=1200&q=80',
        ],
    ];
}

function seedDestinations(): array
{
    return [
        [
            'id' => 'destination_1',
            'route' => 'Chandigarh to Shimla',
            'summary' => 'Fast hill getaway with premium family comfort.',
            'tag' => 'Hill Escape',
            'image' => 'https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'destination_2',
            'route' => 'Chandigarh to Manali',
            'summary' => 'Long-route comfort for groups, snow trips, and weekend tours.',
            'tag' => 'Adventure',
            'image' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'destination_3',
            'route' => 'Chandigarh to Prayagraj',
            'summary' => 'Spiritual group travel with reliable pacing and driver support.',
            'tag' => 'Pilgrimage',
            'image' => 'https://images.unsplash.com/photo-1473116763249-2faaef81ccda?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'destination_4',
            'route' => 'Chandigarh to Jaipur',
            'summary' => 'Premium event and leisure road journeys for larger groups.',
            'tag' => 'Events',
            'image' => 'https://images.unsplash.com/photo-1477587458883-47145ed94245?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'destination_5',
            'route' => 'Chandigarh to Agra',
            'summary' => 'Classic North India circuit planning with comfort-led interiors.',
            'tag' => 'Heritage',
            'image' => 'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'destination_6',
            'route' => 'Chandigarh to Haridwar',
            'summary' => 'Comfortable spiritual transfers for families and yatra groups.',
            'tag' => 'Sacred Route',
            'image' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'destination_7',
            'route' => 'Chandigarh to Amritsar',
            'summary' => 'Day trips and guest movement with polished chauffeur support.',
            'tag' => 'City Gold',
            'image' => 'https://images.unsplash.com/photo-1521295121783-8a321d551ad2?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 'destination_8',
            'route' => 'Chandigarh to Dharamshala',
            'summary' => 'Relaxed mountain transfers for family and spiritual travel.',
            'tag' => 'Retreat',
            'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80',
        ],
    ];
}

function pageNarratives(): array
{
    return [
        'home' => [
            'hero' => [
                'eyebrow' => 'Luxury Urbania and Tempo Traveller Travel',
                'title' => 'Premium road journeys crafted for family, spiritual, event, and corporate travel.',
                'subtitle' => 'From Chandigarh departures to all major North India routes, Pocket Luxury Travel blends polished vehicles, experienced chauffeurs, and quick booking support.',
                'stats' => [
                    '24/7 booking assistance',
                    'Professional chauffeur-driven fleet',
                    'Flexible routes for pilgrimage, leisure, and events',
                ],
            ],
            'offer' => [
                'title' => 'What We Offer',
                'content' => 'From executive airport transfers to all-day yatra movement, we design every journey around comfort, punctuality, and presentation. Our vehicles are chosen for travelers who want premium travel without coordination stress.',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80',
            ],
            'service' => [
                'title' => 'Hire or Rent Urbania with Confidence',
                'content' => 'Choose Pocket Luxury Travel for weddings, family vacations, corporate movement, pilgrimage routes, and destination tours. We focus on refined interiors, clean cabins, experienced drivers, and transparent booking communication.',
                'highlights' => [
                    'Ideal for family travel, group tours, and business movement',
                    'Popular for Chandigarh routes to Shimla, Manali, Prayagraj, Amritsar, Jaipur, and Haridwar',
                    'Responsive support before, during, and after booking',
                ],
            ],
            'benefits' => [
                '24×7 support',
                'Reliable service',
                'Secure rides',
                'Easy booking',
                'Transparent pricing',
                'Clean premium vehicles',
            ],
        ],
        'journey' => [
            'hero' => [
                'title' => 'Journey to Prayagraj',
                'subtitle' => 'A premium Chandigarh-to-Prayagraj experience designed for spiritual comfort and long-route peace of mind.',
                'image' => 'https://images.unsplash.com/photo-1473116763249-2faaef81ccda?auto=format&fit=crop&w=1600&q=80',
            ],
            'sections' => [
                [
                    'title' => 'Spiritual destinations worth the road journey',
                    'content' => 'Travel with your family or group toward Prayagraj, Sangam visits, temple circuits, and major spiritual gatherings with a calm, well-paced vehicle experience from departure to return.',
                    'images' => [
                        'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=1000&q=80',
                        'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=1000&q=80',
                        'https://images.unsplash.com/photo-1477587458883-47145ed94245?auto=format&fit=crop&w=1000&q=80',
                    ],
                    'reverse' => false,
                ],
                [
                    'title' => 'Vehicle rental services built for long routes',
                    'content' => 'Choose premium Urbania and spacious Tempo Traveller options with reclining support, neat interiors, and luggage space for multi-day travel planning.',
                    'images' => [
                        'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1000&q=80',
                        'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1000&q=80',
                    ],
                    'reverse' => true,
                ],
                [
                    'title' => 'Comfort for long spiritual journeys',
                    'content' => 'We focus on a smoother pace, neat vehicles, air-conditioned cabins, and reliable driver support so that extended routes feel more restful and less tiring.',
                    'images' => [
                        'https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=1000&q=80',
                        'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=1000&q=80',
                    ],
                    'reverse' => false,
                ],
            ],
            'event_dates' => [
                'Upcoming bathing dates, festive travel peaks, and major spiritual calendar moments can be highlighted here from admin content or seasonal campaign updates.',
            ],
            'cta' => [
                'title' => 'Book your Prayagraj journey with a comfort-first travel team',
                'content' => 'Share your passenger count, route, and preferred dates. We will help you match the right vehicle with quick response support.',
                'image' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1200&q=80',
            ],
        ],
        'fleet' => [
            'hero' => [
                'title' => 'Our Fleet',
                'subtitle' => 'Luxury vehicles for polished road travel, guest movement, pilgrimage, tourism, and executive transfers.',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80',
            ],
            'why_choose' => [
                'Premium vehicles maintained for presentation and comfort',
                'Competitive pricing without compromise on service quality',
                'Quick booking coordination',
                'Clean and reliable cabins',
                'Trusted service from Chandigarh departures',
            ],
        ],
        'reviews' => [
            'hero' => [
                'title' => 'Pocket Luxury Travel Reviews',
                'subtitle' => 'Real stories from families, coordinators, local travelers, and overseas guests.',
                'image' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1600&q=80',
            ],
            'trust_heading' => 'The Pocket Luxury Travel reviews you can trust',
        ],
        'partner' => [
            'hero' => [
                'title' => 'Partner With Us',
                'subtitle' => 'Collaborate on premium Urbania and Tempo Traveller travel from Chandigarh for spiritual, event, corporate, and tourism journeys.',
                'image' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1600&q=80',
            ],
            'info' => 'Our trips originate from Chandigarh and cover pilgrimage routes, tourism circuits, weddings, event transfers, and corporate movement. Travel agents, coordinators, brokers, and referral partners can work with us while we handle vehicles, operations, and traveler experience.',
            'benefits' => [
                'Premium fleet availability',
                'Professional drivers and coordination',
                'High-demand North India routes',
                'Transparent communication',
                'Referral earning opportunity',
            ],
        ],
        'about' => [
            'hero' => [
                'title' => 'Travel With A Team Built Around Comfort and Trust',
                'subtitle' => 'Luxury chauffeur-driven travel for families, corporate guests, events, yatras, and premium regional tours.',
                'image' => 'https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=1600&q=80',
            ],
            'intro' => [
                'title' => 'About Us',
                'content' => 'Pocket Luxury Travel delivers premium travel experiences with polished vehicles, passenger-first planning, and a focus on comfort for every mile. We combine refined service, route experience, and dependable support for journeys that feel seamless from enquiry to arrival.',
            ],
            'cards' => [
                [
                    'title' => 'Efficiency and elegance',
                    'content' => 'Vehicles and support systems designed to keep travel premium and punctual.',
                ],
                [
                    'title' => 'Comfort and entertainment',
                    'content' => 'Thoughtful seating, cooling, and journey flow for long and short travel windows.',
                ],
                [
                    'title' => 'Charging support',
                    'content' => 'Useful amenities for modern travelers on all-day movement and tour routes.',
                ],
                [
                    'title' => 'Transparent service',
                    'content' => 'Clear communication before booking and during trip coordination.',
                ],
                [
                    'title' => 'Safety and reliability',
                    'content' => 'Professional chauffeur support and consistent route handling.',
                ],
                [
                    'title' => 'Easy booking flow',
                    'content' => 'Fast enquiries, practical vehicle matching, and direct support.',
                ],
            ],
        ],
        'urbania' => [
            'hero' => [
                'title' => 'Book Force Urbania',
                'subtitle' => 'Luxury Tempo Traveller comfort with premium presentation, dependable routes, and smooth group travel planning.',
                'image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1600&q=80',
            ],
            'features' => [
                'Efficiency meets elegance',
                'Comfort and entertainment',
                'Charging support',
                'Comfort for long trips',
                'Transparent pricing',
                'Easy booking',
                'Driver insights',
                'Safety first',
                'Premium experience',
            ],
        ],
    ];
}
