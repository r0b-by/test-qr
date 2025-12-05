<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dokumen PDF - Barcode System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto p-6 mt-10">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">📄 Sistem Barcode Dokumen PDF</h1>
                <p class="text-gray-600">Kelola dan generate QR code untuk dokumen PDF Anda</p>
            </div>

            <!-- Stats -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-blue-800 font-semibold">
                    Total Dokumen: <span class="text-2xl"><?= count($docs) ?></span>
                </p>
            </div>

            <!-- Table -->
            <?php if (empty($docs)): ?>
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada dokumen</h3>
                    <p class="mt-1 text-sm text-gray-500">Silakan upload PDF dan jalankan seeder.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 text-left border border-gray-300 font-semibold">ID</th>
                                <th class="p-3 text-left border border-gray-300 font-semibold">Nama File</th>
                                <th class="p-3 text-left border border-gray-300 font-semibold">Tanggal Upload</th>
                                <th class="p-3 text-center border border-gray-300 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($docs as $doc): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3 border border-gray-300"><?= esc($doc['id']) ?></td>
                                <td class="p-3 border border-gray-300">
                                    <span class="font-medium"><?= esc($doc['original_name']) ?></span>
                                </td>
                                <td class="p-3 border border-gray-300 text-sm text-gray-600">
                                    <?= date('d M Y H:i', strtotime($doc['created_at'])) ?>
                                </td>
                                <td class="p-3 border border-gray-300">
                                    <div class="flex gap-2 justify-center flex-wrap">
                                        <a href="<?= base_url('/barcode/show/' . $doc['id']) ?>" 
                                           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm font-medium">
                                            🔍 Lihat Detail
                                        </a>
                                        <a href="<?= base_url('/barcode/generate/' . $doc['id']) ?>" 
                                           target="_blank"
                                           class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition text-sm font-medium">
                                            📱 QR Code
                                        </a>
                                        <a href="<?= base_url('/barcode/file/' . $doc['id']) ?>" 
                                           target="_blank"
                                           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm font-medium">
                                            📄 Buka PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-gray-600 text-sm">
            <p>Powered by CodeIgniter 4 + QR Code Library</p>
        </div>
    </div>
</body>
</html>