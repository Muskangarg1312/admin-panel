<?= $this->include('template/header') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Customer Entry</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Customer Entries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Customer Entry</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        //var_dump($entrymodel);
                        $validation = \Config\Services::validation();
                        $errors = session('validation');
                        ?>
                        <form class="form-sample" method="post" action="<?= base_url(); ?>customer-entries/<?= $entrymodel['id']?>/edit" id="entryForm">
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
                                        <label class=" col-form-label">Select Bank <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select name="parent_bank_id" class="form-control select--category select2">
                                                <option value="" selected="" disabled=""> Select an option</option>
                                                <?php foreach ($banks as $bank): ?>
                                                     <option data-json='<?= json_encode($bank) ?>' value="<?= $bank['name'] ?>" <?= ($entrymodel['bank_name'] == $bank['name']) ? 'selected' : '' ?>><?= $bank['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php if ( $errors['parent_bank_id'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['parent_bank_id'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row ">
                                        <div class="col-md-12 ">
                                            <div class="form-group1">
                                                <label class=" col-form-label payment">Mode <span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                            <label class="form-check-label"> <input type="radio" class="form-check-input" name="mode" id="membershipRadios1" value="NEFT"<?= ($entrymodel['mode'] == 'NEFT') ? 'checked' : '' ?>  /> NEFT</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                            <label class="form-check-label"> <input type="radio" class="form-check-input" name="mode" id="membershipRadios2"  value="Transfer" <?= ($entrymodel['mode'] == 'Transfer') ? 'checked' : '' ?>  /> Transfer </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ( $errors['mode'] ?? false ): ?>
                                                    <div class="text-danger"><?= $errors['mode'] ?? '' ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div >
                                <div class="row">
                                    <div class="col-md-6" >
                                        <div class="form-group ">
                                            <label class=" col-form-label">Select Customer <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="customer_id" class="form-control select--customer select2">
                                                    <option value="" selected="" disabled=""> Select an option</option>
                                                    <?php foreach ($customers as $customer): ?>
                                                        <option data-json='<?= json_encode($customer) ?>' value="<?= $customer['name'] ?>" <?= ($entrymodel['customer_name'] == $customer['name']) ? 'selected' : '' ?>><?= $customer['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label class="col-form-label">Value <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control select--value" name="value" value="<?= $entrymodel['value'] ?>"/>
                                            <?php if ( $errors['value'] ?? false ): ?>
                                                <div class="text-danger"><?= $errors['value'] ?? '' ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class=" col-form-label"> Entry Date</label>
                                            <div class="">
                                                <input type="date" class="form-control bg-white" name="date" id="date" value="<?= $entrymodel['date'] ?>"   />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
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

<script type="text/javascript">

   var base_url = $('base').attr('href');
   $(document).ready(function(){

       $('.select2').select2();

       $('.select--customer').on('change', function(event) {
        event.preventDefault();
                        /* Act on the event */
        var data = $('option:selected', this).attr('data-json');
        var customerData = JSON.parse(data);
        console.log(data);
    });


       $('body').on('submit', '#entryForm', function(event) {
        event.preventDefault();
        var $this = $(this);

                // Clear previous error messages
        // $this.find('.text-danger').remove();
        $this.find('.error-message').remove();

        var fd = $this.serialize();

        $.ajax({
            url: $this.attr('action'),
            type: 'POST',
            data: fd,
            dataType: "json",
        })
        .done(function(result) {
            console.log("result", result);

            if(result.status) {
                var status = result.status;

                if( status === 'success' ) {
                   // $this.trigger('reset');
                   $this.find('.select2').select2();
                             // $('#alerts').html('<div class="alert alert-success">'+result.message+'</div>');

               }
               if(result.message) {
                 $('#alerts').html('<div class="alert alert-success">'+result.message+'</div>');
                 // window.location.reload();
                             // $('#alerts').html('<div class="alert alert-success">'+result.message+'</div>');
             }
             else if(result.failed) {
                $('#alerts').html('<div class="alert alert-danger">'+result.failed+'</div>');
            }
        }
        else if(result.errors) {
            var errors = result.errors;

            if(errors.parent_bank_id) {
                $('<span class="text-danger error-message">' + errors.parent_bank_id + '</span>').insertAfter($('select[name="parent_bank_id"]', $this).closest('div'));
            }
            if(errors.mode) {
                $('<span class="text-danger error-message">' + errors.mode + '</span>').insertAfter($('.payment', $this).closest('div'));
            }

            if(errors.customer_id) {
                $('<span class="text-danger error-message">' + errors.customer_id + '</span>').insertAfter($('select[name="customer_id"]', $this).closest('div'));
            }

            if(errors.value) {
                $('<span class="text-danger error-message">' + errors.value + '</span>').insertAfter($('input[name="value"]', $this).closest('div'));
            }
        }
    })
        .fail(function(error) {
            console.log("error", error);
        })
        .always(function() {
            console.log("complete");
        });
    });
   });
</script>

<?= $this->include('template/footer') ?>