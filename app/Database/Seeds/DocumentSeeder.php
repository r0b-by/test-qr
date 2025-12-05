<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\DocumentModel;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        // Folder asal file PDF
        $sourceDir = FCPATH . 'uploads/';

        // Folder tujuan writable/uploads
        $targetDir = WRITEPATH . 'uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Ambil semua file PDF di public/uploads
        $files = glob($sourceDir . '*.pdf');

        if (!$files) {
            echo "Tidak ada file PDF di public/uploads!";
            return;
        }

        $docModel = new DocumentModel();

        foreach ($files as $file) {
            $originalName = basename($file);
            $newName = 'seed_' . time() . '_' . $originalName;

            // Copy file ke writable/uploads
            copy($file, $targetDir . $newName);

            // Insert ke database
            $docModel->insert([
                'filename'      => $newName,
                'original_name' => $originalName
            ]);

            echo "Berhasil mengirim file: $originalName\n";
        }
    }
}
