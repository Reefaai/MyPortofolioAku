@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
{{-- Hero Section with staggered entrance animations --}}
<section class="container-main py-16 md:py-24 lg:py-32 overflow-hidden">
    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-12 lg:gap-16">
        {{-- Text Content --}}
        <div class="flex-1 text-center lg:text-left">
            {{-- Eyebrow with typing effect --}}
            <p class="animate-fade-in-up font-[var(--font-sans)] text-[19px] font-light uppercase tracking-[1.9px] text-[var(--color-gray)] mb-6" style="animation-delay: 0.1s">
                Full-Stack Developer
            </p>

            {{-- Hero Display Name with glitch-style reveal --}}
            <h1 class="animate-fade-in-up font-display text-[48px] sm:text-[60px] md:text-[80px] lg:text-[107px] text-[var(--color-white)] tracking-[1.07px] mb-6" style="animation-delay: 0.3s">
                {{ $owner['name'] }}
            </h1>

            {{-- Tagline --}}
            <p class="animate-fade-in-up font-[var(--font-sans)] text-[16px] md:text-[20px] font-medium leading-[1.6] text-[var(--color-muted)] mb-10 max-w-xl mx-auto lg:mx-0" style="animation-delay: 0.5s">
                {{ $owner['tagline'] }}
            </p>

            {{-- CTA Buttons --}}
            <div class="animate-fade-in-up flex flex-wrap gap-4 justify-center lg:justify-start" style="animation-delay: 0.7s">
                <a href="{{ route('projects') }}" class="btn-primary hover:opacity-80 hover:shadow-[0_0_0_1px_var(--color-frame)] hover:scale-105 transition-transform duration-200">
                    View Projects
                </a>
                <a href="{{ route('about') }}" class="btn-outlined hover:bg-[var(--color-mint)] hover:text-[var(--color-black)] hover:scale-105 transition-transform duration-200">
                    About Me
                </a>
            </div>
        </div>

        {{-- Profile Photo with float animation --}}
        <div class="flex-shrink-0 animate-fade-in-up" style="animation-delay: 0.4s">
            <div class="relative group">
                {{-- Decorative ring --}}
                <div class="absolute -inset-3 rounded-[28px] border border-[var(--color-mint)] opacity-20 group-hover:opacity-60 group-hover:scale-105 transition-all duration-500"></div>
                {{-- Glow effect on hover --}}
                <div class="absolute -inset-1 rounded-[26px] bg-[var(--color-mint)] opacity-0 group-hover:opacity-10 blur-xl transition-opacity duration-500"></div>
                <img
                    src="{{ asset($owner['photo']) }}"
                    alt="Foto profil {{ $owner['name'] }}"
                    class="relative w-48 h-48 md:w-64 md:h-64 lg:w-72 lg:h-72 rounded-[24px] object-cover border border-[var(--color-frame)] group-hover:border-[var(--color-mint)] transition-all duration-500 animate-float grayscale group-hover:grayscale-0"
                    style="min-width: 100px; min-height: 100px;"
                    loading="eager"
                >
            </div>
        </div>
    </div>
</section>

{{-- Scrolling Tech Marquee --}}
<section class="relative overflow-hidden py-8 border-y border-[var(--color-frame)]">
    <div class="animate-marquee flex gap-12 whitespace-nowrap">
        @foreach(['PHP', 'Laravel', 'JavaScript', 'Tailwind CSS', 'MySQL', 'Git', 'REST API', 'Java', 'Python', 'C++', 'PHP', 'Laravel', 'JavaScript', 'Tailwind CSS', 'MySQL', 'Git', 'REST API', 'Java', 'Python', 'C++'] as $tech)
            <span class="font-[var(--font-mono)] text-[14px] uppercase tracking-[1.8px] text-[var(--color-gray)] hover:text-[var(--color-mint)] transition-colors duration-150 cursor-default">{{ $tech }}</span>
        @endforeach
    </div>
</section>

