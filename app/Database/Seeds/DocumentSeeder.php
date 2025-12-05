<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\DocumentModel;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        $sourceDir = FCPATH . 'uploads/';
        $targetDir = WRITEPATH . 'uploads/';

        // Create target directory if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get all PDF files
        $files = glob($sourceDir . '*.pdf');

        if (empty($files)) {
            echo "⚠️  Tidak ada file PDF di {$sourceDir}\n";
            echo "💡 Silakan tambahkan file PDF ke folder public/uploads/\n";
            return;
        }

        $docModel = new DocumentModel();
        $successCount = 0;

        foreach ($files as $file) {
            $originalName = basename($file);
            $newName = 'doc_' . time() . '_' . uniqid() . '_' . $originalName;

            try {
                // Copy file
                if (copy($file, $targetDir . $newName)) {
                    // Insert to database
                    $docModel->insert([
                        'filename'      => $newName,
                        'original_name' => $originalName
                    ]);
                    
                    echo "✅ Berhasil: {$originalName}\n";
                    $successCount++;
                } else {
                    echo "❌ Gagal copy: {$originalName}\n";
                }
            } catch (\Exception $e) {
                echo "❌ Error: {$originalName} - {$e->getMessage()}\n";
            }

            // Small delay to ensure unique timestamps
            usleep(100000); // 0.1 second
        }

        echo "\n🎉 Seeding selesai! Total: {$successCount} file berhasil.\n";
    }
}