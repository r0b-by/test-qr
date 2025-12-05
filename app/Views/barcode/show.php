<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <h3>Detail Dokumen</h3>
    <hr>

    <p><strong>ID Dokumen:</strong> <?= esc($id) ?></p>

    <!-- Tampilkan QR Code -->
    <h5>QR Code:</h5>
    <img src="<?= base_url('barcode/generate/' . $id) ?>" alt="QR Code">

    <hr>

    <!-- Preview PDF -->
    <h5>Preview Dokumen PDF:</h5>
    <iframe 
        src="<?= base_url('barcode/file/' . $id) ?>" 
        width="100%" 
        height="600px" 
        style="border:1px solid #ccc;">
    </iframe>

    <div class="mt-3">
        <a href="<?= base_url('/') ?>" class="btn btn-primary">Upload Lagi</a>
    </div>

</div>

<?= $this->endSection() ?>
