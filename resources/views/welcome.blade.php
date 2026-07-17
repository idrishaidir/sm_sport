<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SM Sport Center - Premium Sports & Wellness</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#166534', /* Forest Green */
                        secondary: '#10B981', /* Emerald Green */
                        accent: '#84CC16', /* Lime Green */
                        background: '#F8FAF8', /* Off White */
                        surface: '#FFFFFF', /* White */
                        text: '#1F2937', /* Dark Slate */
                        highlight: '#F97316', /* Soft Orange */
                    },
                    borderRadius: {
                        'bento': '20px',
                    },
                    boxShadow: {
                        'bento': '0 8px 30px rgba(0,0,0,0.04)',
                        'bento-hover': '0 15px 40px rgba(22,101,52,0.08)',
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #F8FAF8; color: #1F2937; }
        .bento-card {
            background-color: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.04);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(16, 185, 129, 0.05);
            overflow: hidden;
        }
        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(22,101,52,0.08);
            border-color: rgba(16, 185, 129, 0.2);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .glass-panel-dark {
            background: rgba(22, 101, 52, 0.6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-secondary selection:text-white">

    <!-- 1. Navigation -->
    <nav class="fixed top-4 left-0 right-0 z-50 mx-4 md:mx-auto max-w-7xl glass-panel rounded-bento px-6 py-4 flex justify-between items-center transition-all shadow-sm">
        <!-- Logo -->
        <div class="flex items-center gap-3 cursor-pointer">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-lg">
                SM
            </div>
            <span class="font-bold text-xl text-primary tracking-tight hidden sm:block">Sport Center</span>
        </div>
        
        <!-- Center Menu -->
        <div class="hidden lg:flex space-x-8">
            <a href="#" class="text-primary font-semibold">Home</a>
            <a href="#about" class="text-text hover:text-primary transition-colors font-medium">About</a>
            <a href="#facilities" class="text-text hover:text-primary transition-colors font-medium">Facilities</a>
            <a href="#gallery" class="text-text hover:text-primary transition-colors font-medium">Gallery</a>
            <a href="#contact" class="text-text hover:text-primary transition-colors font-medium">Contact</a>
        </div>

        <!-- Right Side Actions -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}" class="text-text font-medium hover:text-primary transition-colors hidden md:block">Login</a>
            <a href="{{ route('register') }}" class="bg-highlight hover:bg-orange-600 text-white px-6 py-2.5 rounded-xl font-semibold shadow-md transition-all hover:-translate-y-0.5">
                Book Now
            </a>
        </div>
    </nav>

    <!-- Main Content Wrapper for Spacing -->
    <div class="pt-28 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- 2. Hero Bento Grid -->
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 auto-rows-[minmax(180px,auto)]">
            
            <!-- Main Featured Card (Spans 3 cols, 2 rows) -->
            <div class="bento-card col-span-1 md:col-span-3 md:row-span-2 relative min-h-[400px] md:min-h-0 flex flex-col justify-end p-8 md:p-12 group">
                <img src="{{asset('images/header.png')}}" alt="Sports Facility" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/60 to-transparent"></div>
                
                <div class="relative z-10 max-w-2xl text-white">
                    <span class="inline-block py-1.5 px-4 rounded-full glass-panel-dark text-xs font-bold uppercase tracking-wider mb-4">
                        Premium Sports Profile
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                        SM Sport Center
                    </h1>
                    <h2 class="text-xl md:text-2xl font-medium text-accent mb-4">
                        A Modern Destination for Sports, Wellness, and Community.
                    </h2>
                    <p class="text-white/80 mb-8 max-w-xl text-sm md:text-base leading-relaxed">
                        We provide premium futsal and badminton facilities for everyone. Experience a healthy lifestyle in a professional, clean, and inspiring environment tailored for your comfort.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#facilities" class="bg-white text-primary hover:bg-background px-6 py-3 rounded-xl font-semibold transition-colors">
                            Explore Facilities
                        </a>
                        <a href="{{ route('register') }}" class="glass-panel-dark hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                            Book a Court
                        </a>
                    </div>
                </div>
            </div>

            
            <!-- Small Card 3: Open Everyday -->
            <div class="bento-card col-span-1 p-6 flex items-center gap-4 bg-primary text-white">
                <div class="w-12 h-12 glass-panel-dark rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined">date_range</span>
                </div>
                <div>
                    <h4 class="font-bold text-lg">Open Daily</h4>
                    <p class="text-white/70 text-xs">08:00 - 23:00</p>
                </div>
            </div>
            
            <!-- Small Card 4: Pro Facilities -->
            <div class="bento-card col-span-1 p-6 flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-primary shrink-0">
                    <span class="material-symbols-outlined">award_star</span>
                </div>
                <div>
                    <h4 class="font-bold text-primary text-sm">Pro Standards</h4>
                    <p class="text-text/60 text-xs">Premium flooring & lighting</p>
                </div>
            </div>
            
            <!-- Small Card 5: Comfort -->
            <div class="bento-card col-span-1 md:col-span-2 p-6 flex items-center gap-4 bg-[url('https://images.unsplash.com/photo-1596328329606-44439050d535?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center relative overflow-hidden text-white">
                <div class="absolute inset-0 bg-primary/80"></div>
                <div class="relative z-10 flex items-center gap-4 w-full">
                    <div class="w-12 h-12 glass-panel-dark rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined">sentiment_very_satisfied</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Comfortable Environment</h4>
                        <p class="text-white/80 text-xs mt-1 max-w-sm">Spacious waiting areas, clean amenities, and a welcoming atmosphere for your team and family.</p>
                    </div>
                </div>
            </div>
            <!-- Small Futsal -->
            <div class="bento-card col-span-1 p-6 flex flex-col justify-center items-start bg-gradient-to-br from-white to-green-50 relative overflow-hidden group">
                <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                    <span class="w-6 h-6 material-symbols-outlined"> sports_and_outdoors</span>
                </div>
                <h3 class="text-3xl font-bold text-primary mb-1">2</h3>
                <p class="text-text font-medium text-sm">Futsal Courts</p>
                <div class="absolute -right-4 -bottom-4 opacity-5">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle></svg>
                </div>
            </div>

            <!-- Small Badminton -->
            <div class="bento-card col-span-1 p-6 flex flex-col justify-center items-start bg-gradient-to-br from-white to-green-50 relative overflow-hidden group">
                <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                    <span class="w-6 h-6 material-symbols-outlined"> badminton</span>
                </div>
                <h3 class="text-3xl font-bold text-primary mb-1">3</h3>
                <p class="text-text font-medium text-sm">Badminton Courts</p>
                <div class="absolute -right-4 -bottom-4 opacity-5">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2z"></path></svg>
                </div>
            </div>
        </section>

        <!-- 3. About Bento Section -->
        <section id="about" class="mt-16">
            <div class="flex items-center gap-4 mb-6 px-2">
                <div class="w-2 h-8 bg-secondary rounded-full"></div>
                <h2 class="text-3xl font-bold text-primary">Discover SM Sport Center</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Large Image Card -->
                <div class="bento-card col-span-1 md:col-span-1 h-64 md:h-full relative group">
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2084&auto=format&fit=crop" alt="Community" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                
                <!-- Text Card -->
                <div class="bento-card col-span-1 md:col-span-2 p-8 md:p-12 flex flex-col justify-center bg-white">
                    <h3 class="text-sm font-bold text-secondary uppercase tracking-wider mb-2">Our Mission</h3>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">Elevating Your Active Lifestyle</h2>
                    <p class="text-text/80 text-lg leading-relaxed mb-8">
                        We believe that a healthy lifestyle starts with the right environment. SM Sport Center is dedicated to providing modern, well-maintained, and professional sports facilities that inspire you to move, play, and connect with your community.
                    </p>
                    
                    <!-- Small Feature Grid inside Text Card -->
                    <div class="grid grid-cols-2 gap-4 mt-auto">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="font-semibold text-sm text-primary">Quality Courts</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="font-semibold text-sm text-primary">Friendly Service</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="font-semibold text-sm text-primary">Safe Environment</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center text-highlight">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-semibold text-sm text-primary">Easy Online Reservation</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Facilities Bento Grid -->
        <section id="facilities" class="mt-16">
            <div class="flex items-center gap-4 mb-6 px-2">
                <div class="w-2 h-8 bg-secondary rounded-full"></div>
                <h2 class="text-3xl font-bold text-primary">Premium Facilities</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Futsal Large Card -->
                <div class="bento-card h-[400px] relative group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1587329310686-91414b8e3cb7?q=80&w=2071&auto=format&fit=crop" alt="Futsal Court" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8 w-full text-white">
                        <div class="flex justify-between items-end">
                            <div>
                                <h3 class="text-3xl font-bold mb-2">Futsal Courts</h3>
                                <ul class="space-y-1 text-sm text-white/80">
                                    <li>✓ Premium synthetic turf</li>
                                    <li>✓ Indoor environment</li>
                                    <li>✓ Standard LED lighting</li>
                                </ul>
                            </div>
                            <div class="w-12 h-12 glass-panel rounded-full flex items-center justify-center text-white transform transition-transform group-hover:translate-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Badminton Large Card -->
                <div class="bento-card h-[400px] relative group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1551280857-2b9eb02029b4?q=80&w=2070&auto=format&fit=crop" alt="Badminton Court" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8 w-full text-white">
                        <div class="flex justify-between items-end">
                            <div>
                                <h3 class="text-3xl font-bold mb-2">Badminton Courts</h3>
                                <ul class="space-y-1 text-sm text-white/80">
                                    <li>✓ Professional flooring</li>
                                    <li>✓ Bright, anti-glare courts</li>
                                    <li>✓ Comfortable atmosphere</li>
                                </ul>
                            </div>
                            <div class="w-12 h-12 glass-panel rounded-full flex items-center justify-center text-white transform transition-transform group-hover:translate-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Why Choose Us (6 Equal Cards) -->
        <section class="mt-16">
            <div class="flex items-center gap-4 mb-6 px-2">
                <div class="w-2 h-8 bg-secondary rounded-full"></div>
                <h2 class="text-3xl font-bold text-primary">Why Choose Us</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bento-card p-6 flex flex-col items-start hover:-translate-y-2">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-secondary mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-primary mb-2">Professional Standard</h4>
                    <p class="text-text/70 text-sm">Courts and equipment maintained to meet professional sporting criteria.</p>
                </div>
                <!-- Card 2 -->
                <div class="bento-card p-6 flex flex-col items-start hover:-translate-y-2">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-secondary mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-primary mb-2">Clean Facilities</h4>
                    <p class="text-text/70 text-sm">Rigorous daily cleaning protocols ensuring a hygienic and fresh environment.</p>
                </div>
                <!-- Card 3 -->
                <div class="bento-card p-6 flex flex-col items-start hover:-translate-y-2">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-highlight mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-primary mb-2">Easy Online Booking</h4>
                    <p class="text-text/70 text-sm">A supporting service to easily secure your court from your phone.</p>
                </div>
                <!-- Card 4 -->
                <div class="bento-card p-6 flex flex-col items-start hover:-translate-y-2">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-secondary mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-primary mb-2">Real-Time Availability</h4>
                    <p class="text-text/70 text-sm">Transparent scheduling system so you know exactly when courts are open.</p>
                </div>
                <!-- Card 5 -->
                <div class="bento-card p-6 flex flex-col items-start hover:-translate-y-2">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-secondary mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-primary mb-2">Affordable Pricing</h4>
                    <p class="text-text/70 text-sm">Experience premium sports infrastructure at highly competitive rates.</p>
                </div>
                <!-- Card 6 -->
                <div class="bento-card p-6 flex flex-col items-start hover:-translate-y-2">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-secondary mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-primary mb-2">Friendly Staff</h4>
                    <p class="text-text/70 text-sm">Our community-focused team is always ready to assist and welcome you.</p>
                </div>
            </div>
        </section>

        <!-- 6. Pinterest-style Bento Masonry Gallery -->
        <section id="gallery" class="mt-16">
            <div class="flex justify-between items-end mb-6 px-2">
                <div>
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-2 h-8 bg-secondary rounded-full"></div>
                        <h2 class="text-3xl font-bold text-primary">Gallery</h2>
                    </div>
                    <p class="text-text/70">A glimpse into our vibrant and active community.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[150px]">
                <div class="bento-card col-span-2 row-span-2 group">
                    <img src="https://images.unsplash.com/photo-1542652735873-fb2825bac6e2?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Action">
                </div>
                <div class="bento-card col-span-1 row-span-1 group">
                    <img src="https://images.unsplash.com/photo-1596328329606-44439050d535?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Waiting Area">
                </div>
                <div class="bento-card col-span-1 row-span-2 group">
                    <img src="https://images.unsplash.com/photo-1551280857-2b9eb02029b4?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Badminton Court">
                </div>
                <div class="bento-card col-span-1 row-span-2 group">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Reception">
                </div>
                <div class="bento-card col-span-2 row-span-1 group">
                    <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?q=80&w=2071&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Futsal Court">
                </div>
            </div>
        </section>

        <!-- 7. Statistics -->
        <section class="mt-16">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bento-card p-8 text-center bg-white">
                    <h3 class="text-4xl font-bold text-primary mb-2">5</h3>
                    <p class="text-text/70 text-sm font-medium uppercase tracking-wider">Sports Courts</p>
                </div>
                <div class="bento-card p-8 text-center bg-white">
                    <h3 class="text-4xl font-bold text-primary mb-2">1000+</h3>
                    <p class="text-text/70 text-sm font-medium uppercase tracking-wider">Reservations</p>
                </div>
                <div class="bento-card p-8 text-center bg-white">
                    <h3 class="text-4xl font-bold text-primary mb-2">500+</h3>
                    <p class="text-text/70 text-sm font-medium uppercase tracking-wider">Members</p>
                </div>
                <div class="bento-card p-8 text-center bg-white">
                    <h3 class="text-4xl font-bold text-primary mb-2">98%</h3>
                    <p class="text-text/70 text-sm font-medium uppercase tracking-wider">Satisfaction</p>
                </div>
            </div>
        </section>

        <!-- 8. Testimonials -->
        <section class="mt-16">
            <div class="flex items-center gap-4 mb-6 px-2">
                <div class="w-2 h-8 bg-secondary rounded-full"></div>
                <h2 class="text-3xl font-bold text-primary">Community Voices</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bento-card p-8 flex flex-col justify-between">
                    <div>
                        <div class="text-highlight text-lg mb-4">★★★★★</div>
                        <p class="text-text/80 italic mb-6">"The atmosphere here is incredible. The courts are well-maintained, and the whole facility feels very premium. It's our go-to spot every weekend."</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1974&auto=format&fit=crop" class="w-10 h-10 rounded-full object-cover" alt="User">
                        <div>
                            <h4 class="font-bold text-sm text-primary">Alex M.</h4>
                            <p class="text-xs text-text/60">Futsal Player</p>
                        </div>
                    </div>
                </div>
                <div class="bento-card p-8 flex flex-col justify-between">
                    <div>
                        <div class="text-highlight text-lg mb-4">★★★★★</div>
                        <p class="text-text/80 italic mb-6">"Clean, safe, and very professional. Being able to reserve our court online beforehand just adds to the overall great experience."</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop" class="w-10 h-10 rounded-full object-cover" alt="User">
                        <div>
                            <h4 class="font-bold text-sm text-primary">Sarah K.</h4>
                            <p class="text-xs text-text/60">Badminton Enthusiast</p>
                        </div>
                    </div>
                </div>
                <div class="bento-card p-8 flex flex-col justify-between">
                    <div>
                        <div class="text-highlight text-lg mb-4">★★★★★</div>
                        <p class="text-text/80 italic mb-6">"The flooring on the badminton courts is top tier. You can tell they actually care about the quality of the sport, not just renting space."</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2070&auto=format&fit=crop" class="w-10 h-10 rounded-full object-cover" alt="User">
                        <div>
                            <h4 class="font-bold text-sm text-primary">Daniel W.</h4>
                            <p class="text-xs text-text/60">Local Athlete</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 9. CTA Section -->
        <section class="mt-16">
            <div class="bento-card bg-gradient-to-br from-primary to-secondary p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-accent/30 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white/20 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 max-w-2xl mx-auto text-white">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Stay Active. Stay Healthy.</h2>
                    <p class="text-white/90 text-lg mb-10 leading-relaxed font-light">
                        Join hundreds of sports enthusiasts at SM Sport Center and enjoy premium facilities designed for comfort, safety, and peak performance.
                    </p>
                    <a href="{{ route('register') }}" class="inline-block bg-white text-primary hover:bg-background px-10 py-4 rounded-xl font-bold text-lg transition-transform hover:-translate-y-1 shadow-lg">
                        Explore SM Sport Center
                    </a>
                </div>
            </div>
        </section>

        <!-- 10. Footer within Grid constraint -->
        <footer class="mt-16 bento-card p-10 bg-white">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 border-b border-gray-100 pb-10">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-sm">SM</div>
                        <span class="font-bold text-lg text-primary">Sport Center</span>
                    </div>
                    <p class="text-sm text-text/70 leading-relaxed mb-6">
                        Providing modern, comfortable, and professional sports facilities to encourage a healthy lifestyle.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-8 h-8 bg-background rounded-full flex items-center justify-center text-primary hover:bg-secondary hover:text-white transition-colors">FB</a>
                        <a href="#" class="w-8 h-8 bg-background rounded-full flex items-center justify-center text-primary hover:bg-secondary hover:text-white transition-colors">IG</a>
                        <a href="#" class="w-8 h-8 bg-background rounded-full flex items-center justify-center text-primary hover:bg-secondary hover:text-white transition-colors">TW</a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-primary mb-4">Quick Links</h4>
                    <ul class="space-y-3 text-sm text-text/70">
                        <li><a href="#" class="hover:text-primary transition-colors">Home</a></li>
                        <li><a href="#about" class="hover:text-primary transition-colors">About Us</a></li>
                        <li><a href="#facilities" class="hover:text-primary transition-colors">Facilities</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-primary transition-colors">Login / Register</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-primary mb-4">Contact Info</h4>
                    <ul class="space-y-3 text-sm text-text/70">
                        <li>📍 123 Health Avenue, City</li>
                        <li>📞 +62 812 3456 7890</li>
                        <li>✉️ hello@smsport.com</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-primary mb-4">Opening Hours</h4>
                    <ul class="space-y-3 text-sm text-text/70">
                        <li>Monday - Friday: 08:00 - 23:00</li>
                        <li>Saturday - Sunday: 07:00 - 23:00</li>
                    </ul>
                    <div class="w-full h-16 bg-background rounded-xl mt-4 flex items-center justify-center text-xs text-text/40 border border-gray-100">
                        [Google Maps Preview]
                    </div>
                </div>
            </div>
            <div class="pt-6 text-center text-xs text-text/50">
                <p>&copy; 2026 SM Sport Center. All rights reserved.</p>
            </div>
        </footer>

    </div>
</body>
</html>