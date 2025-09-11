<div class="container mt-4">
    <h1><?= isset($update) ? 'Spalte bearbeiten' : 'Neue Spalte erstellen' ?></h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= implode('<br>', $error) ?></div>
    <?php endif; ?>
    <form method="post" action="<?= base_url('HauptController/submitSpalten') ?>">
        <?php if (isset($update)): ?>
            <input type="hidden" name="id" value="<?= esc($update['id']) ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="spalte" class="form-label">Spaltenname</label>
            <input type="text" class="form-control" name="spalte" value="<?= isset($update) ? esc($update['spalte']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="spaltenbeschreibung" class="form-label">Spaltenbeschreibung</label>
            <textarea class="form-control" name="spaltenbeschreibung" rows="3" required><?= isset($update) ? esc($update['spaltenbeschreibung']) : '' ?></textarea>
        </div>
        <div class="mb-3">
            <label for="boardsid" class="form-label">Board</label>
            <select class="form-select" name="boardsid" id="boardsid" required>
                <option value="">Bitte wählen</option>
                <?php foreach ($boards as $board): ?>
                    <option value="<?= $board['id'] ?>" <?= isset($update) && $update['boardsid'] == $board['id'] ? 'selected' : '' ?>>
                        <?= esc($board['board']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="sortid" class="form-label">Sort ID</label>
            <input type="number" class="form-control" name="sortid" value="<?= isset($update) ? esc($update['sortid']) : '' ?>" required>
        </div>
        <button type="submit" name="submitSpalte" class="btn btn-success">Speichern</button>
        <a href="<?= base_url('HauptController/spalte') ?>" class="btn btn-secondary">Zurück</a>
    </form>
</div>

