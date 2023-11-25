<?= $this->include('template/header') ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">All Sub Categories</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Sub Categories</li>
                </ol>
            </nav>
        </div>
        <div class="row table-scroll">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">All Sub Categories</h4> -->
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
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Parent Category</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 0;
                                    foreach ($sub_categories as $category):
                                        $i = $i+1;
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $category['name'] ?></td>
                                            <td><?= $category['category_name'] ?? '' ?></td>
                                            <td><?= $category['description'] ?></td>
                                            <td><a href="<?= base_url() ?>sub-categories/<?= $category['id'] ?>/edit" class="btn-sm btn-primary"><i class="mdi mdi-pencil text-white"></i></a> 
                                                <a href="<?= base_url() ?>sub-categories/<?= $category['id'] ?>/delete" class="confirm_del_btn btn-sm btn-danger" data-id="<?= $category['id'] ?>" data-keyword="sub-categories"><i class="mdi mdi-delete text-white"></i></td>
                                                </tr>
                                                <?php 
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?= $this->include('template/footer') ?>