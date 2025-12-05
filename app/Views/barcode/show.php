<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode & PDF - <?= esc($doc['original_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6 mt-10">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-2">📄 <?= esc($doc['original_name']) ?></h2>
                    <p class="text-gray-600">ID: <?= esc($doc['id']) ?> | Upload: <?= date('d M Y H:i', strtotime($doc['created_at'])) ?></p>
                </div>
                <a href="<?= base_url('/') ?>" 
                   class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                    ← Kembali
                </a>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- QR Code Section -->
                <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4 text-center">📱 QR Code</h3>
                    <div class="flex justify-center mb-4">
                        <img src="<?= base_url('/barcode/generate/' . $doc['id']) ?>" 
                             alt="QR Code" 
                             class="border-4 border-white rounded-lg shadow-lg">
                    </div>
                    <div class="text-center space-y-2">
                        <p class="text-sm text-gray-700">Scan QR code untuk membuka dokumen</p>
                        <a href="<?= base_url('/barcode/generate/' . $doc['id']) ?>" 
                           download="qrcode_<?= $doc['id'] ?>.png"
                           class="inline-block px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition text-sm">
                            💾 Download QR Code
                        </a>
                    </div>
                </div>

                <!-- PDF Preview Section -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">📖 Preview PDF</h3>
                    <a href="<?= base_url('/barcode/file/' . $doc['id']) ?>" 
                       target="_blank"
                       class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 mb-4 transition">
                        🔗 Buka PDF di Tab Baru
                    </a>
                    
                    <!-- PDF Embed -->
                    <div class="border-4 border-gray-200 rounded-lg overflow-hidden shadow-lg">
                        <embed 
                            src="<?= base_url('/barcode/file/' . $doc['id']) ?>" 
                            width="100%" 
                            height="600px" 
                            type="application/pdf"
                            class="bg-gray-50">
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        💡 Jika PDF tidak tampil, silakan klik tombol "Buka PDF di Tab Baru"
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>