<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $product;

    public function __construct()
    {
        $this->product = new ProductModel();
        helper('color_product');
    }

    public function index(): string
    {

        $data['title'] = "Manajemen Stok | Product";
        $data['topbar_name'] = "Product";

        $data['product'] = $this->product->findAll();
        
        return view('product/page_product', $data);data: 
    }

    public function create()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'product_name' => 'required|min_length[3]',
            'tipe_produk' => 'required|in_list[1,2]',
            'product_image' => [
                'rules' => 'uploaded[product_image]|is_image[product_image]|max_size[product_image,2048]',
                'errors' => [
                    'uploaded' => 'Gambar produk wajib diupload',
                    'is_image' => 'File harus berupa gambar (jpg, png, gif)',
                    'max_size' => 'Ukuran gambar maksimal 2MB'
                ]
            ]
        ];

        // Kalau gambar tidak diupload, hapus rule uploaded
        if (! $this->request->getFile('product_image')->isValid()) {
            unset($rules['product_image']);
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        $productImage = $this->request->getFile('product_image');
        $imageName = null;

        if ($productImage && $productImage->isValid() && !$productImage->hasMoved()) {
            $imageName = $productImage->getRandomName();
            $productImage->move('uploads/products', $imageName);
        }

        $lastProduct = $this->product->orderBy('ProductCode', 'DESC')->first();

        if ($lastProduct && isset($lastProduct['ProductCode'])) {
            $lastCode = $lastProduct['ProductCode']; // Contoh: PRD005
            $lastNumber = (int) substr($lastCode, 3); // Ambil angka: 5
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format ke PRDxxx
        $newProductCode = 'PRD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $data = [
            'ProductCode' => $newProductCode,
            'ProductName' => $this->request->getPost('product_name'),
            'ProductType'  => $this->request->getPost('tipe_produk'),
            'ProductImg' => $imageName
        ];

        $this->product->insert($data);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Produk berhasil ditambahkan'
        ]);
    }

    public function get_product()
    {
        $productCode = $this->request->getPost('product_code');

        $product = $this->product->where('ProductCode', $productCode)->first();

        if($product) {
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $product
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'false',
                'message' => 'Product Tidak tersedia'
            ]);
        }
    }

    public function create_qr_code()
    {
        $imageData = $this->request->getPost('image');
        $productCode = $this->request->getPost('product_code');

        if (!$imageData || !$productCode) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak lengkap']);
        }

        // Hapus bagian data:image/png;base64,
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageDecoded = base64_decode($imageData);

        // Pastikan direktori writable/qrcode ada
        $qrDir = 'uploads/qr_product/';
        if (!is_dir($qrDir)) {
            mkdir($qrDir, 0755, true);
        }

        // Simpan gambar
        $fileName = $productCode . '_' . time() . '.png';
        $filePath = $qrDir . $fileName;

        // update table product
        $data_update = [
            "QrProduct" => $fileName
        ];

        $isUpdate = $this->product->where('ProductCode', $productCode)->set($data_update)->update();

        if($isUpdate) {
            if (file_put_contents($filePath, $imageDecoded)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'QR Code berhasil disimpan',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menyimpan gambar QR'
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal Update data, tolong di coba lagi'
            ]);
        }
    }

    public function update()
    {
        $rules = [
            'product_name' => 'required|min_length[3]',
            'tipe_produk' => 'required|in_list[1,2]',
            'product_image' => [
                'rules' => 'uploaded[product_image]|is_image[product_image]|max_size[product_image,2048]',
                'errors' => [
                    'uploaded' => 'Gambar produk wajib diupload',
                    'is_image' => 'File harus berupa gambar (jpg, png, gif)',
                    'max_size' => 'Ukuran gambar maksimal 2MB'
                ]
            ]
        ];

        // Kalau gambar tidak diupload, hapus rule uploaded
        if (! $this->request->getFile('product_image')->isValid()) {
            unset($rules['product_image']);
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data_update = [
            'ProductName' => $this->request->getPost('product_name'),
            'ProductType'  => $this->request->getPost('tipe_produk')
        ];

        $oldImage     = $this->request->getPost('old_img');
        $productCode     = $this->request->getPost('product_code');

        $productImage = $this->request->getFile('product_image');
        $imageName = null;

        if ($productImage && $productImage->isValid() && !$productImage->hasMoved()) {
            $imageName = $productImage->getRandomName();
            $productImage->move('uploads/products', $imageName);

            $data_update['ProductImg'] = $imageName;

            // Hapus gambar lama
            if (!empty($oldImage) && file_exists('uploads/products/' . $oldImage)) {
                unlink('uploads/products/' . $oldImage);
            }
        }

        $isUpdate = $this->product->where('ProductCode', $productCode)->set($data_update)->update();

        if($isUpdate) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Produk berhasil diedit'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Produk gagal ditambahkan'
            ]);
        }
        
    }

    public function delete()
    {
        $productCode = $this->request->getPost('value_post');

        $product = $this->product->where('ProductCode', $productCode)->first();

        if ($product) {

            if (!empty($product['ProductImg'])) {
                unlink('uploads/products/' . $product['ProductImg']);
              
            }

            // hapus data
            $this->product->where('ProductCode', $productCode)->delete();

            return $this->response->setJSON(['status' => true, 'message' => 'Produk berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Produk tidak ditemukan']);
        }

    }
}