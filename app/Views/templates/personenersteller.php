<div class="container mt-4">
    <h1><?= isset($update) ? 'Person bearbeiten' : 'Neue Person erstellen' ?></h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= implode('<br>', $error) ?></div>
    <?php endif; ?>
    <form method="post" action="<?= base_url('HauptController/submitPersonen') ?>">
        <?php if (isset($update)): ?>
            <input type="hidden" name="id" value="<?= esc($update['id']) ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="vorname" class="form-label">Vorname</label>
            <input type="text" class="form-control" name="vorname" value="<?= isset($update) ? esc($update['vorname']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="<?= isset($update) ? esc($update['name']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= isset($update) ? esc($update['email']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="passwort" class="form-label">Passwort</label>
            <input type="password" class="form-control" name="passwort" <?= isset($update) ? '' : 'required' ?>>
        </div>
        <button type="submit" name="submitPerson" class="btn btn-success">Speichern</button>
        <a href="<?= base_url('HauptController/personen') ?>" class="btn btn-secondary">Zurück</a>
    </form>
</div>

