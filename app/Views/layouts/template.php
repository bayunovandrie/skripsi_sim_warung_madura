<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>">
    <title>
        <?= $title ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('assets/css/argon-dashboard.css?v=2.1.0') ?>" rel="stylesheet" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body class="g-sidenav-show   bg-gray-100">

    <div class="min-height-300 bg-dark position-absolute w-100"></div>

    <?= $this->include('layouts/sidebar') ?>

    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->

        <?= $this->include('layouts/topbar') ?>

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <?= $this->renderSection('content') ?>

            <footer class="footer pt-3">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="text-center text-sm text-muted text-lg-start">
                                Aplikasi Manajemen Stok Sembako • Warung Madura
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!-- Modal input qty -->
    <div class="modal fade" id="modal_input_qty" tabindex="-1" aria-labelledby="modalQtyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalQtyLabel">Input Qty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>QR Code: <span id="qty_qr_code" class="fw-bold"></span></p>
                    <div class="mb-3">
                        <label for="qty_value" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qty_value" placeholder="Masukkan jumlah" min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btn_submit_qty">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>"></script>

    <!-- CDN Qr Code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
    $(document).ready(function() {
        let html5QrCode;
        let isCameraRunning = false;
        let stock_type = "";
        let lastScanned = "";
        let lastScanTime = 0;
        let scannedCode = ""; // simpan QR sementara untuk submit qty

        $('#btn_add_stock_manajement').on('click', function() {
            stock_type = $(this).data("stock-type");
            $("#modalScannerLabel").text('Modal Qr Stock ' + stock_type);
            $('#modal_qr_scanner').modal('show');
        });

        $('#modal_qr_scanner').on('shown.bs.modal', function() {
            if (!html5QrCode) {
                html5QrCode = new Html5Qrcode("qr-reader");
            }

            if (isCameraRunning) {
                console.log("Kamera sudah berjalan, tidak akan start ulang.");
                return;
            }

            const qrCodeSuccessCallback = (decodedText) => {
                let now = Date.now();

                if (decodedText === lastScanned && (now - lastScanTime) < 2000) {
                    return;
                }

                lastScanned = decodedText;
                lastScanTime = now;
                scannedCode = decodedText; // simpan untuk submit qty

                $('#scanned_result').text(decodedText);
                $('#qty_qr_code').text(decodedText); // tampilkan di modal qty
                $('#qty_value').val(""); // reset qty input

                // Tampilkan modal input qty
                $('#modal_input_qty').modal('show');
            };

            const config = {
                fps: 10,
                qrbox: {
                    width: 300,
                    height: 300
                }
            };

            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    let cameraId = devices[0].id;
                    html5QrCode.start(cameraId, config, qrCodeSuccessCallback)
                        .then(() => {
                            isCameraRunning = true;
                            console.log("Camera started, ready to scan");
                        })
                        .catch(err => console.error("Error start camera:", err));
                } else {
                    alert("Kamera tidak ditemukan!");
                }
            }).catch(err => {
                console.error("Error getCameras:", err);
            });
        });

        // Saat klik submit qty
        $('#btn_submit_qty').on('click', function() {
            let qty = $('#qty_value').val();

            if (!qty || qty <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Qty tidak valid',
                    text: 'Masukkan jumlah yang benar'
                });
                return;
            }

            // Kirim data ke controller via AJAX
            $.ajax({
                url: '<?= base_url('insert-stok-by-qr') ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    qr_code: scannedCode,
                    stock_type: stock_type,
                    qty: qty
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'QR berhasil diproses!'
                        }).then(() => {
                            $('#modal_input_qty').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message || 'Terjadi kesalahan'
                        }).then(() => {
                            $('#modal_input_qty').modal('hide');
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Tidak dapat mengirim QR ke server'
                    });
                }
            });
        });

        $('#modal_qr_scanner').on('hidden.bs.modal', function() {
            if (html5QrCode && isCameraRunning) {
                html5QrCode.stop().then(() => {
                    console.log("Camera stopped");
                    isCameraRunning = false;
                    lastScanned = "";
                    lastScanTime = 0;
                }).catch(err => console.error("Error stopping camera:", err));
            }
        });
    });
    </script>







    <script>
    $(document).ready(function() {

        // handle modal 
        $(".open_modal_qr").on("click", function() {
            let productName = $(this).data("product-name");
            let imgQr = $(this).data("img-qr");
            let labelModal = "Qr Code " + productName;
            let urlQr = '<?= base_url('uploads/qr_product/') ?>' + imgQr;

            $('#modal_qr').modal('show');
            $("#modalQrLabel").text(labelModal);
            $('#modal_qr_img_product').attr('src', urlQr);
            $('#modal_qr_img_product').attr('title', productName);
        });

        // handle button generate QR
        $('#btn_generate_qr').on('click', function() {
            let productCode = $(this).data('product-code');
            let qrcodeContainer = document.getElementById("qrcode");
            let urlInsertQR = $(this).data('url-create');

            $('#qrcode').empty();

            // Generate QR di container sementara
            let tempContainer = document.createElement("div");
            let qrcode = new QRCode(tempContainer, {
                text: productCode,
                width: 230, // kecilin sedikit biar ada ruang padding
                height: 230,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            Swal.fire({
                title: 'Membuat QR Code...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(function() {
                let qrCanvas = tempContainer.querySelector("canvas");
                if (!qrCanvas) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'QR Canvas tidak ditemukan'
                    });
                    return;
                }

                // Buat canvas baru untuk padding
                let finalSize = 256; // ukuran akhir
                let padding = (finalSize - qrCanvas.width) / 2;

                let canvas = document.createElement("canvas");
                canvas.width = finalSize;
                canvas.height = finalSize;

                let ctx = canvas.getContext("2d");
                ctx.fillStyle = "#ffffff"; // background putih
                ctx.fillRect(0, 0, finalSize, finalSize);
                ctx.drawImage(qrCanvas, padding, padding);

                // Tampilkan QR final ke container utama
                let img = document.createElement("img");
                img.src = canvas.toDataURL("image/png");
                qrcodeContainer.appendChild(img);

                // Kirim ke server
                $.ajax({
                    url: urlInsertQR,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        image: img.src,
                        product_code: productCode
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'QR Code berhasil disimpan.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal mengirim QR ke server',
                        });
                    }
                });
            }, 500);
        });


        // handle preview img
        $('#productImage').on('change', function() {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        // handle create product
        $("#form_create_product").on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.close();
                    if (res.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#form_create_product')[0].reset();
                        $('#modal_add').modal('hide');
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        location.reload();

                    }


                },
                error: function(xhr) {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }
            });
        });

        // handle add product
        $("#btn_add_product").on("click", function(e) {
            e.preventDefault();

            let modalProduct = $('#modal_add');
            let actionUrl = $(this).data('action-form');

            modalProduct.modal('show');
            modalProduct.find('#product_name').val('');
            modalProduct.find('#old_img').val('');
            modalProduct.find('#product_code').val('');
            modalProduct.find('#product_tipe').val('').trigger(
                'change');
            modalProduct.find('#previewImage').attr("src", '<?= base_url('assets/img/box.png') ?>');
            modalProduct.find('#form_create_product').attr('action', actionUrl);

        });

        // handle update product
        $('.btn_update_product').on('click', function() {
            let actionForm = $(this).data('action-form');
            let productCode = $(this).data('product-code');
            let modalProduct = $('#modal_add');
            $.ajax({
                url: '<?= base_url(relativePath: 'get-data-product-by-code') ?>',
                method: 'post',
                data: {
                    product_code: productCode
                },
                dataType: 'json',
                success: function(response) {

                    if (response.status == 'success') {
                        let data = response.data;

                        let urlProductImg = (data.ProductImg == null) ?
                            '<?= base_url('assets/img/box.png') ?>' :
                            '<?= base_url('uploads/products/') ?>' + data
                            .ProductImg;

                        modalProduct.modal('show');
                        modalProduct.find('#modalAddLabel').text('Edit Produk');
                        modalProduct.find('#form_create_product').attr('action',
                            actionForm);

                        modalProduct.find('#product_name').val(data.ProductName);
                        modalProduct.find('#product_code').val(data.ProductCode);
                        modalProduct.find('#old_img').val(data.ProductImg);
                        modalProduct.find('#product_tipe').val(data.ProductType).trigger(
                            'change');
                        modalProduct.find('#previewImage').attr("src", urlProductImg);

                    }


                },
            })

        })

        // handle delete product
        $(".btn_delete_product").on('click', function(e) {
            e.preventDefault();

            let modalDelete = $('#modal_delete');
            let productCode = $(this).data("product-code");
            let productName = $(this).data("product-name");
            let actionForm = $(this).data("action-form");

            modalDelete.modal('show');
            modalDelete.find("#form_modal_delete").attr('action', actionForm);
            modalDelete.find("#modal_delete_label").text("Hapus Produk");
            modalDelete.find("#value_post").val(productCode);

            modalDelete.find('.modal-body').html(
                `<p>Apakah anda yakin untuk menghapus produk : <strong>${productName}</strong></p>`)

        })

        // handle form delete
        $("#form_modal_delete").on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Menghapus',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.close();
                    if (res.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#form_modal_delete')[0].reset();
                        $('#modal_delete').modal('hide');
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        location.reload();

                    }


                },
                error: function(xhr) {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }
            });
        });
    });
    </script>


    <script>
    var ctxPie = document.getElementById("chart-pie").getContext("2d");

    new Chart(ctxPie, {
        type: "pie",
        data: {
            labels: [
                "Beras", "Minyak Goreng", "Gula Pasir", "Mie Instan",
                "Telur Ayam", "Tepung Terigu", "Kecap", "Garam", "Air Galon"
            ],
            datasets: [{
                label: "Data Stok",
                data: [10, 2, 1, 0, 5, 9, 1, 3, 6],
                backgroundColor: [
                    "#4e73df", // Beras
                    "#1cc88a", // Minyak
                    "#36b9cc", // Gula
                    "#f6c23e", // Mie
                    "#e74a3b", // Telur
                    "#6f42c1", // Tepung
                    "#fd7e14", // Kecap
                    "#20c997", // Garam
                    "#ff6384" // Air Galon
                ],

                borderColor: "#fff",
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            family: 'Open Sans',
                            size: 13
                        }
                    }
                }
            }
        }
    });
    </script>


    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector(idenav - scrollbar '), options);
                }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="<?= base_url("assets/js/argon-dashboard.min.js?v=2.1.0") ?>"></script>
</body>

</html>