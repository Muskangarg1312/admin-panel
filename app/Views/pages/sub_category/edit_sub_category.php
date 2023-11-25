<?= $this->include('template/header') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Sub Category</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Sub Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Sub Category</li>
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
                        <!-- <h4 class="card-title">Edit Sub Category</h4> -->
                        <form class="form-sample" method="post" action="<?= base_url(); ?>sub-categories/<?= $sub_category['id'] ?>/edit">
                           <input type="hidden" name="id" value="<?= $sub_category['id'] ?>">
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
                                        <input type="text" class="form-control" name="name" value="<?= $sub_category['name'] ?>" />
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
                                    <label class="col-sm-3 col-form-label">Select Category <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                     <select name="parent_category_id" class="form-control-sm js-example-basic-single">
                                        <option value="" disabled>Select an Option</option>
                                        <?php foreach ($categories as $category): ?>
                                            <?php $selected = ($category['id'] == $sub_category['parent_category_id']) ? 'selected' : ''; ?>
                                            <option value="<?= $category['id'] ?>" <?= $selected ?>><?= $category['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php if ( $errors['parent_category_id'] ?? false ): ?>
                                    <div class="text-danger"><?= $errors['parent_category_id'] ?? '' ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="description" ><?= $sub_category['description'] ?></textarea>
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