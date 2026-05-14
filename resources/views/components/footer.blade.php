<div class="border-t border-[var(--color-frame)] bg-[var(--color-canvas)]">
    <div class="container-main py-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="mono-label text-[var(--color-gray)] text-[11px] tracking-[1.1px]">
                &copy; {{ date('Y') }} {{ config('portfolio.owner.name', 'Portfolio') }}
            </p>
            <p class="mono-label text-[var(--color-gray)] text-[11px] tracking-[1.1px]">
                Built with Laravel & Tailwind CSS
            </p>
        </div>
    </div>
</div>
