<div class="container mt-4">
    <h1><?= isset($update) ? 'Task bearbeiten' : 'Neuen Task erstellen' ?></h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= implode('<br>', $error) ?></div>
    <?php endif; ?>
    <form method="post" action="<?= base_url('HauptController/submitTasks') ?>">
        <?php if (isset($update)): ?>
            <input type="hidden" name="id" value="<?= esc($update['id']) ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="Task" class="form-label">Taskbeschreibung</label>
            <input type="text" class="form-control" name="Task" value="<?= isset($tasks['Task']) ? esc($tasks['Task']) : (isset($update['tasks']) ? esc($update['tasks']) : '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="Person" class="form-label">Person</label>
            <select class="form-select" name="Person" id="Person" required>
                <?php foreach ($personen as $person): ?>
                    <option value="<?= $person['id'] ?>" <?= isset($update['personenid']) && $update['personenid'] == $person['id'] ? 'selected' : '' ?>>
                        <?= esc($person['vorname'] . ' ' . $person['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="Erinnerungsdatum" class="form-label">Erinnerungsdatum</label>
            <input type="datetime-local" class="form-control" name="Erinnerungsdatum" id="Erinnerungsdatum" value="<?= isset($tasks['Erinnerungsdatum']) ? esc($tasks['Erinnerungsdatum']) : (isset($update['erinnerungsdatum']) ? esc(substr($update['erinnerungsdatum'], 0, 16)) : '') ?>">
        </div>
        <div class="mb-3">
            <label for="Erinnerung" class="form-label">Erinnerung</label>
            <select class="form-select" name="Erinnerung" id="Erinnerung" required>
                <option value="0" <?= isset($update['erinnerung']) && $update['erinnerung'] == 0 ? 'selected' : '' ?>>Nein</option>
                <option value="1" <?= isset($update['erinnerung']) && $update['erinnerung'] == 1 ? 'selected' : '' ?>>Ja</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="Notiz" class="form-label">Notiz</label>
            <textarea class="form-control" name="Notiz" id="Notiz" rows="3" required><?= isset($tasks['Notiz']) ? esc($tasks['Notiz']) : (isset($update['notizen']) ? esc($update['notizen']) : '') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="Spalte" class="form-label">Spalte</label>
            <select class="form-select" name="Spalte" id="Spalte" required>
                <?php foreach ($spalten as $spalte): ?>
                    <option value="<?= $spalte['id'] ?>" <?= isset($update['spaltenid']) && $update['spaltenid'] == $spalte['id'] ? 'selected' : '' ?>>
                        <?= esc($spalte['spalte']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="submitTasks" class="btn btn-success">Speichern</button>
        <a href="<?= base_url('HauptController/tasks') ?>" class="btn btn-secondary">Zurück</a>
    </form>
</div>
