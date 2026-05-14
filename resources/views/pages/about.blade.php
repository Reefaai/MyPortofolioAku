@extends('layouts.app')

@section('title', 'About - Portfolio')

@section('content')
<section class="container-main py-12 md:py-20">

    {{-- Hero Section: 2 columns --}}
    <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center mb-20">
        {{-- Left: Text intro --}}
        <div class="animate-fade-in-up" style="animation-delay: 0.1s">
            <p class="mono-label text-[var(--color-mint)] mb-4">About Me</p>
            <h1 class="font-[var(--font-display)] text-[42px] md:text-[64px] text-[var(--color-white)] leading-[0.95] uppercase mb-6">
                Ahmad<br>Rifa'i
            </h1>
            <p class="font-[var(--font-sans)] text-[18px] md:text-[20px] font-medium leading-[1.7] text-[var(--color-muted)] mb-8">
                {{ $owner['bio'] }}
            </p>
            <div class="flex flex-wrap gap-3">
                @foreach ($owner['social_links'] as $link)
                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                       class="btn-outlined hover:bg-[var(--color-mint)] hover:text-[var(--color-black)] hover:border-[var(--color-mint)] hover:scale-105 transition-transform duration-200">
                        {{ $link['platform'] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Right: Stats cards --}}
        <div class="grid grid-cols-2 gap-4 animate-fade-in-up" style="animation-delay: 0.3s">
            <div class="pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 text-center group hover:border-[var(--color-mint)] hover:scale-105 transition-all duration-300">
                <p class="font-[var(--font-display)] text-[40px] text-[var(--color-mint)] leading-none mb-2 group-hover:scale-110 transition-transform duration-300 inline-block">4</p>
                <p class="mono-label text-[var(--color-gray)]">Semester</p>
            </div>
            <div class="pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 text-center group hover:border-[var(--color-mint)] hover:scale-105 transition-all duration-300">
                <p class="font-[var(--font-display)] text-[40px] text-[var(--color-mint)] leading-none mb-2 group-hover:scale-110 transition-transform duration-300 inline-block">{{ count($owner['skills']) }}</p>
                <p class="mono-label text-[var(--color-gray)]">Skills</p>
            </div>
            <div class="pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 text-center group hover:border-[var(--color-mint)] hover:scale-105 transition-all duration-300">
                <p class="font-[var(--font-display)] text-[40px] text-[var(--color-mint)] leading-none mb-2 group-hover:scale-110 transition-transform duration-300 inline-block">{{ count(config('portfolio.projects')) }}</p>
                <p class="mono-label text-[var(--color-gray)]">Projects</p>
            </div>
            <div class="pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 text-center group hover:border-[var(--color-mint)] hover:scale-105 transition-all duration-300">
                <p class="font-[var(--font-display)] text-[40px] text-[var(--color-mint)] leading-none mb-2 group-hover:scale-110 transition-transform duration-300 inline-block">&infin;</p>
                <p class="mono-label text-[var(--color-gray)]">Kopi</p>
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="w-full h-px bg-[var(--color-frame)] mb-16"></div>

    {{-- Skills Section --}}
    <div class="mb-20 animate-on-scroll">
        <div class="flex items-center gap-4 mb-8">
            <h2 class="font-[var(--font-display)] text-[28px] md:text-[36px] text-[var(--color-white)] uppercase">Tech Stack</h2>
            <div class="flex-1 h-px bg-[var(--color-frame)]"></div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            @foreach ($owner['skills'] as $index => $skill)
                <div class="group pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-4 text-center hover:border-[var(--color-mint)] hover:shadow-[0_0_20px_rgba(60,255,208,0.1)] hover:-translate-y-1 transition-all duration-300 cursor-default" style="transition-delay: {{ $index * 30 }}ms">
                    <span class="font-[var(--font-mono)] text-[13px] font-semibold text-[var(--color-muted)] group-hover:text-[var(--color-mint)] transition-colors uppercase tracking-wide">
                        {{ $skill }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Currently Learning --}}
    @if (!empty($owner['currently_learning']))
    <div class="mb-20 animate-on-scroll">
        <div class="flex items-center gap-4 mb-8">
            <h2 class="font-[var(--font-display)] text-[28px] md:text-[36px] text-[var(--color-white)] uppercase">Currently Learning</h2>
            <div class="flex-1 h-px bg-[var(--color-frame)]"></div>
        </div>
        <div class="flex flex-wrap gap-3">
            @foreach ($owner['currently_learning'] as $topic)
                <span class="inline-flex items-center gap-2 bg-transparent border border-dashed border-[var(--color-mint)] text-[var(--color-mint)] font-[var(--font-mono)] text-[11px] uppercase tracking-[1.5px] font-semibold px-5 py-3 rounded-full hover:bg-[var(--color-mint)] hover:text-[var(--color-black)] transition-all duration-200 cursor-default">
                    <svg class="w-3 h-3 animate-pulse" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                    {{ $topic }}
                </span>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Education Timeline --}}
    <div class="mb-20 animate-on-scroll">
        <div class="flex items-center gap-4 mb-8">
            <h2 class="font-[var(--font-display)] text-[28px] md:text-[36px] text-[var(--color-white)] uppercase">Education</h2>
            <div class="flex-1 h-px bg-[var(--color-frame)]"></div>
        </div>
        <div class="space-y-4">
            @foreach ($owner['education'] as $edu)
                <div class="relative pill-card bg-[var(--color-surface)] border border-[var(--color-frame)] p-6 md:p-8 overflow-hidden hover:border-[var(--color-mint)] transition-all duration-300">
                    {{-- Active indicator --}}
                    @if (!empty($edu['status']) && $edu['status'] === 'active')
                        <div class="absolute top-4 right-4 flex items-center gap-2">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[var(--color-mint)] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-[var(--color-mint)]"></span>
                            </span>
                            <span class="mono-label text-[var(--color-mint)]">Active</span>
                        </div>
                    @endif

                    <p class="mono-label text-[var(--color-gray)] mb-3">
                        {{ $edu['year'] }}
                        @if (!empty($edu['semester']))
                            &middot; Semester {{ $edu['semester'] }}
                        @endif
                    </p>
                    <h3 class="font-[var(--font-sans)] text-[22px] md:text-[26px] font-bold text-[var(--color-white)] mb-2">
                        {{ $edu['institution'] }}
                    </h3>
                    <p class="font-[var(--font-sans)] text-[16px] text-[var(--color-muted)]">
                        {{ $edu['program'] }}
                    </p>

                    {{-- Progress bar --}}
                    @if (!empty($edu['semester']))
                        <div class="mt-5">
                            <div class="flex justify-between mb-2">
                                <span class="font-[var(--font-mono)] text-[10px] uppercase tracking-wider text-[var(--color-gray)]">Progress</span>
                                <span class="font-[var(--font-mono)] text-[10px] uppercase tracking-wider text-[var(--color-mint)]">{{ round(($edu['semester'] / 8) * 100) }}%</span>
                            </div>
                            <div class="w-full h-2 bg-[var(--color-frame)] rounded-full overflow-hidden">
                                <div class="h-full bg-[var(--color-mint)] rounded-full animate-progress-bar" style="width: {{ ($edu['semester'] / 8) * 100 }}%"></div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="animate-on-scroll pill-feature bg-[var(--color-surface)] border border-[var(--color-frame)] p-8 md:p-12 text-center hover:border-[var(--color-mint)] transition-colors duration-300">
        <h2 class="font-[var(--font-display)] text-[32px] md:text-[48px] text-[var(--color-white)] uppercase mb-4">Let's Work Together</h2>
        <p class="font-[var(--font-sans)] text-[16px] md:text-[18px] text-[var(--color-gray)] mb-8 max-w-lg mx-auto">
            Tertarik berkolaborasi atau punya project menarik? Jangan ragu untuk menghubungi saya.
        </p>
        <a href="mailto:{{ config('portfolio.owner.email') }}?subject=Hire%20Me"
           class="btn-primary text-[14px] px-8 py-4 hover:shadow-[0_0_30px_rgba(60,255,208,0.3)] hover:scale-105 transition-transform duration-200">
            Hire Me
        </a>
    </div>

</section>
@endsection
