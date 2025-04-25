<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Manage Sliders</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwF…" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="../index.php">WPoets Test</a>
            <div class="ms-auto">
                <a href="/" class="btn btn-outline-secondary me-2">View Public</a>
                <a href="/sliders/create" class="btn btn-primary">+ New Slider</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (!empty($data['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= htmlspecialchars($data['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif ?>

        <h1 class="mb-4">All Sliders</h1>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['sliders'] as $i => $s): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($s['title']) ?></td>
                                <td><?= htmlspecialchars($s['description']) ?></td>
                                <td>
                                    <img src="/files/images/<?= htmlspecialchars($s['image']) ?>" alt=""
                                        class="img-thumbnail" style="max-width:80px;">
                                </td>
                                <td>
                                    <span
                                        class="badge <?= $s['status'] === 'active' ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= ucfirst(htmlspecialchars($s['status'])) ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/sliders/edit/<?= htmlspecialchars($s['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        class="btn btn-secondary btn-sm me-2">Edit</a>
                                    <form
                                        action="/sliders/delete/<?= htmlspecialchars($s['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        method="POST" style="display: inline;"
                                        onsubmit="return confirm('Delete this slider?');">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach ?>

                            <?php if (empty($data['sliders'])): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    No sliders found. <a href="/sliders/create">Create one now</a>.
                                </td>
                            </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>