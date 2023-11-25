<?= $this->include('template/header') ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">All Entries</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Entries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Entries</li>
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
                                        <th>Supplier Name</th>
                                        <th>Entry Date</th>
                                        <th>GST Type</th>
                                        <th>Category</th>
                                        <th>Value</th>
                                        <!-- <th>Percentage</th> -->
                                        <th>SGST</th>
                                        <th>CGST</th>
                                        <th>IGST</th>
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
                                        <td><?= $entry['supplier_name'] ?? '' ?></td>
                                        <td><?= $entry['date'] ? date('d-m-Y', strtotime($entry['date'])) : '' ?></td>
                                        <td><?= $entry['gst_type'] ?? '' ?></td>
                                        <td><?= $entry['category_name'] ?> > <?= $entry['subcategory_name'] ?? '' ?></td>
                                        <td><?= $entry['value'] ?></td>
                                        <!-- <td><?= $entry['gst_percentage'] ?></td> -->
                                        <td><?= $entry['sgst'] ?></td>
                                        <td><?= $entry['cgst'] ?></td>
                                        <td><?= $entry['igst'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($entry['created_at'])) ?? '' ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>entries/<?= $entry['id'] ?>/edit" class="btn-sm btn-primary"><i class="mdi mdi-pencil text-white"></i></a> 
                                            <a href="<?= base_url() ?>entries/<?= $entry['id'] ?>/delete" class="confirm_del_btn btn-sm btn-danger" data-id="<?= $entry['id'] ?>"  data-keyword="entries"><i class="mdi mdi-delete text-white"></i>
                                            </td>
                                        </tr> 
                                        <?php 
                                    endforeach; ?>   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                    <!-- <script src="<?= base_url() ?>public/assets/js/delete.js">

                      var base_url = $('base').attr('href');

                      $(document).ready(function() {
                        $('.confirm_del_btn').click(function (e) {
                          e.preventDefault();
                          var id = $(this).attr('data-id');
                          console.log('id = '+id);
                          swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this imaginary file!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel please!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm){
                            if (isConfirm) {
                              $.ajax({
                                url:  base_url + '/entries/' + id + '/delete',
                                success: function (response) {
                                 swal({
                                  title: response.status,
                                  text: response.status_text,
                                  type: response.type,
                              });
                                 if (response.type === 'success') {
                                    window.location.reload();
                                }
                            }
                        });
                          } else {
                              window.location.reload();
         // window.location.reload();
                          }
                      });
                      });
                    });
                </script> -->
                <?= $this->include('template/footer') ?>