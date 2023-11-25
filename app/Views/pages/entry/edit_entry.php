<?= $this->include('template/header') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Entry</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Entries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Entry</li>
                </ol>
            </nav>
        </div>

        <?php //var_dump($entrymodel) ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        $validation = \Config\Services::validation();
                        $errors = session('validation');
                        ?>
                        <form class="form-sample" method="post" action="<?= base_url(); ?>entries/<?= $entrymodel['id']?>/edit" id="entryForm">
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
                                        <label class="col-form-label">Select Supplier <span class="text-danger">*</span></label>
                                        
                                        <select name="supplier_id" class="form-control select--supplier select2">
                                            <option value="" selected="" disabled=""> Select an option</option>
                                            <?php foreach ($suppliers as $supplier): ?>
                                                <option data-json='<?= json_encode($supplier) ?>' value="<?= $supplier['id'] ?>" <?= ($supplier['id'] == $entrymodel['supplier_id']) ? 'selected' : '' ?>><?= $supplier['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label">GST Type</label>
                                        
                                        <input type="text" class="form-control bg-white" name="gst_type" value="<?= $entrymodel['gst_type'] ?>" id="gst_type" readonly placeholder=""  />
                                        
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label"> Entry Date</label>
                                        
                                        <input type="date" class="form-control bg-white" name="date" id="date" value="<?= $entrymodel['date'] ?>"   />
                                        
                                    </div>

                                </div>
                                <?php if ( $errors['supplier_id'] ?? false ): ?>
                                    <div class="text-danger"><?= $errors['supplier_id'] ?? '' ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class=" col-form-label">Select Product Category <span class="text-danger">*</span></label>
                                        <select name="parent_category_id" class="form-control select--category select2">
                                            <option value="" selected="" disabled=""> Select an option</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option data-json='<?= json_encode($category) ?>' value="<?= $category['id'] ?>" <?= ($entrymodel['parent_category_id'] == $category['id']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if ( $errors['parent_category_id'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['parent_category_id'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class=" col-form-label">Select Product Sub Category <span class="text-danger">*</span></label>
                                        <select name="sub_category_id" class="form-control select--subcategory js-example-basic-single" id="subcategory">

                                            <?php if( $subcategories ) : ?>
                                                <?php foreach( $subcategories as $cat ) : ?>
                                                    <option <?= $entrymodel['sub_category_id'] == $cat['id'] ? 'selected' : ''  ?> value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                                    
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <!-- <option value="" selected="" disabled> Select an option</option> -->
                                        </select>
                                        <?php if ( $errors['sub_category_id'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['sub_category_id'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" col-form-label">Value <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control select--value" name="value" value="<?= $entrymodel['value'] ?>"/>
                                        <?php if ( $errors['value'] ?? false ): ?>
                                            <div class="text-danger"><?= $errors['value'] ?? '' ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group1 ">
                                        <label class="col-form-label percentage">GST Percentage(%) <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <label class="form-check-label"> <input type="radio" class="form-check-input" name="gst_percentage" id="membershipRadios1" value="0" <?= ($entrymodel['gst_percentage'] == '0') ? 'checked' : '' ?> /> 0% </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <label class="form-check-label"> <input type="radio" class="form-check-input" name="gst_percentage" id="membershipRadios2" value="5" <?= ($entrymodel['gst_percentage'] == '5') ? 'checked' : '' ?> /> 5% </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <label class="form-check-label"> <input type="radio" class="form-check-input" name="gst_percentage" id="membershipRadios3" value="12" <?= ($entrymodel['gst_percentage'] == '12') ? 'checked' : '' ?> /> 12% </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <label class="form-check-label"> <input type="radio" class="form-check-input" name="gst_percentage" id="membershipRadios4" value="18" <?= ($entrymodel['gst_percentage'] == '18') ? 'checked' : '' ?> /> 18% </label>
                                                </div>
                                            </div>
                                            <?php if ( $errors['gst_percentage'] ?? false ): ?>
                                                <div class="text-danger"><?= $errors['gst_percentage'] ?? '' ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class=" col-form-label">SGST</label>
                                        <div class="">
                                            <input type="text" class="form-control sgst" name="sgst" value="<?= $entrymodel['sgst'] ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class=" col-form-label">CGST</label>
                                        <div class="">
                                            <input type="text" class="form-control cgst" name="cgst" value="<?= $entrymodel['cgst'] ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class=" col-form-label">IGST</label>
                                        <div class="">
                                            <input type="text" class="form-control igst" name="igst" value="<?= $entrymodel['igst'] ?>"  />
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

    <script type="text/javascript">
     var base_url = $('base').attr('href');
     $(document).ready(function(){

             // document.getElementById('date').valueAsDate = new Date();
            //calculateGST();
         $('.select--supplier').on('change', function(event) {
            event.preventDefault();
                            /* Act on the event */
            var data = $('option:selected', this).attr('data-json');
            var supplierData = JSON.parse(data);
            $('#gst_type').val(supplierData.gst_type);
            console.log(data);
            calculateGST();
        });

         $('body').on('change', '.select--category', function(event) {
            event.preventDefault();

            console.log(this);

            var categoryId = $('option:selected', this).val();
            var subCategory = JSON.parse(categoryId);
            $('#subcategory').val(subCategory.subcategory);
            console.log(categoryId);

            $.ajax({
                url:  base_url + '/get-subcategories/' + categoryId,
                type: 'GET',
                success: function(data) {
                                    // Update the subcategory select options here
                                    // Example:
                    console.log(data);
                    $('.select--subcategory').empty();
                    $('.select--subcategory').append('<option value="" selected="" disabled> Select an option</option>');

                        // Then, append the subcategories
                    $.each(data, function(index, subcategory) {
                        $('.select--subcategory').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                    });

                    $('.select--subcategory').select2();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

         $('body').on('change', '.select--subcategory', function(event) {
            event.preventDefault();

            var selectedSubCategoryId = $(this).val();

                // Send the selected subcategory ID to your server
            $.ajax({
                url: base_url + '/store-selected-subcategory/'+ selectedSubCategoryId,
                type: 'POST',
                data: {
                    sub_category_id: selectedSubCategoryId
                },
                success: function(response) {
                    console.log(selectedSubCategoryId);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });



         $('.select--value').on('keyup', function(event) {
            event.preventDefault();
            calculateGST();
        });

         $('input[name="gst_percentage"]').on('change', function() {
            calculateGST();
        });

         function calculateGST() {
            var gstType = $('#gst_type').val().toUpperCase();
            var gstPercentage = $('input[name="gst_percentage"]:checked').val();
            var value = $('.select--value').val();

        if (gstPercentage) { // Check if a GST percentage is selected
            var z = cgst = sgst = igst = '';
            var divisor = 100 + parseFloat(gstPercentage);

            if (gstType === 'UP') {
                z = parseFloat(value * 100) / divisor;
                sgst = ((value - z) / 2).toFixed(2);
                cgst = ((value - z) / 2).toFixed(2);
            } else if (gstType === 'X-UP') {
                z = parseFloat(value * 100) / divisor;
                igst = (value - z).toFixed(2);
            }

            $('.sgst').val(sgst);
            $('.cgst').val(cgst);
            $('.igst').val(igst);
        } else {
            $('.sgst').val(''); // Clear the SGST field
            $('.cgst').val(''); // Clear the CGST field
            $('.igst').val(''); // Clear the IGST field
        }
    }


          //  $.ajaxSetup({
          //     headers: {
          //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          //     }
          // });

          //  console.log($('meta[name="csrf-token"]').attr('content'));

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
                }
                if(result.message) {
                   $('#alerts').html('<div class="alert alert-success">'+result.message+'</div>');
               }
               else if(result.failed) {
                $('#alerts').html('<div class="alert alert-danger">'+result.failed+'</div>');
            }
        }
        else if(result.errors) {
            var errors = result.errors;

            if(errors.supplier_id) {
                $('<span class="text-danger error-message">' + errors.supplier_id + '</span>').insertAfter($('select[name="supplier_id"]', $this).closest('div'));
            }
            if(errors.parent_category_id) {
                $('<span class="text-danger error-message">' + errors.parent_category_id + '</span>').insertAfter($('select[name="parent_category_id"]', $this).closest('div'));
            }
            if(errors.value) {
                $('<span class="text-danger error-message">' + errors.value + '</span>').insertAfter($('input[name="value"]', $this).closest('div'));
            }
            if(errors.gst_percentage) {
                $('<span class="text-danger error-message">' + errors.gst_percentage + '</span>').insertAfter($('.percentage', $this).closest('div'));
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