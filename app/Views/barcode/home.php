<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-3xl mx-auto p-6 mt-10">
    <h2 class="text-2xl font-bold mb-4">Daftar Dokumen PDF</h2>

    <table class="w-full border border-gray-300 rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nama File</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($docs as $doc): ?>
            <tr>
                <td class="p-2 border"><?= esc($doc['id']) ?></td>
                <td class="p-2 border"><?= esc($doc['original_name']) ?></td>
                <td class="p-2 border space-x-2">
                    <a href="<?= base_url('/barcode/generate/' . $doc['id']) ?>" target="_blank"
                       class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Generate Barcode</a>
                    <a href="<?= base_url('/barcode/file/' . $doc['id']) ?>" target="_blank"
                       class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Buka PDF</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
