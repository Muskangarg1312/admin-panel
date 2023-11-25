<?= $this->include('template/header') ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">All Entries</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"> Entries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Entries</li>
                </ol>
            </nav>
        </div>
        <div class="row table-scroll">
            <?php //var_dump($dates) ?>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
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
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Entry Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 0;
                                    foreach ($dates as $date):
                                        $i = $i+1;
                                        ?>
                                        <tr>
                                          <td><?= $i ?></td>
                                          <td><?= $date->date ? date('d-m-Y', strtotime($date->date)) : '' ?></td>
                                          <td><a href="<?= base_url() ?>day-book/<?= $date->date ?>/view" target="_blank" class="btn-sm btn-info"><i class="mdi mdi-eye text-white"></i></a> </td>
                                      </tr>
                                      <?php 
                                  endforeach; ?> 
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <?= $this->include('template/footer') ?>