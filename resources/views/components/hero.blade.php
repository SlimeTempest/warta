@props(['titles' => ['efektif', 'transparan', 'terpercaya', 'cepat', 'modern']])

<div class="w-full relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-cyan-50" x-data="{
    titles: {{ json_encode($titles) }},
    currentTitleIndex: 0,
    init() {
        setInterval(() => {
            if (this.currentTitleIndex === this.titles.length - 1) {
                this.currentTitleIndex = 0;
            } else {
                this.currentTitleIndex = this.currentTitleIndex + 1;
            }
        }, 2000);
    }
}">
    <!-- Background decoration -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-cyan-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="container mx-auto relative z-10">
        <div class="flex gap-8 py-20 lg:py-32 items-center justify-center flex-col">
            <div class="animate-fade-in">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-white/80 backdrop-blur-sm hover:bg-white border border-gray-200/50 text-gray-700 px-5 py-2.5 text-sm font-medium transition-all hover:shadow-lg hover:scale-105">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Platform Laporan Terpercaya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
            
            <div class="flex gap-6 flex-col text-center animate-fade-in-up">
                <h1 class="text-5xl md:text-7xl lg:text-8xl max-w-4xl tracking-tight font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-cyan-600 to-purple-600">
                    Sistem Laporan
                    <span class="relative flex w-full justify-center overflow-hidden text-center md:pb-4 md:pt-1 h-20 md:h-24 lg:h-28">
                        <template x-for="(title, index) in titles" :key="index">
                            <span 
                                class="absolute font-bold transition-all duration-500 ease-in-out bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-600"
                                :class="{
                                    'opacity-100 translate-y-0 scale-100': currentTitleIndex === index,
                                    'opacity-0 -translate-y-full scale-95': currentTitleIndex > index,
                                    'opacity-0 translate-y-full scale-95': currentTitleIndex < index
                                }"
                                x-text="title"
                            ></span>
                        </template>
                    </span>
                </h1>
                <p class="text-lg md:text-xl lg:text-2xl leading-relaxed tracking-tight text-gray-700 max-w-3xl mx-auto font-medium">
                    Laporkan masalah di lingkungan Anda dengan mudah dan cepat. 
                    Sistem yang transparan, terpercaya, dan responsif untuk kemajuan bersama.
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up animation-delay-200">
                <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center gap-3 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-8 py-4 text-base font-semibold transition-all shadow-lg hover:shadow-xl hover:scale-105 overflow-hidden">
                    <span class="relative z-10">Mulai Laporkan</span>
                    <svg class="w-5 h-5 relative z-10 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-3 rounded-xl border-2 border-gray-300 bg-white/80 backdrop-blur-sm hover:bg-white hover:border-gray-400 text-gray-700 px-8 py-4 text-base font-semibold transition-all shadow-md hover:shadow-lg hover:scale-105">
                    Masuk
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    @keyframes fade-in {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out;
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out;
    }
</style>
@endpush


