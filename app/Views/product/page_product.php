<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h6>Daftar Produk</h6>
                    <button class="btn btn-xs bg-gradient-primary" id="btn_add_product" title="Tambah Product"
                        data-action-form="<?= base_url('user/insert-product') ?>">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Gambar
                                </th>
                                <th
                                    class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                    Kode Produk</th>
                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Nama Produk</th>
                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Tipe Sembako</th>
                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Generate QR</th>
                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Total Stok</th>
                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody style=" font-size: 12px;">
                            <?php foreach($product as $val): ?>
                            <tr>
                                <td class="text-center">
                                    <img src="<?= ($val['ProductImg'] == null) ? base_url("assets/img/box.png") : base_url('uploads/products/' . $val['ProductImg']) ?>"
                                        alt="Gambar Product" style="width: 50px;">
                                </td>
                                <td class="text-center">
                                    <?= $val['ProductCode'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $val['ProductName'] ?>
                                    <div
                                        style="height: 5px; background-color: <?= return_color_product($val['ProductCode']) ?>; margin-top: 5px;">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?= ($val['ProductType'] == 1) ? "Kemasan" : "Satuan" ?>
                                </td>

                                <td class="text-center">
                                    <?php if($val['QrProduct'] == null) : ?>
                                    <button type="button" class="btn btn-xs bg-gradient-primary m-auto"
                                        data-product-code="<?= $val['ProductCode'] ?>"
                                        data-url-create="<?= base_url("user/insert-qrcode") ?>" id="btn_generate_qr"
                                        title="Generate QR"><i class="fa-solid fa-qrcode"></i> </button>
                                    <?php else: ?>
                                    <a href="<?= base_url('uploads/qr_product/') . $val['QrProduct'] ?>"
                                        class="btn btn-xs bg-gradient-success m-auto" title="Download QR" download=""><i
                                            class="fa-solid fa-download"></i></a> |
                                    <button class="btn btn-xs bg-gradient-info m-auto open_modal_qr"
                                        data-product-name="<?= $val['ProductName'] ?>"
                                        data-img-qr="<?= $val['QrProduct'] ?>" title="Lihat Qr"><i
                                            class="fa-solid fa-eye"></i></button>

                                    <?php endif ?>
                                </td>
                                <td class="text-center">
                                    <span style="font-weight: 800;"><?= $val['TotalStock'] ?></span>
                                </td>

                                <td class="text-center">
                                    <button class="btn btn-xs bg-gradient-warning m-auto btn_update_product"
                                        data-action-form="<?= base_url('user/update-product') ?>"
                                        data-product-code="<?= $val['ProductCode'] ?>"><i
                                            class="fas fa-edit"></i></button> |
                                    <button type="button"
                                        class="btn btn-xs bg-gradient-danger m-auto btn_delete_product"
                                        data-action-form="<?= base_url('user/delete-product') ?>"
                                        data-product-code="<?= $val['ProductCode'] ?>"
                                        data-product-name="<?= $val['ProductName'] ?>"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- canvas qr code tersembunyi -->
<div id="qrcode" style="display:none;"></div>

<!-- Modal Tambah Product -->
<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Tambah Product</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form id="form_create_product">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="productName" class="form-label">Nama Produk <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Produk (Beras)" value=""
                            name="product_name" id="product_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="productUnit" class="form-label">Tipe Produk <span
                                class="text-danger">*</span></label>
                        <select name="tipe_produk" class="form-control" id="product_tipe" required>
                            <option value="">----- Pilih Tipe Produk -----</option>
                            <option value="1">Kemasan</option>
                            <option value="2">Satuan</option>
                        </select>
                    </div>

                    <input type="hidden" id="old_img" name="old_img">
                    <input type="hidden" id="product_code" name="product_code">


                    <div class="mb-3">
                        <label for="productImage" class="form-label">Gambar Produk</label>
                        <div class="mb-3">
                            <img id="previewImage" src="<?= base_url('assets/img/box.png') ?>" alt="Preview Gambar"
                                style="max-width: 100px;" class="img-thumbnail">
                        </div>
                        <input type="file" class="form-control" id="productImage" name="product_image" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-xs bg-gradient-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_qr" tabindex="-1" aria-labelledby="modalQrLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalQrLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" alt="Gambar Qr" id="modal_qr_img_product">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-xs " data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_delete" tabindex="-1" aria-labelledby="modal_delete_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal_delete_label"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form id="form_modal_delete">
                <input type="hidden" id="value_post" name="value_post">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs " data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-xs bg-gradient-primary">Hapus</button>
                </div>
            </form>



        </div>
    </div>
</div>


<?= $this->endSection('') ?>