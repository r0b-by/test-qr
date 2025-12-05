<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use Endroid\QrCode\Builder\Builder;

class BarcodeController extends BaseController
{
    /**
     * =============== HALAMAN UTAMA ====================
     * Menampilkan barcode dokumen PDF terbaru
     */
    public function home()
    {
        $doc = (new DocumentModel())->orderBy('id', 'DESC')->first();

        if (!$doc) {
            return "<h3>Belum ada dokumen PDF di database. Silakan upload di /barcode</h3>";
        }

        return view('barcode/home', [
            'id'  => $doc['id'],
            'doc' => $doc
        ]);
    }

    /**
     * =============== HALAMAN UPLOAD PDF ====================
     * /barcode → upload PDF
     */
    public function index()
    {
        return view('barcode/upload');
    }

    public function upload()
    {
        $file = $this->request->getFile('pdf');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File bermasalah.');
        }

        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $newName);

        $docModel = new DocumentModel();
        $id = $docModel->insert([
            'filename'      => $newName,
            'original_name' => $file->getName()
        ]);

        return redirect()->to('/barcode/show/' . $id);
    }

    /**
     * =============== HALAMAN SHOW ====================
     * Menampilkan barcode + tombol buka PDF
     */
    public function show($id)
    {
        return view('barcode/show', ['id' => $id]);
    }

    /**
     * =============== GENERATE BARCODE ====================
     */
    public function generate($id)
    {
        $url = base_url('/barcode/show/' . $id); // diarahkan ke halaman show

        $result = \Endroid\QrCode\Builder\Builder::create()
            ->data($url)
            ->size(300)
            ->margin(10)
            ->build();

        return $this->response
            ->setHeader('Content-Type', $result->getMimeType())
            ->setBody($result->getString());
    }

    /**
     * =============== TAMPILKAN PDF ====================
     */
    public function file($id)
    {
        $doc = (new DocumentModel())->find($id);

        if (!$doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Dokumen tidak ditemukan");
        }

        $filePath = WRITEPATH . 'uploads/' . $doc['filename'];

        if (!file_exists($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("File PDF tidak ditemukan");
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setBody(file_get_contents($filePath));
    }
}
