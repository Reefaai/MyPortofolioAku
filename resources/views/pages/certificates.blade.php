@extends('layouts.app')

@section('title', 'Certificates - Portfolio')

@section('content')
<section class="container-main py-12 md:py-20">

    {{-- Page Header --}}
    <div class="mb-16 max-w-2xl animate-fade-in-up" style="animation-delay: 0.1s">
        <p class="mono-label text-[var(--color-mint)] mb-4">Achievements</p>
        <h1 class="font-[var(--font-display)] text-[42px] md:text-[64px] text-[var(--color-white)] leading-[0.95] uppercase mb-6">
            Certificates
        </h1>
        <p class="font-[var(--font-sans)] text-[16px] md:text-[18px] text-[var(--color-gray)] leading-relaxed">
            Sertifikasi dan pencapaian yang sudah saya raih selama perjalanan belajar.
        </p>
    </div>

    @if (empty($certificates))
        <div class="pill-feature bg-[var(--color-surface)] border border-[var(--color-frame)] p-12 text-center animate-fade-in-up">
            <svg class="w-16 h-16 mx-auto mb-4 text-[var(--color-frame)]" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
            <p class="font-[var(--font-sans)] text-[18px] text-[var(--color-gray)]">Belum ada sertifikat yang ditambahkan.</p>
        </div>
    @else
        {{-- Stats bar --}}
        <div class="flex flex-wrap gap-6 mb-12 pb-8 border-b border-[var(--color-frame)] animate-fade-in-up" style="animation-delay: 0.3s">
            <div class="flex items-center gap-3">
                <span class="font-[var(--font-display)] text-[32px] text-[var(--color-mint)] leading-none">{{ count($certificates) }}</span>
                <span class="mono-label text-[var(--color-gray)]">Total Sertifikat</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="font-[var(--font-display)] text-[32px] text-[var(--color-mint)] leading-none">{{ count(array_unique(array_column($certificates, 'issuer'))) }}</span>
                <span class="mono-label text-[var(--color-gray)]">Penerbit</span>
            </div>
        </div>

        {{-- Certificate Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($certificates as $index => $certificate)
                <div class="animate-on-scroll group relative pill-feature bg-[var(--color-surface)] border border-[var(--color-frame)] overflow-hidden hover:border-[var(--color-mint)] transition-all duration-300 hover:shadow-[0_0_40px_rgba(60,255,208,0.08)] hover:-translate-y-2 flex flex-col" style="transition-delay: {{ $index * 80 }}ms">

                    {{-- Image section --}}
                    @if (!empty($certificate['image']))
                        <div class="relative overflow-hidden">
                            <img
                                src="{{ asset($certificate['image']) }}"
                                alt="Sertifikat {{ $certificate['name'] }}"
                                class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                                loading="lazy"
                            >
                            {{-- Overlay gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-surface)] via-transparent to-transparent opacity-60"></div>

                            {{-- Year badge --}}
                            <div class="absolute top-4 right-4 bg-[var(--color-canvas)]/90 backdrop-blur-sm border border-[var(--color-frame)] rounded-full px-3 py-1">
                                <span class="mono-label text-[var(--color-mint)]">{{ $certificate['year'] }}</span>
                            </div>
                        </div>
                    @else
                        {{-- Placeholder when no image --}}
                        <div class="relative h-52 bg-gradient-to-br from-[var(--color-canvas)] to-[var(--color-surface)] flex items-center justify-center">
                            <svg class="w-16 h-16 text-[var(--color-frame)] group-hover:text-[var(--color-mint)] transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                            {{-- Year badge --}}
                            <div class="absolute top-4 right-4 bg-[var(--color-canvas)]/90 backdrop-blur-sm border border-[var(--color-frame)] rounded-full px-3 py-1">
                                <span class="mono-label text-[var(--color-mint)]">{{ $certificate['year'] }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Content --}}
                    <div class="p-6 flex flex-col flex-1">
                        {{-- Issuer --}}
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-2 h-2 rounded-full bg-[var(--color-mint)]"></div>
                            <p class="mono-label text-[var(--color-gray)]">
                                {{ $certificate['issuer'] }}
                            </p>
                        </div>

                        {{-- Certificate Name --}}
                        <h2 class="font-[var(--font-sans)] text-[18px] md:text-[20px] font-bold text-[var(--color-white)] mb-4 leading-tight group-hover:text-[var(--color-mint)] transition-colors duration-300">
                            {{ $certificate['name'] }}
                        </h2>

                        {{-- Spacer --}}
                        <div class="flex-1"></div>

                        {{-- Verification Link --}}
                        @if (!empty($certificate['verification_url']))
                            <a href="{{ $certificate['verification_url'] }}" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 mt-4 pt-4 border-t border-[var(--color-frame)] mono-label text-[var(--color-mint)] hover:text-[var(--color-link-hover)] transition-colors duration-150 group/link">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                </svg>
                                <span>Verify Certificate</span>
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</section>
@endsection
