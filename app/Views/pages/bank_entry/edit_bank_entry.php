<?= $this->include('template/header') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Bank Entry</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Bank Entries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Bank Entry</li>
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
                        <form class="form-sample" method="post" action="<?= base_url(); ?>bank-entries/<?= $entrymodel['id']?>/edit" id="entryForm">
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
                                                 <option data-name='<?= $bank['name'] ?>' value="<?= $bank['id'] ?>" <?= ($entrymodel['bank_id'] == $bank['id']) ? 'selected' : '' ?>><?= $bank['name'] ?></option>
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

                          <?php //var_dump($entrymodel['suppliers']);
                          $selectedSuppliers = $entrymodel['suppliers'] ? json_decode($entrymodel['suppliers']) : false;
                          ?>

                          <div>
                            <table id="myNewTable" style="width: 100%;">
                                <?php if ($selectedSuppliers && count($selectedSuppliers) > 0) : ?>
                                    <?php foreach ($selectedSuppliers as $key => $s) : ?>

                                        <tr class="row">
                                            <td class="col-md-6">
                                                <div class="links">
                                                    <div class="form-group1">
                                                        <?php if ($key === 0) : ?>
                                                            <label class=" col-form-label">Select Supplier <span class="text-danger">*</span></label>
                                                        <?php endif; ?>
                                                        <div class="">
                                                            <select name="supplier_id" class="form-control select--supplier select2">
                                                                <option value="" selected="" disabled=""> Select an option</option>
                                                                <?php foreach ($suppliers as $supplier) : ?>
                                                                    <option data-name='<?= $supplier['name'] ?>' value="<?= $supplier['id'] ?>" <?= ($s->supplier_id == $supplier['id']) ? 'selected' : '' ?>><?= $supplier['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-md-5">
                                                <div class="keywords">
                                                    <div class="form-group1">
                                                        <?php if ($key === 0) : ?>
                                                            <label class="col-form-label">Value <span class="text-danger">*</span></label>
                                                        <?php endif; ?>
                                                        <input type="number" class="form-control select--value" name="value" value="<?= $s->value ?>" />
                                                        <?php if ($errors['value'] ?? false) : ?>
                                                            <div class="text-danger"><?= $errors['value'] ?? '' ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-md-1 m-lg-auto1">
                                                <?php if ($key < 1) : ?>
                                                    <i class="mdi mdi-plus-circle add text-success"></i>
                                                <?php else : ?>
                                                    <i class="mdi mdi-minus-circle delete text-danger"></i>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>

                                <?php else : ?>

                                    <tr class="row">
                                        <td class="col-md-6">
                                            <div class="links">
                                                <div class="form-group1">
                                                    <label class=" col-form-label">Select Supplier <span class="text-danger">*</span></label>
                                                    <div class="">
                                                        <select name="supplier_id" class="form-control select--supplier select2">
                                                            <option value="" selected="" disabled=""> Select an option</option>
                                                            <?php foreach ($suppliers as $supplier) : ?>
                                                                <option data-name='<?= $supplier['name'] ?>' value="<?= $supplier['id'] ?>" <?= (old('supplier_id') == $supplier['id']) ? 'selected' : '' ?>><?= $supplier['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-md-5">
                                            <div class="keywords">
                                                <div class="form-group1">
                                                    <label class="col-form-label">Value <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control select--value" name="value" value="<?= old('value') ?>" />
                                                    <?php if ($errors['value'] ?? false) : ?>
                                                        <div class="text-danger"><?= $errors['value'] ?? '' ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-md-1 m-lg-auto">
                                            <i class="mdi mdi-plus-circle add text-success"></i>
                                        </td>
                                    </tr>

                                <?php endif; ?>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Total Value <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control select--value bg-white" name="total_value" value="<?= $entrymodel['value'] ?> " readonly/>
                                    <?php if ( $errors['total_value'] ?? false ): ?>
                                        <div class="text-danger"><?= $errors['total_value'] ?? '' ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group ">
                                <label class=" col-form-label"> Entry Date</label>
                                <div class="">
                                   <input type="date" class="form-control bg-white" name="date" id="date" value="<?= $entrymodel['date'] ?>"   />
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

<script type="text/javascript">

 var base_url = $('base').attr('href');
 $(document).ready(function(){

     $('.select2').select2();


     $(document).on('click', '.add', function(event) {
        event.preventDefault();

        var row = $(this).closest('.row').html();
            // console.log('row', row);

        var myNewTable = document.getElementById("myNewTable");
        var currentIndex = myNewTable.rows.length;
        var currentRow = myNewTable.insertRow(-1);
            // currentRow.classList.add("row");
        $(currentRow).addClass('row');

    // Create the div with class "links"
        var linksDiv = document.createElement("div");
        linksDiv.classList.add("links");

    // Create the select field
        var selectField = document.createElement("select");
        selectField.classList.add("form-control");
        selectField.classList.add("select--supplier");
        selectField.classList.add("select2");
        selectField.setAttribute("name", "supplier_id" + currentIndex);

    // Add the default option
        var defaultOption = document.createElement("option");
        defaultOption.setAttribute("value", "");
        defaultOption.setAttribute("disabled", "true");
        defaultOption.setAttribute("selected", "true");
        defaultOption.innerHTML = "Select an option";
        selectField.appendChild(defaultOption);

    // Add the options from PHP loop
        <?php foreach ($suppliers as $supplier): ?>
            var option = document.createElement("option");
            option.setAttribute("data-name", '<?= $supplier['name'] ?>');
            option.setAttribute("data-json", '<?= json_encode($supplier) ?>');
            option.setAttribute("value", "<?= $supplier['id'] ?>");
            option.innerHTML = "<?= $supplier['name'] ?>";
            selectField.appendChild(option);
        <?php endforeach; ?>

    // Append the select field to the "links" div
        linksDiv.appendChild(selectField);
        $(selectField).select2(); 

        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(linksDiv);
        $(currentCell).addClass('col-md-6');

        var keywordsDiv = document.createElement("div");
        keywordsDiv.classList.add("keywords");

        var formGroup = document.createElement("div");
        formGroup.classList.add("form-group");

        var input = document.createElement("input");
        input.setAttribute("type", "number");
        input.classList.add("form-control");
        input.classList.add("select--value");
        input.setAttribute("name", "value" + currentIndex);
        input.setAttribute("value", "<?= old('value') ?>");

        var errorDiv = document.createElement("div");
        errorDiv.classList.add("text-danger");
        errorDiv.innerHTML = "<?= $errors['value'] ?? '' ?>";

        formGroup.appendChild(input);
        formGroup.appendChild(errorDiv);

        keywordsDiv.appendChild(formGroup);

        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(keywordsDiv);
        $(currentCell).addClass('col-md-5');
            // console.log(currentCell);

        var deleteRowBox = document.createElement("i");
        deleteRowBox.setAttribute("class", "button delete mdi mdi-minus-circle text-danger");

        currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(deleteRowBox);
        $(currentCell).addClass('col-md-1');
        $(currentCell).addClass('my-auto1');

    });



     $(document).on('click', '.delete', function(event) {
        event.preventDefault();
        if( confirm('Are you sure?') ) {
            var row = this.closest('tr');
            row.remove();
            calculateTotalValue();
        }
    });

     $(document).on('input', 'input[name^="value"]', function() {
        calculateTotalValue();
    });

     function calculateTotalValue() {
        var total = 0;

            // Loop through all input fields with the name "value"
        $('input[name^="value"]').each(function() {
                // Parse the value to a float (assuming they are numbers)
            var value = parseFloat($(this).val());

                // Add the value to the total (if it's a valid number)
            if (!isNaN(value)) {
                total += value;
            }
        });

            // Update the "Total Value" input field
        $('input[name="total_value"]').val(total);
    }

    $('body').on('submit', '#entryForm', function(event) {
        event.preventDefault();
        var $this = $(this);
        $this.find('.error-message').remove();

        if( false === validateForm($this) ) {
            var bank_id = $('select[name="parent_bank_id"]').val();
            var bank_name = $('select[name="parent_bank_id"]').children('option:selected').attr('data-name');
            var mode = $('input[name="mode"]:checked').val();
            var date = $('input[name="date"]').val();
            var total_value = $('input[name="total_value"]').val();

            var suppliers = [];
            $('#myNewTable').find('tr').each(function(index, el) {
                var supplier = $(this).find('select').val();
                var supplier_name = $(this).find('select').children('option:selected').attr('data-name');
                var value = $(this).find('input').val();
                suppliers.push({supplier_id:supplier, supplier_name:supplier_name, value: value});
            });

            var fd = new FormData();
            fd.append('bank_id', bank_id);
            fd.append('bank_name', bank_name);
            fd.append('mode', mode);
            fd.append('date', date);
            fd.append('total_value', total_value);
            fd.append('suppliers', JSON.stringify(suppliers));


            $.ajax({
                url: $this.attr('action'),
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                cache: false
            })
            .done(function(result) {
                console.log("result", result);

                if(result.status) {
                    var status = result.status;

                    if( status === 'success' ) {
                                 // $this.trigger('reset');
                     // $this.find('.select2').select2();
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

            if(errors.supplier_id) {
                $('<span class="text-danger error-message">' + errors.supplier_id + '</span>').insertAfter($('select[name="supplier_id"]', $this).closest('div'));
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
        }


    });

    function validateForm(form) {

        var error = false;
        var bank = $('select[name="parent_bank_id"]');
        if( !bank.val() ) {
            showErrorMessage('Bank is required', bank.closest('div'));
            error = true;

        }


        var mode = $('input[name="mode"]');
        if( !mode.is(":checked") ) {
            showErrorMessage('Payment mode is required', mode.closest('div'));
            error = true;

        }


        $('#myNewTable').find('tr').each(function(index, el) {
            var select = $(this).find('select');
            if( !select || !select.val() ) {

                showErrorMessage('Supplier is required', select.closest('div'));
                error = true;

            }

            var input = $(this).find('input');
            if( !input || !input.val() ) {

                showErrorMessage('Value is required', input);
                error = true;

            }
        });

        var total_value = $('input[name="total_value"]');
        if( !total_value.val() ) {
            showErrorMessage('Total value is required', total_value);
            error = true;

        }



        return error;

    }


    function showErrorMessage(message, selector) {
        if( !message )
            return;

        $('<span class="text-danger error-message">' + message + '</span>').insertAfter(selector);
    }
});
</script>

<?= $this->include('template/footer') ?>