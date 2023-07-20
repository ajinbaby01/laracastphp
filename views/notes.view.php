<?php require 'views/partials/head.php' ?>
<?php require 'views/partials/nav.php'; ?>
<?php require 'views/partials/banner.php' ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <?php foreach ($notes as $note): ?>
            <li>
                <a class="text-blue-500 underline" href="note?id=<?= $note['id'] ?>">
                    <?= $note['body'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </div>
</main>

<?php require 'views/partials/footer.php' ?>
