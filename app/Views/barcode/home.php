<h2>Barcode untuk: <?= esc($doc['original_name']) ?></h2>

<img src="<?= base_url('/barcode/generate/' . $id) ?>" width="250">

<br><br>

<a href="<?= base_url('/barcode/file/' . $id) ?>" target="_blank">
    ➤ Buka PDF
</a>
