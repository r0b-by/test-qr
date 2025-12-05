<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-sm mx-auto p-6 mt-10 bg-white shadow rounded text-center">
    <h2 class="text-xl font-bold mb-4">Barcode Dokumen</h2>

    <img src="<?= base_url('/barcode/generate/' . $doc['id']) ?>" class="mx-auto mb-4">

    <p class="mb-4"><?= esc($doc['original_name']) ?></p>

    <a href="<?= base_url('/barcode/file/' . $doc['id']) ?>" target="_blank"
       class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Buka PDF</a>
</div>
