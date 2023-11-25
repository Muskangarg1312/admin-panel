<?= $this->include('template/header') ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">All SMS Charges</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">SMS Charges</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All SMS Charges</li>
                </ol>
            </nav>
        </div>
        <div class="row table-scroll">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">All Entries</h4> -->
                        <!-- <p class="card-description"> Add class <code>.table-striped</code> -->
                            <?php if(session('message')):?>
                                <div class="alert alert-success">
                                    <?= session('message'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if(session('error')):?>
                                <div class="alert alert-danger">
                                    <?= session('error'); ?>
                                </div>
                            <?php endif; ?>
                            <table class="table table-striped" id="entryNewTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Bank Name</th>
                                        <th>Entry Date</th>
                                        <th>Value</th>
                                        <th>SGST</th>
                                        <th>CGST</th>
                                        <th>IGST</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  $i = 0;
                                  foreach ($charges as $charge):
                                    $i = $i+1;
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $charge['bank_name'] ?? '' ?></td>
                                        <td><?= $charge['date'] ? date('d-m-Y', strtotime($charge['date'])) : '' ?></td>
                                        <td><?= $charge['value'] ?></td>
                                        <td><?= $charge['sgst'] ?></td>
                                        <td><?= $charge['cgst'] ?></td>
                                        <td><?= $charge['igst'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($charge['created_at'])) ?? '' ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>sms-charges/<?= $charge['id'] ?>/edit" class="btn-sm btn-primary"><i class="mdi mdi-pencil text-white"></i></a> 
                                            <a href="<?= base_url() ?>sms-charges/<?= $charge['id'] ?>/delete" class="confirm_del_btn btn-sm btn-danger" data-id="<?= $charge['id'] ?>" data-keyword="sms-charges"><i class="mdi mdi-delete text-white"></i>
                                            </td>
                                        </tr> 
                                        <?php 
                                    endforeach; ?>   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?= $this->include('template/footer') ?>