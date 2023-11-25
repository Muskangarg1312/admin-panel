<?= $this->include('template/header') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit SMS Charge</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">SMS Charges</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit SMS Charge</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        //var_dump($smschargemodel);
                        $validation = \Config\Services::validation();
                        $errors = session('validation');
                        ?>
                        <form class="form-sample" method="post" action="<?= base_url(); ?>sms-charges/<?= $smschargemodel['id']?>/edit" id="entryForm">
                            <!-- <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> -->
                            <div id="alerts"></div>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" col-form-label label-with-asterisk">Select Bank <span class="text-danger">*</span></label>
                                        <select name="bank_id" class="form-control select--category select2">
                                                <option value="" selected="" disabled=""> Select an option</option>
                                                <?php foreach ($banks as $bank): ?>
                                                 <option name='bank_name' value="<?= $bank['id'] ?>" <?= ($smschargemodel['bank_id'] == $bank['id']) ? 'selected' : '' ?>><?= $bank['name'] ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                         <?php if ( $errors['bank_id'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['bank_id'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row ">
                                        <div class="form-group ">
                                            <label class=" col-form-label"> Entry Date</label>
                                            <div class="">
                                                <input type="date" class="form-control bg-white" name="date" value="<?= $smschargemodel['date'] ?>" id="date" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label label-with-asterisk">Value <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control select--value bg-white" name="value" value="<?= $smschargemodel['value'] ?> "/>
                                        <?php if ( $errors['value'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['value'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">SGST</label>
                                                <div class="">
                                                    <input type="text" class="form-control sgst" name="sgst" value="<?= $smschargemodel['sgst'] ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">CGST</label>
                                                <div class="">
                                                    <input type="text" class="form-control cgst" name="cgst" value="<?= $smschargemodel['cgst'] ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">IGST</label>
                                                <div class="">
                                                    <input type="text" class="form-control igst" name="igst" value="<?= $smschargemodel['igst'] ?>"  />
                                                </div>
                                            </div>
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
    </div>
</div>

<!--  -->

<?= $this->include('template/footer') ?>