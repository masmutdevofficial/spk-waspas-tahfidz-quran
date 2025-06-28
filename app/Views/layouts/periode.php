        <?php if (session()->get('role') == 1): ?>
        <div class="row justify-content-start mb-3">
            <div class="col-md-4 col-sm-6">
                <form method="GET" class="form-inline">
                    <label for="periode" class="mr-2">Filter Periode:</label>
                    <select name="periode" id="periode" class="form-control mr-2 w-100" onchange="this.form.submit()">
                        <option value="">-- Semua Periode --</option>
                        <?php foreach ($periode as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= isset($filter_id) && $filter_id == $p['id'] ? 'selected' : '' ?>>
                                <?= esc($p['tahun']) . ' - ' . esc($p['semester']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>
        <?php endif; ?>