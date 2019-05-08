<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo APP_NAME.' | Invoice'; ?></title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo file_exists(site_url(company("company-logo"))) ? site_url(company("company-logo")) : site_url('assets/dist/img/no-image.png') ;?>"
                                    style="width:100%; max-width:200px;">
                            </td>

                            <td>
                                Nomor Invoice #: <?php echo $data->invoices_invoice_number;?><br>
                                Tanggal Check In: <?php echo $data->invoices_check_in_on;?><br>
                                Tanggal Check Out: <?php echo $data->invoices_check_out_on; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <?php echo company("company-name");?>.<br>
                                <?php echo company("company-address");?><br>
                                <?php echo company("company-phone");?>
                            </td>

                            <td>
                                <?php echo $data->customers_name;?>.<br>
                                <?php echo $data->customers_address;?><br>
                                <?php echo $data->customers_phone;?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Jenis Pembayaran</td>
                <td></td>
            </tr>
            <?php if($data->invoices_payment_type == "0"): ?>
            <tr class="item">
                <td>Cash</td>
                <td></td>
            </tr>
            <?php Else: ?>
            <tr class="item">
                <td>Kredit</td>
                <td><?php echo $data->invoices_bank_name." / ".$data->invoices_credit_number; ?></td>
            </tr>
            <?php EndIf; ?>

            <tr class="heading">
                <td colspan="2">
                    Item
                </td>
            </tr>

            <?php $subtotal = 0;  foreach($detail_rooms as $room): ?>
            <tr class="item">
                <td>
                    <?php echo  "Kamar: ".$room->number." / "."type: ".$room->name." / Harga: ".$room->price." / Durasi: ".$room->duration." (Hari) ";?>
                </td>
                <td>
                    <?php echo $room->total;?>
                </td>
            </tr>
            <?php $subtotal += $room->total;  EndForeach; ?>

            <?php foreach($serviceSelected as $s): ?>
            <tr class="item">
                <td>
                    <?php echo $s->name; ?>
                </td>
                <td>
                    <?php echo $s->cost;?>
                </td>
            </tr>
            <?php $subtotal += $s->cost; EndForeach; ?>

            <?php foreach($extraSelected as $e): ?>
            <tr class="item">
                <td>
                    <?php echo $e->name; ?>
                </td>
                <td>
                    <?php echo $e->cost;?>
                </td>
            </tr>
            <?php $subtotal += $e->cost; EndForeach; ?>

            <tr class="total">
                <td></td>
                <td>
                    Sub Total: <?php echo $subtotal; ?>
                </td>
            </tr>

            <?php if(count($detail_discounts) > 0): ?>
            <tr class="heading">
                <td colspan="2">
                    Diskon
                </td>
            </tr>
            <?php $total_disc = 0; foreach($detail_discounts as $discount): ?>  
            <tr class="item">
                <td>
                    <?php echo $discount->name; ?>
                </td>
                <td style="">
                    (-) <?php echo ($discount->cost / 100) *  $subtotal; ?>
                </td>
            </tr>
            <?php $total_disc += ($discount->cost / 100) *  $subtotal;  EndForeach; ?>
            <?php EndIf; ?>

            <?php if(count($detail_taxes) > 0): ?>
            <tr class="heading">
                <td colspan="2">
                    Pajak
                </td>
            </tr>
            <?php $total_tax = 0; foreach($detail_taxes as $tax): ?>
            <tr class="item">
                <td>
                    <?php echo $tax->name; ?>
                </td>
                <td style="">
                    (+) <?php echo ($tax->cost / 100) *  $subtotal; ?>
                </td>
            </tr>
            <?php $total_tax += ($tax->cost / 100) *  $subtotal; EndForeach; ?>
            <?php EndIf; ?>
           

            <tr class="total">
                <td></td>
                <td>
                    Grand Total: <?php echo $data->invoices_due; ?>
                </td>
            </tr>
            <?php if($data->invoices_payment_type == "0"): ?>
            <tr class="total">
                <td></td>
                <td>
                    Cash: <?php echo $data->invoices_tendered; ?>
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                    Kembalian: <?php echo $data->invoices_change; ?>
                </td>
            </tr>
            <?php EndIf; ?>

        </table>
    </div>
</body>

</html>