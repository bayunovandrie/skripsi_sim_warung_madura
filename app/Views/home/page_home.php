<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Stok Masuk</p>
                            <h5 class="font-weight-bolder">
                                50
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-box-2  text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Stok Keluar</p>
                            <h5 class="font-weight-bolder">
                                10
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pembeli</p>
                            <h5 class="font-weight-bolder">
                                500
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="fas fa-user text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Stok</p>
                            <h5 class="font-weight-bolder">
                                500
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                            <i class="ni ni-bullet-list-67 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-5 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Stok Sembako</h6>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="chart-pie" class="chart-canvas"></canvas>
                </div>

            </div>

        </div>
    </div>
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Daftar Sembako</h6>
                <!-- <p class="text-sm mb-0">
                    <i class="fa fa-arrow-up text-success"></i>
                    <span class="font-weight-bold">4% more</span> in 2021
                </p> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Gambar
                                </th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Kode Sembako</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nama
                                    Sembako</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Tipe
                                    Sembako</th>
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
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
<?= $this->endSection('content') ?>