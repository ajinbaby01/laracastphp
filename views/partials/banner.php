<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
            <?php if (isUrl('/laracastphp/')): ?>
                Home
            <?php elseif (isUrl('/laracastphp/about')): ?>
                About
            <?php elseif (isUrl('/laracastphp/notes')): ?>
                Notes
            <?php elseif (isUrl('/laracastphp/contact')): ?>
                Contact
            <?php endif; ?>
        </h1>
    </div>
</header>
