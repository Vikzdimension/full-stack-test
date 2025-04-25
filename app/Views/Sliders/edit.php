<?php
$slider = $data['slider'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="../index.php">WPoets Test</a>
            <div class="ms-auto">
                <a href="/sliders" class="btn btn-outline-secondary me-2">Back to List</a>
                <a href="/" class="btn btn-outline-primary">View Public</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="sliders.php">Sliders</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
            </ol>
        </nav>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h2 class="card-title mb-4">Edit Slider</h2>

                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($slider['id']) ?>">

                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" id="title" name="title" class="form-control"
                                value="<?= htmlspecialchars($slider['title']) ?>" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea id="description" name="description" class="form-control" rows="4"
                                required><?= htmlspecialchars($slider['description']) ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            <div class="mt-2">
                                <img src="/files/images/<?= htmlspecialchars($slider['image']) ?>" alt="Current image"
                                    class="img-thumbnail" style="max-width:150px;">
                            </div>
                            <small class="text-muted">Leave blank to keep existing</small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select id="status" name="status" class="form-select" required>
                                <option value="active" <?= $slider['status'] === 'active' ? 'selected' : '' ?>>Active
                                </option>
                                <option value="inactive" <?= $slider['status'] === 'inactive' ? 'selected' : '' ?>>
                                    Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>