<div class="container mt-4">
    <h1><?= isset($update) ? 'Board bearbeiten' : 'Board erstellen' ?></h1>

    <div class="col-md-6">
        <form action="<?php echo base_url('HauptController/submitBoard') ?>" method="post">
            <input type="hidden" name="id" value="<?php echo isset($update['id']) ? $update['id'] : ''; ?>">

            <div class="mb-3">
                <label for="board" class="form-label">Boardbezeichnung</label>
                <input type="text" class="form-control <?= (isset($error['board'])) ? 'is-invalid' : '' ?>" id="board"
                       name="board"
                       value="<?= isset($update['board']) ? $update['board'] : '' ?>">
                
                <div class="invalid-feedback">
                    <?= isset($error['board']) ? $error['board'] : '' ?>
                </div>
            </div>

            <button type="submit" class="btn btn-success" name="submitBoard" id="submitBoard">
                <?= isset($update) ? 'Aktualisieren' : 'Speichern' ?>
            </button>

            <a href="<?php echo base_url('HauptController/board'); ?>">
                <button type="button" class="btn btn-secondary">Abbrechen</button>
            </a>
        </form>
    </div>
</div>

