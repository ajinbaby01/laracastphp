<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <?php foreach ($notes as $note): ?>
            <ul>
                <li>
                    <a class="text-blue-500 underline" href="note?id=<?= $note['id'] ?>">
                        <?= $note['body']; ?>
                    </a>
                </li>
            </ul>
        <?php endforeach; ?>

        <p class="mt-6">
            <a class="text-blue-500 underline" href="notes/create">Create a new note</a>
        </p>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
