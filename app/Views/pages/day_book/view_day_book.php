<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PREMIER LEGGUARD WORKS</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendors/css/vendor.bundle.base.css">
  
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= base_url() ?>public/assets/images/favicon.ico" />
<style> 
    .table td{
        line-height: 1.5!important;
        font-size: 15px;
        font-weight: 600;
    }
    .table th{
        line-height: 1.5!important;
        font-size: 20px;
        font-weight: bold;
    }
</style>
<script>
function printPage() {
    // Hide the print button
    document.querySelector('.print-button').style.display = 'none';

    // Print the page
    window.print();

    // Restore the print button after printing
    document.querySelector('.print-button').style.display = 'block';
}
</script>
</head>

<body>
    <?php if (!empty($day_book)): ?>
        <div class="main-panel1">
            <div class="page-header1 p-3 bg-warning text-dark d-flex justify-content-between">
                <div class=""><h3 class=" font-weight-bold">Day Book (<?= date('d-m-Y', strtotime($date)) ?>)</h3></div>
                <div class=""><button class="btn btn-light print-button" onclick="printPage()">Print</button></div>
            </div>
        <div class="row bg-light">
            <div class="col-12">
                <table class="table text-center table-bordered" id="entryNewTable">
                    <thead class="bg-dark text-light">
                        <tr>
                            <!-- <th>Type</th> -->
                            <th>Data</th>
                            <th>Data</th>
                            <!-- Add more table headers if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php  foreach ($day_book as $entry): ?>
                            <tr>
                                <!-- <td><?= $entry['type'] ?></td> -->
                                <td>
                                    <?php
                                    $type = $entry['type'];
                                    $data = json_decode($entry['data'], true);

                                    switch ($type) {
                                        case 'sms_charges':
                                        echo  "Bank Name -  " . $data['bank_name'] . "<br> ₹" . $data['value'];
                                        break;
                                        case 'customer_entry':
                                        echo "Customer Name -  " . $data['customer_name']. "<br> ₹" . $data['value'];
                                        break;
                                        case 'voucher_entry':
                                        echo "Supplier Name -  " . $data['supplier_name']. "<br> GST Type -  " . $data['gst_type']  ;
                                        break;

                                        case 'bank_entry':

                                        //$suppliers = json_decode($data['suppliers']);
                                            //dd($suppliers);
                                        // foreach ($suppliers as $key => $row) {

                                        //     echo  $row->supplier_name . ", ₹" . $row->value . "<br>";
                                        // }
                                        echo  "Bank Name -  " . $data['bank_name'] ."<br>Mode -  " . $data['mode'] . "<br> Total - ₹" . $data['value'] ;
                                        break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $type = $entry['type'];
                                    $data = json_decode($entry['data'], true);

                                    switch ($type) {
                                        case 'sms_charges':
                                        echo  "Bank Name -  " . $data['bank_name'] . "<br> ₹" . $data['value']. "<br> " ;
                                        echo !empty($data['sgst']) ? "SGST - " . $data['sgst'] . "<br>" : "";
                                        echo !empty($data['cgst']) ? "CGST - " . $data['cgst'] . "<br>" : "";
                                        echo !empty($data['igst']) ? "IGST - " . $data['igst'] . "<br>" : "";
                                        ;
                                        break;
                                        case 'customer_entry':
                                        echo "Customer Name -  " . $data['customer_name'] . "<br> Mode -  " . $data['mode'] . "<br> Bank Name -  " . $data['bank_name']. "<br> ₹" . $data['value'];
                                        break;
                                        case 'voucher_entry':
                                        echo "Supplier Name -  " . $data['supplier_name'] . "<br>";
                                        echo "Category -  " . $data['category_name'] . " > " . $data['subcategory_name'] . "<br>";
                                        echo "GST Type -  " . $data['gst_type'] . "<br>";
                                        echo "GST Percentage -  " . $data['gst_percentage'] . "<br>";
                                        echo "Value -  " . $data['value'] . "<br>";
                                        echo !empty($data['sgst']) ? "SGST - " . $data['sgst'] . "<br>" : "";
                                        echo !empty($data['cgst']) ? "CGST - " . $data['cgst'] . "<br>" : "";
                                        echo !empty($data['igst']) ? "IGST - " . $data['igst'] . "<br>" : "";


                                        break;

                                        case 'bank_entry':

                                        $suppliers = json_decode($data['suppliers']);

                                        foreach ($suppliers as $key => $row) {

                                            echo  $row->supplier_name . ", ₹" . $row->value . "<br>";
                                        }
                                        echo  "Bank Name -  " . $data['bank_name'] ."<br>Mode -  " . $data['mode'] . "<br> Total - ₹" . $data['value'] ;
                                        break;
                                    }
                                    ?>
                                </td>
                                <!-- Add more table cells for other properties -->
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h4 class="text-center p-3">No data available for this date.</h4>
                    <?php endif; ?> 
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>