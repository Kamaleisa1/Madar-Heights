<?php

/*
|--------------------------------------------------------------------------
| Madar Heights — English content
|--------------------------------------------------------------------------
| Same keys as config/site.php. Only the text that changes in English lives
| here; everything else (phone, icons, numbers...) comes from site.php.
| Lists (features, districts) must keep the same number of items as Arabic.
*/

return [

    'name' => 'Madar Heights',
    'tagline' => 'Cleaning & Maintenance',
    'description' => 'Madar Heights Cleaning & Maintenance: upholstery dry and deep cleaning, carpet, sofa, curtain and majlis cleaning, AC cleaning, apartment, villa, tank and pool cleaning, and pest control in Dammam, Khobar, Qatif, Saihat, Al-Ahsa and Jubail.',
    'whatsapp_message' => 'Hello, I would like to book a service with Madar Heights',
    'working_hours' => 'Daily 8 AM – 10 PM, except Friday',

    'cities' => [
        'dammam' => [
            'name' => 'Dammam',
            'intro' => 'We cover every district of Dammam — Al Faisaliyah, Ash Shati, Ar Rayyan, An Nakheel, Al Mazruiyah, Al Fayha, Taibah and more — with teams ready throughout the day.',
            'districts' => ['Ash Shati', 'Al Faisaliyah', 'Ar Rayyan', 'An Nakheel', 'Al Mazruiyah', 'Al Fayha', 'Taibah', 'Al Jalawiyah'],
        ],
        'khobar' => [
            'name' => 'Khobar',
            'intro' => 'We serve all of Khobar — Al Aqrabiyah, Ath Thuqbah, Ar Rakah, Al Yarmouk, Golden Belt, North and South Khobar — with trained teams and modern equipment.',
            'districts' => ['Al Aqrabiyah', 'Ath Thuqbah', 'Ar Rakah', 'Al Yarmouk', 'Golden Belt', 'North Khobar', 'South Khobar', 'Al Olaya'],
        ],
        'qatif' => [
            'name' => 'Qatif',
            'intro' => 'Upholstery washing, cleaning, tank washing and pest control in Qatif and nearby areas: Al Qudaih, Al Awamiyah, Tarout, Safwa, Al Jish and Umm Al Hamam.',
            'districts' => ['Al Qudaih', 'Al Awamiyah', 'Tarout', 'Safwa', 'Al Jish', 'Umm Al Hamam', 'An Nasirah', 'Al Bahari'],
        ],
        'saihat' => [
            'name' => 'Saihat',
            'intro' => 'The Madar Heights team in Saihat is ready to wash your upholstery, clean your home or villa, and wash your tanks and ACs at fair prices with guaranteed quality.',
            'districts' => ['Al Kawthar', 'An Noor', 'Al Faisaliyah', 'Al Khassab', 'Al Muhit', 'Al Ghadeer'],
        ],
        'ahsa' => [
            'name' => 'Al-Ahsa',
            'intro' => 'We serve Hofuf, Mubarraz and all Al-Ahsa villages with upholstery washing, full cleaning, pest control and tank sanitizing.',
            'districts' => ['Hofuf', 'Mubarraz', 'Al Uyun', 'Al Jafr', 'At Taraf', 'Al Omran', 'Al Munaizlah', 'Al Qarah'],
        ],
        'jubail' => [
            'name' => 'Jubail',
            'intro' => 'Complete services in Jubail City and Jubail Industrial: upholstery washing, home and office cleaning, AC and tank washing, and pest control.',
            'districts' => ['Jubail City', 'Jubail Industrial', 'Al Fanateer', 'Ad Dafi', 'Al Huwailat', 'Jalmudah', 'Al Andalus', 'Second Industrial'],
        ],
    ],

    'services' => [
        'upholstery-cleaning' => [
            'title' => 'Upholstery Dry Cleaning',
            'short' => 'Our core service: upholstery dry cleaning with very little water — it dries fast and keeps the fabric\'s colour and feel, with sanitizing and perfuming.',
            'body' => 'Dry cleaning means cleaning upholstery with specialised products and machines using very little water, so the fabric dries fast and keeps its colour and feel without shrinking or damage. It suits delicate fabrics and furniture you need to use the same day. After cleaning we sanitize the upholstery against bacteria and dust mites and finish with premium fragrance. This is our core service and what we are known for.',
            'features' => ['Dry cleaning that protects fabric and colour', 'Suitable for delicate fabrics', 'Fast drying, usable the same day', 'Removes stains and dust', 'Sanitizing against bacteria and dust mites', 'Perfuming after cleaning'],
        ],
        'deep-upholstery-cleaning' => [
            'title' => 'Deep Upholstery Cleaning',
            'short' => 'Deep washing that reaches deep into the fibres to remove tough stains, built-up dust and odours, with sanitizing and perfuming.',
            'body' => 'Deep cleaning is for upholstery that has collected dust, tough stains and odours over time. We use injection, extraction and steam machines that reach deep into the fibres, pulling dirt out from inside rather than just the surface, then sanitize the upholstery against bacteria and dust mites and perfume it so it looks like new.',
            'features' => ['Reaches deep into the fibres', 'Removes tough and old stains', 'Extracts built-up dust', 'Odour removal', 'Sanitizing against bacteria and dust mites', 'Perfuming after washing'],
        ],
        'carpet-curtain-cleaning' => [
            'title' => 'Carpet, Rug & Curtain Cleaning',
            'short' => 'On-site washing of carpets, wall-to-wall carpeting and curtains with modern machines, plus sanitizing and perfuming.',
            'body' => 'We wash all kinds of carpets, rugs, wall-to-wall carpeting and curtains at your place with modern machines, removing stains and dust trapped deep in the fibres. We then sanitize them against bacteria and dust mites and perfume them, while protecting the colours and keeping drying time short.',
            'features' => ['On-site carpet and rug washing', 'All types of curtains', 'Deep dust extraction', 'Stain and odour removal', 'Sanitizing against mites and bacteria', 'Perfuming and colour protection'],
        ],
        'sofa-majlis-cleaning' => [
            'title' => 'Sofa & Majlis Cleaning',
            'short' => 'Steam washing of sofas and Arabic majlis seating in every fabric and leather, with stain removal, sanitizing and perfuming.',
            'body' => 'We wash all kinds of sofas (fabric, velvet, natural and faux leather) and Arabic majlis seating with professional steam and extraction machines and products made for each material. We remove stains, odours and bacteria without harming the fabric, then sanitize and perfume so it is ready for your guests.',
            'features' => ['Hot steam washing', 'Products suited to every fabric', 'Leather cleaning and conditioning', 'Tough stain and odour removal', 'Sanitizing against bacteria and mites', 'Perfuming after washing'],
        ],
        'mattress-cleaning' => [
            'title' => 'Mattress Cleaning',
            'short' => 'Washing and sanitizing mattresses from stains, sweat, dust mites and bed bugs, with perfuming for healthy sleep.',
            'body' => 'Over time a mattress collects sweat, dust and mites and can trigger allergies. We wash mattresses with steam and deep extraction, remove stains and odours, then sanitize them against bacteria, mites and bed bugs and perfume them for healthy, comfortable sleep.',
            'features' => ['Steam and deep extraction', 'Removes stains, sweat and odours', 'Eliminates dust mites and bed bugs', 'Sanitizing against bacteria', 'Perfuming after washing', 'Fast drying'],
        ],
        'ac-cleaning' => [
            'title' => 'AC Cleaning',
            'short' => 'Washing split AC units (indoor and outdoor) and window ACs for stronger cooling and lower power bills.',
            'body' => 'A dirty AC uses more electricity, cools less and spreads dust and bacteria. We wash split units — both indoor and outdoor — and window ACs with pressure machines, clean the filters, clear the drain lines and sanitize the unit against bacteria and odours.',
            'features' => ['Split AC: indoor and outdoor units', 'Window AC washing', 'Filter cleaning', 'Drain line clearing', 'Lower electricity consumption', 'Sanitizing against bacteria and odours'],
        ],
        'home-villa-cleaning' => [
            'title' => 'Apartment, Villa & Palace Cleaning',
            'short' => 'Full cleaning of apartments, villas and palaces inside and out by complete teams with professional equipment.',
            'body' => 'We provide full cleaning of apartments, villas and palaces covering rooms, living areas, facades, courtyards and annexes, with machine floor washing and marble polishing. Our complete teams work to a clear plan and finish fast, ending with sanitizing and perfuming.',
            'features' => ['Rooms and living areas', 'Facades, courtyards and annexes', 'Marble scrubbing and polishing', 'Machine floor washing', 'Sanitizing and perfuming', 'Large teams for fast results'],
        ],
        'office-cleaning' => [
            'title' => 'Office & Company Cleaning',
            'short' => 'Daily, weekly and monthly cleaning contracts for offices, companies and shops.',
            'body' => 'We offer flexible cleaning contracts for offices, companies, shops and warehouses — daily, weekly or monthly — with trained staff and professional equipment, without disrupting your work.',
            'features' => ['Daily, weekly and monthly contracts', 'Cleaning outside working hours', 'Sanitizing offices and corridors', 'Glass facade cleaning', 'Ongoing supervision', 'Special rates for companies'],
        ],
        'kitchen-bathroom-cleaning' => [
            'title' => 'Kitchen & Bathroom Cleaning',
            'short' => 'Deep kitchen cleaning and degreasing, and bathroom cleaning with scale removal, sanitizing and perfuming.',
            'body' => 'Kitchens and bathrooms need deep cleaning more than any other part of the home. We remove built-up grease from kitchens, cabinets and appliances, clear scale and stains from bathrooms, tiles and fixtures, then sanitize and perfume the space.',
            'features' => ['Degreasing kitchens and cabinets', 'Appliance and surface cleaning', 'Bathroom scale removal', 'Tile and grout cleaning', 'Sanitizing sanitary fixtures', 'Perfuming the space'],
        ],
        'window-cleaning' => [
            'title' => 'Window Cleaning',
            'short' => 'Cleaning and polishing windows, glass and frames inside and out with no streaks left behind.',
            'body' => 'We clean windows and glass facades inside and out, removing dust, stains and deposits from the glass, frames and tracks, then polish the glass until it is crystal clear with no streaks.',
            'features' => ['Glass cleaned inside and out', 'Frames and tracks', 'Dust and deposit removal', 'Streak-free polishing', 'Glass facade cleaning', 'Safe equipment for heights'],
        ],
        'tank-cleaning' => [
            'title' => 'Water Tank Cleaning (Rooftop & Underground)',
            'short' => 'Cleaning and sanitizing rooftop and underground tanks of every type, removing dirt and sediment with approved products.',
            'body' => 'Your tank is your home\'s water source, and over time dirt and sediment build up inside it. We clean underground and rooftop tanks of every type (concrete, plastic, fibreglass, steel): we empty the tank, extract the sediment, pressure-wash the walls and floor, then sanitize it with approved products that are safe for drinking water and rinse it thoroughly.',
            'features' => ['Underground and rooftop tanks', 'Emptying and sediment extraction', 'Dirt and sediment removal', 'High-pressure washing', 'Sanitizing with safe approved products', 'Full rinse after sanitizing'],
        ],
        'pool-cleaning' => [
            'title' => 'Swimming Pool Cleaning',
            'short' => 'Cleaning pools, removing dirt and deposits from walls and floor, and sanitizing the water.',
            'body' => 'We clean pools of every size: vacuuming dirt from the floor, cleaning walls and tiles from deposits, cleaning the filters and the pool surround, then sanitizing the water and balancing it so it is safe and clear.',
            'features' => ['Floor vacuuming', 'Wall and tile cleaning', 'Deposit removal', 'Filter cleaning', 'Water sanitizing', 'Pool surround cleaning'],
        ],
        'pest-control' => [
            'title' => 'Pest Control',
            'short' => 'Treatment of cockroaches, termites, bed bugs and rodents with safe, approved pesticides.',
            'body' => 'We control every kind of pest — cockroaches, termites, bed bugs, mosquitoes, flies, scorpions and rodents — using safe pesticides approved by the Ministry of Environment, after inspecting the source of the infestation and setting a treatment plan, with a service guarantee.',
            'features' => ['Termite control', 'Cockroach and bed bug control', 'Rodent control', 'Safe, approved pesticides', 'Preventive spraying for new buildings', 'Service guarantee'],
        ],
        'mosque-cleaning' => [
            'title' => 'Mosque Services',
            'short' => 'Washing mosque carpets and cushions and cleaning restrooms, with sanitizing and perfuming.',
            'body' => 'We serve the houses of Allah with special care: washing mosque carpets and cushions on site with modern machines, cleaning and sanitizing restrooms and ablution areas, then perfuming the mosque so it is ready to welcome worshippers.',
            'features' => ['On-site mosque carpet washing', 'Cushion washing', 'Restroom cleaning', 'Ablution area cleaning', 'Mosque sanitizing', 'Perfuming after cleaning'],
        ],
    ],

    'offer' => [
        'image' => 'assets/img/offer-en.jpg',
        'title' => 'Special offer on upholstery cleaning',
        'text' => 'Book now and enjoy a special discount on upholstery dry and deep cleaning.',
        'badge' => 'Special discount',
    ],

    'stats' => [
        ['label' => 'Happy clients'],
        ['label' => 'Specialised services'],
        ['label' => 'Cities covered'],
        ['label' => 'Client satisfaction'],
    ],

    'why' => [
        ['title' => 'Trained, skilled staff', 'text' => 'We continuously train our staff on the latest machines and modern stain-treatment methods to raise their efficiency.'],
        ['title' => 'Latest equipment', 'text' => 'We own the latest machines from the world\'s leading manufacturers.'],
        ['title' => 'Safe, approved products', 'text' => 'We use safe cleaning products with no harmful effects.'],
        ['title' => 'Quality guarantee', 'text' => 'We guarantee the quality of our work.'],
        ['title' => 'On time, every time', 'text' => 'We arrive at the agreed time and finish the job quickly.'],
        ['title' => 'Competitive prices', 'text' => 'Clear prices with no hidden fees, and regular offers.'],
    ],

    'steps' => [
        ['title' => 'Contact us', 'text' => 'Call us, message us on WhatsApp or fill in the booking form.'],
        ['title' => 'Set the date', 'text' => 'We agree on the service, price and a time that suits you.'],
        ['title' => 'We do the job', 'text' => 'Our team arrives with the equipment and works professionally.'],
        ['title' => 'Enjoy the result', 'text' => 'A clean, sanitized, fresh-smelling space and upholstery that looks new.'],
    ],

    'testimonials' => [
        ['name' => 'Madar Heights client', 'source' => 'via WhatsApp · translated from Arabic', 'text' => 'Wonderful service, classy manners and punctual. Thank you.'],
        ['name' => 'Madar Heights client', 'source' => 'via WhatsApp · translated from Arabic', 'text' => 'Mashallah, thank you for the service — truly clean! You brought my sofa back like new. I dealt with two other companies before you and, sadly, none matched your cleaning or your prices.'],
        ['name' => 'Madar Heights client', 'source' => 'via WhatsApp · translated from Arabic', 'text' => 'My regards to you, may Allah reward you for your service. Cleaning rating: excellent 👍'],
        ['name' => 'Madar Heights client', 'source' => 'via WhatsApp · translated from Arabic', 'text' => 'Tabarak Allah, thank you for your honesty — everything you promised about cleanliness and trustworthiness was true. Thank you from the heart; my rating is excellent and well deserved, and I am very, very satisfied.'],
        ['name' => 'Madar Heights client', 'source' => 'via WhatsApp · translated from Arabic', 'text' => 'Bless you — a truly great offer that came at the right time. You deserve creativity and excellence 🌷'],
    ],

    'faq' => [
        ['q' => 'Which cities do you cover?', 'a' => 'We serve Dammam, Khobar, Qatif, Saihat, Al-Ahsa, Jubail and surrounding areas.'],
        ['q' => 'What is upholstery dry cleaning?', 'a' => 'It is cleaning upholstery with specialised products and machines using very little water, so it dries fast and keeps its colour and feel. We complete it with deep washing that removes stains and dust from deep in the fibres.'],
        ['q' => 'How often should a water tank be cleaned?', 'a' => 'We recommend washing and sanitizing underground and rooftop tanks at least every 6 months to keep the water clean.'],
        ['q' => 'Are your pesticides safe for children?', 'a' => 'Yes. We use approved, safe pesticides and explain the precautions to follow before and after spraying.'],
        ['q' => 'Do you bring the equipment and cleaning products?', 'a' => 'Yes. Our team arrives with all the equipment and products needed — you don\'t need to prepare anything.'],
        ['q' => 'How long does AC cleaning take?', 'a' => 'AC cleaning takes about 20 to 30 minutes depending on the unit\'s condition.'],
        ['q' => 'How do I book a service?', 'a' => 'Call or WhatsApp us on +966 57 925 5992, or use the "Book a service" form on the website.'],
    ],

    'posts' => [
        'tank-cleaning-importance' => [
            'title' => 'Why should you clean your water tank every 6 months?',
            'excerpt' => 'Dirt and sediment build up in an uncleaned tank. Learn why regular tank cleaning matters and the signs your tank needs it.',
            'body' => [
                'Your water tank is the main source of the water you use for drinking, cooking and bathing. Over time dirt, sediment and dust build up inside it, especially with the high temperatures of the Eastern Province.',
                'Key signs your tank needs cleaning: a change in the water\'s colour or smell, sediment in your taps, and weak water pressure caused by clogged pipes.',
                'At Madar Heights we empty the tank, extract the sediment and pressure-wash it, then sanitize it with products that are safe for drinking water and give you a report on the tank\'s condition.',
            ],
        ],
        'why-ac-cleaning' => [
            'title' => 'Why should you clean your AC?',
            'excerpt' => 'Dirty filters force your AC to run longer. Here is why regular cleaning improves cooling and cuts electricity use.',
            'body' => [
                'When dust builds up on your AC filters, airflow drops and the compressor has to run longer to reach the set temperature, which pushes up your electricity consumption.',
                'Regular AC cleaning restores cooling efficiency, extends the life of the unit and reduces odours and bacteria in the air.',
                'The Madar Heights team washes split ACs — both indoor and outdoor units — and window ACs with pressure machines, cleaning the filters and clearing the drain lines.',
            ],
        ],
        'pest-control-tips' => [
            'title' => 'Tips to keep pests out of your home',
            'excerpt' => 'Simple steps to stop cockroaches and ants getting into your home — and when you need a professional pest control company.',
            'body' => [
                'Pests look for three things: food, water and shelter. Sealing food containers, fixing water leaks and closing gaps around doors and windows all reduce their chances of getting in.',
                'Take the rubbish out daily, clean the kitchen well after cooking, and avoid piling up cardboard boxes and old items.',
                'If pests still spread, it is best to call in a specialist. Madar Heights offers complete pest control with safe, approved pesticides and a guarantee.',
            ],
        ],
    ],
];
