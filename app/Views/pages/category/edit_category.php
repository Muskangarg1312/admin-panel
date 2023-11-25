<?= $this->include('template/header') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Category</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        $validation = \Config\Services::validation();
                        $errors = session('validation');
                        ?>
                        <!-- <h4 class="card-title">Edit Category</h4> -->
                        <form class="form-sample" method="post" action="<?= base_url(); ?>categories/<?= $category['id'] ?>/edit">
                         <input type="hidden" name="id" value="<?= $category['id'] ?>">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" value="<?= $category['name'] ?>" />
                                    </div>
                                    <?php if ( $errors['name'] ?? false ): ?>
                                        <div class="text-danger"><?= $errors['name'] ?? '' ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="description" value="<?= $category['description'] ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mb-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('template/footer') ?>