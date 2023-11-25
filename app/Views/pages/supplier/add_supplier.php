<?= $this->include('template/header') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Add Supplier</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Supplier</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Supplier</li>
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
                        <!-- <h4 class="card-title">Add Supplier</h4> -->
                        <form class="form-sample" method="post" action="<?= base_url(); ?>add-supplier">
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
                                            <input type="text" class="form-control" name="name" value="<?= old('name') ?>" />
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
                                        <label class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="address" value="<?= old('address') ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">GST Type <span class="text-danger">*</span></label>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label"> <input type="radio" class="form-check-input" name="gst_type" id="membershipRadios1" value="UP" <?= (old('gst_type') == 'UP') ? 'checked' : '' ?> /> UP </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label"> <input type="radio" class="form-check-input" name="gst_type" id="membershipRadios2"  value="X-UP" <?= (old('gst_type') == 'X-UP') ? 'checked' : '' ?> /> X-UP </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label"> <input type="radio" class="form-check-input" name="gst_type" id="membershipRadios3"  value="Overseas" <?= (old('gst_type') == 'Overseas') ? 'checked' : '' ?> /> Overseas </label>
                                            </div>
                                        </div>
                                        <?php if ( $errors['gst_type'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['gst_type'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"> Contact Person Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="contact_person_name" value="<?= old('contact_person_name') ?>" />
                                        </div>
                                        <?php if ( $errors['contact_person_name'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['contact_person_name'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Contact Number</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="contact_number" value="<?= old('contact_number') ?>" />
                                        </div>
                                        <?php if ( $errors['contact_number'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['contact_number'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mb-2">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->include('template/footer') ?>