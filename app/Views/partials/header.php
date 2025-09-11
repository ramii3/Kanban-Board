<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kanban-Board</title>
    <link rel="icon" href="<?= base_url('06_-_WE_Logo.svg') ?>" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">
</head>

<body class="wrapper">
<nav class="navbar navbar-expand-lg" style="background-color: #24292d;">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <a class="navbar-brand" href="<?= base_url('HauptController/tasks') ?>">
                <img src="<?= base_url('06_-_WE_Logo.svg') ?>" alt="Logo" style="max-height: 100%; height: 1.5em;">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('HauptController/tasks') ?>">Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('HauptController/board') ?>">Boards</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('HauptController/spalte') ?>">Spalten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('HauptController/personen') ?>">Personen</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>
