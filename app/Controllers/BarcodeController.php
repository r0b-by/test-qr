<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class BarcodeController extends BaseController
{
    protected $documentModel;

    public function __construct()
    {
        $this->documentModel = new DocumentModel();
    }

    /**
     * Halaman utama: tampilkan list PDF + tombol generate barcode
     */
    public function home()
    {
        $docs = $this->documentModel->orderBy('id', 'DESC')->findAll();
        return view('barcode/home', ['docs' => $docs]);
    }

    /**
     * Halaman show: tampilkan barcode + PDF preview
     */
    public function show($id)
    {
        $doc = $this->documentModel->find($id);
        
        if (!$doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Dokumen dengan ID {$id} tidak ditemukan"
            );
        }

        return view('barcode/show', ['doc' => $doc]);
    }

    /**
     * Generate QR code image
     */
    public function generate($id)
    {
        // Validasi dokumen exists
        $doc = $this->documentModel->find($id);
        if (!$doc) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Document not found']);
        }

        $url = base_url('/barcode/show/' . $id);

        try {
            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($url)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                ->size(300)
                ->margin(10)
                ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                ->build();

            return $this->response
                ->setHeader('Content-Type', $result->getMimeType())
                ->setHeader('Cache-Control', 'public, max-age=3600')
                ->setBody($result->getString());
        } catch (\Exception $e) {
            log_message('error', 'QR Code generation failed: ' . $e->getMessage());
            return $this->response
                ->setStatusCode(500)
                ->setJSON(['error' => 'Failed to generate QR code']);
        }
    }

    /**
     * Tampilkan PDF file
     */
    public function file($id)
    {
        $doc = $this->documentModel->find($id);
        
        if (!$doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Dokumen tidak ditemukan"
            );
        }

        $filePath = WRITEPATH . 'uploads/' . $doc['filename'];
        
        if (!file_exists($filePath)) {
            log_message('error', "PDF file not found: {$filePath}");
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "File PDF tidak ditemukan di server"
            );
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $doc['original_name'] . '"')
            ->setHeader('Cache-Control', 'public, max-age=3600')
            ->setBody(file_get_contents($filePath));
    }
}