<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h6>Daftar Pengguna</h6>
                    <button class="btn btn-xs bg-gradient-primary" id="btn_add_user" title="Tambah Pengguna"
                        data-action-form="<?= base_url('admin/insert-users') ?>">
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
                                    class="text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                    No</th>
                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Username</th>

                                <th
                                    class="text-center text-uppercase text-center text-secondary text-xs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody style=" font-size: 12px;">
                            <?php
                            $no = 1;
                            foreach($users as $val): ?>
                            <tr>
                                <td class="text-center">
                                    <?= $no++; ?>
                                </td>
                                <td class="text-center">
                                    <?= $val['username'] ?>
                                </td>

                                <td class="text-center">
                                    <button class="btn btn-xs bg-gradient-warning m-auto btn_update_user"
                                        data-action-form="<?= base_url('admin/update-users') ?>"
                                        data-user-id="<?= $val['id'] ?>" data-username="<?= $val['username'] ?>"><i
                                            class="fas fa-edit"></i></button> |
                                    <button type="button" class="btn btn-xs bg-gradient-danger m-auto btn_delete_user"
                                        data-action-form="<?= base_url('admin/delete-users') ?>"
                                        data-user-id="<?= $val['id'] ?>" data-username="<?= $val['username'] ?>"><i
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
                <h5 class="modal-title" id="modalAddLabel">Tambah User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form id="form_create_product">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" placeholder="Masukan Username" value="" name="username"
                            id="username" required>

                        <input type="hidden" class="form-control" value="" name="userid" id="userid" required>
                    </div>

                    <div id="jikaInputPassword">
                        <label class="form-label">Apakah ingin mengganti password?</label>
                        <div>
                            <input type="radio" id="gantiPasswordYa" name="change_password" value="1">
                            <label for="gantiPasswordYa">Ya</label>

                            <input type="radio" id="gantiPasswordTidak" name="change_password" value="0" checked>
                            <label for="gantiPasswordTidak">Tidak</label>
                        </div>
                    </div>

                    <div class="mb-3 d-none" id="inputPassword">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control" placeholder="Masukan Password" value=""
                            name="password" id="password">
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