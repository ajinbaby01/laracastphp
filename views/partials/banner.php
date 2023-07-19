<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
            <?php if (isUrl('/laracastphpdemo/')): ?>
                Home
            <?php elseif (isUrl('/laracastphpdemo/about')): ?>
                About
            <?php elseif (isUrl('/laracastphpdemo/contact')): ?>
                Contact
            <?php endif; ?>
        </h1>
    </div>
</header>
