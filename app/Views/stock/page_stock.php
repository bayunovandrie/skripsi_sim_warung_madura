<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h6>Stok <?= $stock_type ?></h6>
                    <button class="btn btn-xs bg-gradient-primary" id="btn_add_stock_manajement"
                        title="Tambah Stock <?= $stock_type ?>"
                        data-action-form="<?= base_url('user/insert-stock-product') ?>"
                        data-stock-type="<?= $stock_type ?>">
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
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Tanggal <?= $stock_type ?></th>
                                <th
                                    class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Product Code
                                </th>
                                <th
                                    class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                    Product Name</th>
                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Qty</th>
                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Stock</th>
                            </tr>
                        </thead>
                        <tbody style=" font-size: 12px;">
                            <?php foreach($stock as $val): ?>
                            <tr>

                                <td class="text-center">
                                    <?= return_datetime_format($val['DateInput']) ?>
                                </td>
                                <td class="text-center">
                                    <?= $val['ProductCode'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $val['ProductName'] ?>
                                </td>
                                <td
                                    class="text-center <?= ($val['TypeStock'] == 1) ? "text-danger" : "text-success" ?>">
                                    <?= $val['Qty'] ?>
                                </td>
                                <td
                                    class="text-center <?= ($val['TypeStock'] == 1) ? "text-danger" : "text-success" ?>">
                                    <?= ($val['TypeStock'] == 1) ? "Keluar" : "Masuk" ?>
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

<!--  -->
<!-- Modal Scanner -->
<div class="modal fade" id="modal_qr_scanner" tabindex="-1" aria-labelledby="modalScannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalScannerLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="qr-reader" style="width:100%;"></div>
                <div class="mt-3">
                    <strong>Product Code: </strong> <span id="scanned_result"></span>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>