@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<section class="container-main py-24 md:py-32 text-center">
    {{-- Display 404 with glitch pulse --}}
    <h1 class="animate-fade-in-up font-display text-[80px] md:text-[120px] lg:text-[160px] text-[var(--color-mint)] mb-4 animate-pulse" style="animation-delay: 0.1s">
        404
    </h1>

    <p class="animate-fade-in-up font-[var(--font-sans)] text-[20px] md:text-[24px] font-bold text-[var(--color-white)] mb-4" style="animation-delay: 0.3s">
        Halaman tidak ditemukan
    </p>

    <p class="animate-fade-in-up font-[var(--font-sans)] text-[16px] text-[var(--color-gray)] mb-10 max-w-md mx-auto" style="animation-delay: 0.5s">
        Halaman yang Anda cari tidak ada atau telah dipindahkan.
    </p>

    <div class="animate-fade-in-up" style="animation-delay: 0.7s">
        <a href="{{ route('home') }}" class="btn-primary hover:opacity-80 hover:shadow-[0_0_0_1px_var(--color-frame)] hover:scale-105 transition-transform duration-200">
            Back to Home
        </a>
    </div>
</section>
@endsection
