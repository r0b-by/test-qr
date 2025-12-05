<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use Endroid\QrCode\Builder\Builder;

class BarcodeController extends BaseController
{
    // Halaman utama: tampilkan list PDF + tombol generate barcode
    public function home()
    {
        $docs = (new DocumentModel())->orderBy('id', 'DESC')->findAll();

        return view('barcode/home', ['docs' => $docs]);
    }

    // Halaman show: tampilkan barcode + tombol buka PDF
    public function show($id)
    {
        $doc = (new DocumentModel())->find($id);
        if (!$doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Dokumen tidak ditemukan");
        }

        return view('barcode/show', ['doc' => $doc]);
    }

    // Generate QR code
    public function generate($id)
    {
        $url = base_url('/barcode/show/' . $id); // link diarahkan ke show

        $result = Builder::create()
            ->data($url)
            ->size(300)
            ->margin(10)
            ->build();

        return $this->response
            ->setHeader('Content-Type', $result->getMimeType())
            ->setBody($result->getString());
    }

    // Tampilkan PDF
    public function file($id)
    {
        $doc = (new DocumentModel())->find($id);
        if (!$doc) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $filePath = WRITEPATH . 'uploads/' . $doc['filename'];
        if (!file_exists($filePath)) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setBody(file_get_contents($filePath));
    }
}