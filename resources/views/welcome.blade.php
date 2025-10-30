<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black font-sans antialiased overflow-hidden">
    <!-- Gradient Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-zinc-950 via-black to-zinc-900">
        <!-- Animated Mesh Gradient -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute left-1/4 top-1/4 size-96 animate-pulse rounded-full bg-white/5 blur-3xl"></div>
            <div class="absolute right-1/4 top-1/3 size-96 animate-pulse rounded-full bg-white/5 blur-3xl delay-1000"></div>
            <div class="absolute bottom-1/4 left-1/3 size-96 animate-pulse rounded-full bg-white/5 blur-3xl delay-2000"></div>
        </div>
        
        <!-- Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        
        <!-- Interactive Light Orb -->
        <div 
            x-data="{ x: 0, y: 0 }" 
            x-init="
                window.addEventListener('mousemove', (e) => {
                    x = e.clientX;
                    y = e.clientY;
                });
            "
            class="pointer-events-none"
        >
            <div 
                :style="`left: ${x}px; top: ${y}px;`"
                class="absolute -translate-x-1/2 -translate-y-1/2 transition-all duration-300 ease-out"
            >
                <div class="size-[600px] rounded-full bg-white/10 blur-[120px]"></div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="relative z-10 flex min-h-screen items-center justify-center px-4 py-12">
        <div 
            x-data="mouseTracker()" 
            x-init="init()"
            @mousemove.window="updateMouse($event)"
            class="mx-auto w-full max-w-6xl text-center"
        >
            <!-- Main Heading -->
            <div class="mb-12 space-y-8">
                <h1 
                    x-ref="title"
                    class="text-2xl font-bold tracking-tight text-white md:text-4xl lg:text-5xl xl:text-6xl"
                    style="font-family: 'Press Start 2P', monospace;"
                >
                    Hi, I'm <br class="md:hidden">
                    <span 
                        x-ref="name"
                        :style="`background: linear-gradient(${gradientAngle}deg, 
                            rgb(${color1.r}, ${color1.g}, ${color1.b}), 
                            rgb(${color2.r}, ${color2.g}, ${color2.b}), 
                            rgb(${color3.r}, ${color3.g}, ${color3.b})); 
                            -webkit-background-clip: text; 
                            background-clip: text;`"
                        class="inline-block bg-clip-text text-transparent transition-all duration-500"
                    >
                        Ricardo Uemura
                    </span>
                </h1>
                
                <!-- Animated Subtitle -->
                <div 
                    x-data="typewriter()" 
                    x-init="start()"
                    x-ref="subtitle"
                    class="flex h-8 items-center justify-center text-sm text-zinc-400 md:h-10 md:text-base lg:h-12 lg:text-lg"
                    style="font-family: 'Press Start 2P', monospace;"
                >
                    <span x-text="displayText" class="font-normal"></span>
                    <span class="ml-1 animate-blink">|</span>
                </div>
            </div>
            
            <!-- Social Links -->
            <div x-ref="buttons" class="mt-20">
                @livewire('social-links')
            </div>
        </div>
    </div>

    <!-- Floating Particles -->
    <div class="pointer-events-none fixed inset-0">
        <div class="absolute left-[10%] top-[20%] size-2 animate-float rounded-full bg-white/20"></div>
        <div class="absolute left-[80%] top-[40%] size-2 animate-float rounded-full bg-white/20 delay-1000"></div>
        <div class="absolute left-[30%] top-[60%] size-2 animate-float rounded-full bg-white/20 delay-2000"></div>
        <div class="absolute left-[70%] top-[70%] size-2 animate-float rounded-full bg-white/20 delay-500"></div>
        <div class="absolute left-[50%] top-[30%] size-2 animate-float rounded-full bg-white/20 delay-1500"></div>
        <div class="absolute left-[15%] top-[80%] size-2 animate-float rounded-full bg-white/30 delay-700"></div>
        <div class="absolute left-[85%] top-[15%] size-2 animate-float rounded-full bg-white/30 delay-1200"></div>
        <div class="absolute left-[40%] top-[40%] size-2 animate-float rounded-full bg-white/25 delay-1800"></div>
    </div>

    <style>
        @keyframes pulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.5; }
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0px);
                opacity: 0.2;
            }
            50% { 
                transform: translateY(-20px);
                opacity: 0.6;
            }
        }
        
        .animate-pulse { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .animate-blink { animation: blink 1s infinite; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        
        .delay-500 { animation-delay: 0.5s; }
        .delay-700 { animation-delay: 0.7s; }
        .delay-1000 { animation-delay: 1s; }
        .delay-1200 { animation-delay: 1.2s; }
        .delay-1500 { animation-delay: 1.5s; }
        .delay-1800 { animation-delay: 1.8s; }
        .delay-2000 { animation-delay: 2s; }
    </style>

    <script>
        function mouseTracker() {
            return {
                mouseX: 0,
                mouseY: 0,
                gradientAngle: 135,
                color1: { r: 255, g: 255, b: 255 },
                color2: { r: 200, g: 200, b: 200 },
                color3: { r: 150, g: 150, b: 150 },
                
                init() {
                    this.animate();
                },
                
                updateMouse(e) {
                    this.mouseX = e.clientX / window.innerWidth;
                    this.mouseY = e.clientY / window.innerHeight;
                },
                
                animate() {
                    // Ângulo do gradiente reativo ao mouse
                    this.gradientAngle = 90 + (this.mouseX * 180);
                    
                    // Cores reativas à posição do mouse
                    this.color1 = {
                        r: Math.floor(200 + (this.mouseX * 55)),
                        g: Math.floor(200 + (this.mouseY * 55)),
                        b: Math.floor(200 + ((1 - this.mouseX) * 55))
                    };
                    
                    this.color2 = {
                        r: Math.floor(150 + (this.mouseY * 105)),
                        g: Math.floor(150 + ((1 - this.mouseX) * 105)),
                        b: Math.floor(150 + (this.mouseX * 105))
                    };
                    
                    this.color3 = {
                        r: Math.floor(100 + ((1 - this.mouseY) * 100)),
                        g: Math.floor(100 + (this.mouseX * 100)),
                        b: Math.floor(100 + (this.mouseY * 100))
                    };
                    
                    // Parallax reduzido nos elementos
                    if (this.$refs.title) {
                        const titleX = (this.mouseX - 0.5) * 8;
                        const titleY = (this.mouseY - 0.5) * 8;
                        this.$refs.title.style.transform = `translate(${titleX}px, ${titleY}px)`;
                    }
                    
                    if (this.$refs.subtitle) {
                        const subtitleX = (this.mouseX - 0.5) * 12;
                        const subtitleY = (this.mouseY - 0.5) * 12;
                        this.$refs.subtitle.style.transform = `translate(${subtitleX}px, ${subtitleY}px)`;
                    }
                    
                    if (this.$refs.buttons) {
                        const buttonsX = (this.mouseX - 0.5) * 15;
                        const buttonsY = (this.mouseY - 0.5) * 15;
                        this.$refs.buttons.style.transform = `translate(${buttonsX}px, ${buttonsY}px)`;
                    }
                    
                    requestAnimationFrame(() => this.animate());
                }
            };
        }

        function typewriter() {
            return {
                phrases: [
                    'Backend Developer',
                    'Tech Enthusiast', 
                    'Problem Solver',
                    'Internship Developer',
                ],
                currentPhraseIndex: 0,
                displayText: '',
                isDeleting: false,
                charIndex: 0,
                typeSpeed: 100,
                deleteSpeed: 50,
                pauseTime: 2000,
                
                start() {
                    this.type();
                },
                
                type() {
                    const currentPhrase = this.phrases[this.currentPhraseIndex];
                    
                    if (this.isDeleting) {
                        this.displayText = currentPhrase.substring(0, this.charIndex - 1);
                        this.charIndex--;
                        
                        if (this.charIndex === 0) {
                            this.isDeleting = false;
                            this.currentPhraseIndex = (this.currentPhraseIndex + 1) % this.phrases.length;
                            setTimeout(() => this.type(), 500);
                            return;
                        }
                        
                        setTimeout(() => this.type(), this.deleteSpeed);
                    } else {
                        this.displayText = currentPhrase.substring(0, this.charIndex + 1);
                        this.charIndex++;
                        
                        if (this.charIndex === currentPhrase.length) {
                            this.isDeleting = true;
                            setTimeout(() => this.type(), this.pauseTime);
                            return;
                        }
                        
                        setTimeout(() => this.type(), this.typeSpeed);
                    }
                }
            };
        }
    </script>
</body>
</html>