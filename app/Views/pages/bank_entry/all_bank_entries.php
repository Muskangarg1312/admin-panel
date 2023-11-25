<?= $this->include('template/header') ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">All Bank Entries</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Bank Entries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Bank Entries</li>
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
                            <table class="table table-striped" id="entryTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Bank Name</th>
                                        <th>Mode</th>
                                        <th>Entry Date</th>
                                        <th>Suppliers</th>
                                        <th>Total Value</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  $i = 0;
                                  foreach ($entries as $entry):
                                    $i = $i+1;
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $entry['bank_name'] ?? '' ?></td>
                                        <td><?= $entry['mode'] ?></td>
                                        <td><?= $entry['date'] ? date('d-m-Y', strtotime($entry['date'])) : '' ?></td>
                                        <td>
                                         <?php
                                         $jsonData = $entry['suppliers'];
                                         $suppliers = json_decode($jsonData, true);

                                         if ($suppliers) {
                                            $totalSuppliers = count($suppliers);
                                            $counter = 1;

                                            foreach ($suppliers as $supplier) {
                                                $supplierName = $supplier['supplier_name'] ?? '';
                                                $value = $supplier['value'] ?? '';

                                                echo "Name: $supplierName, ₹$value";

                                                if ($counter < $totalSuppliers) {
                                                        echo " | "; // Add separator for non-last entries
                                                    }

                                                    $counter++;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td><?= $entry['value'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($entry['created_at'])) ?? '' ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>bank-entries/<?= $entry['id'] ?>/edit" class="btn-sm btn-primary"><i class="mdi mdi-pencil text-white"></i></a> 
                                            <a href="<?= base_url() ?>bank-entries/<?= $entry['id'] ?>/delete" class="confirm_del_btn btn-sm btn-danger" data-id="<?= $entry['id'] ?>" data-keyword="bank-entries"><i class="mdi mdi-delete text-white"></i>
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