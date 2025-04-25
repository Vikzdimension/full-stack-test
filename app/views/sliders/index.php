<?php

$message = $message ?? 'No message passed to view.';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slider Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container mt-5">
        <h1 class="text-primary"><?= $message ?? 'Welcome to Sliders Page'; ?></h1>

        <div class="row">
            <?php if (!empty($sliders)): ?>
            <?php foreach ($sliders as $slider): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= '/files/images/' . htmlspecialchars($slider['image']) ?>" class="card-img-top"
                        alt="Slider Image">

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($slider['title']) ?></h5>

                        <p class="card-text"><?= htmlspecialchars($slider['description']) ?></p>

                        <p class="text-muted">Status: <?= htmlspecialchars($slider['status']) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No sliders available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>