{{-- Color Block Accent Tiles with scroll-triggered animations --}}
<section class="container-main py-16 md:py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Mint Accent Tile --}}
        <div class="pill-card bg-[var(--color-mint)] p-8 md:p-10 group hover:scale-[1.02] transition-transform duration-300 cursor-default animate-on-scroll">
            <p class="font-[var(--font-mono)] text-[11px] uppercase tracking-[1.5px] text-[var(--color-black)] opacity-70 mb-3">
                Currently
            </p>
            <p class="font-[var(--font-sans)] text-[24px] md:text-[32px] font-bold text-[var(--color-black)] leading-tight group-hover:tracking-wide transition-all duration-300">
                Building Bestay Web Application
            </p>
        </div>

        {{-- Ultraviolet Accent Tile --}}
        <div class="pill-card bg-[var(--color-ultraviolet)] p-8 md:p-10 group hover:scale-[1.02] transition-transform duration-300 cursor-default animate-on-scroll" style="animation-delay: 0.15s">
            <p class="font-[var(--font-mono)] text-[11px] uppercase tracking-[1.5px] text-white opacity-70 mb-3">
                Focus
            </p>
            <p class="font-[var(--font-sans)] text-[24px] md:text-[32px] font-bold text-white leading-tight group-hover:tracking-wide transition-all duration-300">
                Laravel & Full-Stack Development
            </p>
        </div>
    </div>
</section>

{{-- Stats / Quick Info Section --}}
<section class="container-main pb-16 md:pb-24">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 text-center group hover:border-[var(--color-mint)] transition-colors duration-300 animate-on-scroll">
            <p class="font-display text-[36px] md:text-[48px] text-[var(--color-mint)] mb-1 group-hover:scale-110 transition-transform duration-300 inline-block">{{ count(config('portfolio.projects', [])) }}</p>
            <p class="font-[var(--font-mono)] text-[11px] uppercase tracking-[1.5px] text-[var(--color-gray)]">Projects</p>
        </div>
        <div class="pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 text-center group hover:border-[var(--color-mint)] transition-colors duration-300 animate-on-scroll" style="animation-delay: 0.1s">
            <p class="font-display text-[36px] md:text-[48px] text-[var(--color-mint)] mb-1 group-hover:scale-110 transition-transform duration-300 inline-block">{{ count(config('portfolio.certificates', [])) }}</p>
            <p class="font-[var(--font-mono)] text-[11px] uppercase tracking-[1.5px] text-[var(--color-gray)]">Certificates</p>
        </div>
        <div class="pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 text-center group hover:border-[var(--color-mint)] transition-colors duration-300 animate-on-scroll" style="animation-delay: 0.2s">
            <p class="font-display text-[36px] md:text-[48px] text-[var(--color-mint)] mb-1 group-hover:scale-110 transition-transform duration-300 inline-block">{{ count(config('portfolio.owner.skills', [])) }}</p>
            <p class="font-[var(--font-mono)] text-[11px] uppercase tracking-[1.5px] text-[var(--color-gray)]">Skills</p>
        </div>
        <div class="pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 text-center group hover:border-[var(--color-mint)] transition-colors duration-300 animate-on-scroll" style="animation-delay: 0.3s">
            <p class="font-display text-[36px] md:text-[48px] text-[var(--color-mint)] mb-1 group-hover:scale-110 transition-transform duration-300 inline-block">4</p>
            <p class="font-[var(--font-mono)] text-[11px] uppercase tracking-[1.5px] text-[var(--color-gray)]">Semester</p>
        </div>
    </div>
</section>

{{-- Currently Learning Section --}}
@if(!empty($owner['currently_learning']))
<section class="container-main pb-16 md:pb-24">
    <div class="animate-on-scroll">
        <p class="font-[var(--font-mono)] text-[11px] uppercase tracking-[1.8px] text-[var(--color-mint)] mb-4">
            Currently Learning
        </p>
        <div class="flex flex-wrap gap-3">
            @foreach($owner['currently_learning'] as $item)
                <span class="inline-block pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] text-[var(--color-muted)] font-[var(--font-mono)] text-[12px] uppercase tracking-[1.5px] font-semibold px-5 py-3 hover:border-[var(--color-mint)] hover:text-[var(--color-mint)] transition-all duration-200 cursor-default">
                    {{ $item }}
                </span>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
