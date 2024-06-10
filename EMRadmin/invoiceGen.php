<?php include('includes/configset.php');
if(isset($_REQUEST['view'])){
	$invoice_id= $_REQUEST['view'];
 	$invoiceSql=mysqli_query($link,"select * from invoice WHERE invoice_id='$invoice_id'"); 
	$listRow=mysqli_fetch_array($invoiceSql);
}
require_once 'vendor/autoload.php';
$ntw = new \NTWIndia\NTWIndia();

?>
<!DOCTYPE html>
<html lang="en, id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      invoice Generete
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
	  <script src="assets/js/af.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
	  <script type="text/javascript">
	$(document).ready(function($) 
	{ 

		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();

			//credit : https://ekoopmans.github.io/html2pdf.js
			
			var element = document.getElementById('container_content'); 

			//easy
			//html2pdf().from(element).save();

			//custom file name
			//html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();


			//more custom settings
			var opt = 
			{
			  margin:       0,
			  filename:     'pageContent_'+js.AutoCode()+'.pdf',
			  image:        { type: 'jpeg', quality: 0.98 },
			  html2canvas:  { scale: 1 },
			  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
			};

			// New Promise-based usage:
			html2pdf().set(opt).from(element).save();

			 
		});

 
 
	});
	</script>
	  <style>
	  @import "https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap";
* {
  margin: 0 auto;
  padding: 0 auto;
  user-select: none;
}

body {
  padding: 20px;
  font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  -webkit-font-smoothing: antialiased;
  background-color: #dcdcdc;
	font-size: 14px;
	font-weight: bold;
}

.wrapper-invoice {
  display: flex;
  justify-content: center;
}
 .invoice {
  height: auto;
  background: #fff;
  padding: 2vh;
  margin-top: 5vh;
  max-width: 110vh;
  width: 100%;
  box-sizing: border-box;
  border: 1px solid #dcdcdc;
}
.invoice .invoice-information {
  float: right;
  text-align: right;
}
 .invoice .invoice-information b {
  color: #000;
}
.invoice .invoice-information p {
  font-size: 14px;
  color: #000;
}
 .invoice .invoice-logo-brand h2 {
  text-transform: uppercase;
  font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-size: 2.9vh;
  color: #000;
}
 .invoice .invoice-logo-brand img {
  max-width: 100px;
  width: 100%;
  object-fit: fill;
}
 .invoice .invoice-head {
  display: flex;
  margin-top: 0;
    border: 1px solid #333;
	width: 100%;
}
 .invoice .invoice-head .head {
  width: 100%;
  box-sizing: border-box;
	padding: 5px;
}
 .invoice .invoice-head .client-info {
  text-align: left;
    border-right: 1px solid #333;
    margin-right: 20px;
    padding: 5px
}
 .invoice .invoice-head .client-info h2 {
  font-weight: 500;
  letter-spacing: 0.3px;
  font-size: 14px;
  color: #000;
}
 .invoice .invoice-head .client-info p {
  font-size: 14px;
  color: #000;
}
 .invoice .invoice-head .client-data {

}
 .invoice .invoice-head .client-data h2 {
  font-weight: 500;
  letter-spacing: 0.3px;
  font-size: 14px;
  color: #000;
}
		  table tr{
			  line-height: 1.2;
		  }
 .invoice .invoice-head .client-data p {
  font-size: 14px;
  color: #000;
}
 .invoice .invoice-body {
  margin-top: 2vh;
}
 .invoice .invoice-body .table {
  border-collapse: collapse;
  width: 100%;
}
 .invoice .invoice-body .table thead tr th {
  font-size: 14px;
  border: 1px solid #000;
  text-align: left;
  padding: 1vh;
  background-color: #fff;
}
 .invoice .invoice-body .table tbody tr td {
  font-size: 14px;
  border: 1px solid #dcdcdc;
  text-align: left;
  padding: 1vh;
  background-color: #fff;
}
 .invoice .invoice-body .table tbody tr td:nth-child(2) {
  text-align: right;
}
.invoice .invoice-body .flex-table {
  display: flex;
}
.invoice .invoice-body .flex-table .flex-column {
  width: 100%;
  box-sizing: border-box;
}
.invoice .invoice-body .flex-table .flex-column .table-subtotal {
  border-collapse: collapse;
  box-sizing: border-box;
  width: 100%;
  margin-top: 16px;
}
 .invoice .invoice-body .flex-table .flex-column .table-subtotal tbody tr td {
  font-size: 14px;
  border-bottom: 1px solid #dcdcdc;
  text-align: left;
  padding: 1vh;
  background-color: #fff;
}
.invoice .invoice-body .flex-table .flex-column .table-subtotal tbody tr td:nth-child(2) {
  text-align: right;
}
.invoice .invoice-body .invoice-total-amount {
  margin-top: 1rem;
	float: right
}
 .invoice .invoice-body .invoice-total-amount p {
  font-weight: bold;
  color: #000;
  text-align: right;
  font-size: 14px;
}
 .invoice .invoice-footer {
  margin-top: 1vh;
}
 .invoice .invoice-footer p {
  font-size: 1.7vh;
  color: #000;
}

.copyright {
  margin-top: 2rem;
  text-align: center;
}
.copyright p {
  color: #000;
  font-size: 1.8vh;
}

@media print {
  .table thead tr th {
    -webkit-print-color-adjust: exact;
    background-color: #eeeeee !important;
  }

  .copyright {
    display: none;
  }
}
.rtl {
  direction: rtl;
  font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
.rtl .invoice-information {
  float: left !important;
  text-align: left !important;
}
.rtl .invoice-head .client-info {
  text-align: right !important;
}
.rtl .invoice-head .client-data {
  text-align: left !important;
}
.rtl .invoice-body .table thead tr th {
  text-align: right !important;
}
.rtl .invoice-body .table tbody tr td {
  text-align: right !important;
}
.rtl .invoice-body .table tbody tr td:nth-child(2) {
  text-align: left !important;
}
.rtl .invoice-body .flex-table .flex-column .table-subtotal tbody tr td {
  text-align: right !important;
}
.rtl .invoice-body .flex-table .flex-column .table-subtotal tbody tr td:nth-child(2) {
  text-align: left !important;
}
.rtl .invoice-body .invoice-total-amount p {
  text-align: left !important;
}
	  </style>
  </head>
  <body>
	 <div align="right"> <input type="button" id="rep" value="Download in PDF" class="btn btn-info btn_print"></div>
    <section class="wrapper-invoice">
		
      <!-- switch mode rtl by adding class rtl on invoice class -->
      <div class="invoice" id="container_content">
		  
		  <div style=" width: 100%; padding-bottom: 20px;">
			  <div style="float: left; width: 15%; height: 145px">
          <!-- <h2>Tampsh.</h2> -->
          <img src="assets/images/tampsh.png" alt="" style="width: 100%" />
        </div>
			<div style="float: left; width: 70%; height: 145px">  
			<div style="font-weight: bold; text-decoration: underline">Tax Invoice</div>
			<h1 style="margin: 5px 0; text-transform: uppercase; font-weight: bold; font-size: 25px;">EMR Marketing LLC</h1>
			<div style="width: 100%;">Shop No.2, Opp New Airport Authority of India Building, Sahar Road, Parsiwada, Andheri-East,Mumbai-400099</div>
			<div><strong>PAN :</strong> AXDPN7736L,<strong>Phone :</strong> +91 9867724488/9136663355, support@emrmarketing.in</div>
			<div></div>
			 </div> 
			<div style="float: right; width: 15%; text-align: right;height: 145px">
          <!-- <h2>Tampsh.</h2> -->
          <img src="assets/images/scan.jpg" alt=""  style="width: 100%" />
        </div>
			  <div style="clear: both"></div>
		</div>
		  
        
        <!-- logo brand invoice -->
        
        <!-- invoice head -->
        <div class="invoice-head">
          <div class="head client-info">
			  <table width="100%">
			  <tr>
				  <td width="36%"><strong>Invoice No.</strong></td>
				  <td width="5%">:</td>
				  <td width="59%"><?php echo $listRow['invoice_no'];?></td>
				  </tr>
				  <tr>
					  <td><strong>Dated</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['date'];?></td>
				  </tr>
				  
				  <tr>
					  <td><strong>Place of Supply</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['place_supply'];?></td>
				  </tr>
				  <tr>
					  <td><strong>Revers Charge</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['reverse_charge'];?></td>
				  </tr>
				  <tr>
					  <td><strong>Transport</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['transport'];?></td>
				  </tr>
				  <tr>
					  <td><strong>Vechicle No.</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['vehicle_no'];?></td>
				  </tr>
				  
			  </table>
            
          </div>
          <div class="head client-data">
			  <table width="100%">
			  <tr>
				  <td width="36%"><strong>Station</strong></td>
				  <td width="5%">:</td>
				  <td width="59%"><?php echo $listRow['station'];?></td>
				  </tr>
				  <tr>
					  <td><strong>E-Way Bill No.</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['e_way_bill_no'];?></td>
				  </tr>
				  
				  <tr>
					  <td><strong>ORDERED BY</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['order_by'];?></td>
				  </tr>
				  <tr>
					  <td><strong>Brand Name</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['brand_name'];?></td>
				  </tr>
				  <tr>
					  <td><strong>Payment Terms</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['payment_terms'];?></td>
				  </tr>
				 
				  
			  </table>
            
          </div>
        </div>
		  <div class="invoice-head" style="border-top: none">
          <div class="head client-info">
			  <p style="margin-bottom: 20px;"><strong>Billed to :<br> <?php echo $listRow['biller_name'];?></strong><br><?php echo $listRow['address'];?></p>
			  <table width="100%">
			  <tr>
				  <td width="36%"><strong>Party Mobile No.</strong></td>
				  <td width="5%">:</td>
				  <td width="59%"><?php echo $listRow['party_mobile_no'];?></td>
				  </tr>
				  <tr>
					  <td><strong>GSTIN / UIN</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['gstn_unit'];?></td>
				  </tr>
			  </table>
            
          </div>
          <div class="head client-data">
			   <p style="margin-bottom: 20px;"><strong>Shipped to :<br> <?php echo $listRow['name'];?></strong><br><?php echo $listRow['shipp_address'];?></p>
			  <table width="100%">
			  <tr>
				  <td width="36%"><strong>Party Mobile No.</strong></td>
				  <td width="5%">:</td>
				  <td width="59%"><?php echo $listRow['party_mobile_no'];?></td>
				  </tr>
				  <tr>
					  <td><strong>GSTIN / UIN</strong></td>
					  <td>:</td>
					  <td><?php echo $listRow['gstn_unit'];?></td>
				  </tr>
			  </table>
            
          </div>
        </div>
		  <?php if($listRow['utr_num']){?>
		  <div style="border: 1px solid #333; padding: 10px; border-top: none"><strong>UTR No.:</strong> <?php echo $listRow['utr_num'];?></div>
		  <?php } ?>
        <!-- invoice body-->
        <div class="invoice-body">
          <table class="table">
            <thead>
              <tr>
                <th>Description of Goods</th>
                <th>HSN/SAC Code</th>
				  <th>Qty</th>
				  <th>Unit</th>
				  <th>MRP</th>
				  <th>Price</th>
				  <th>IGST Rate</th>
				  <th>IGST Ammount</th>
				  <th>Ammount</th>
              </tr>
            </thead>
            <tbody>
			<?php 
				$invoiceItemSql=mysqli_query($link,"select * from invoice_item WHERE invoice_id='$invoice_id'"); 
	while($listItemRow=mysqli_fetch_array($invoiceItemSql)){
				?>
              <tr>
                <td><?php echo $listItemRow['vname'];?></td>
                <td><?php echo $listItemRow['hsn_sac_code'];?></td>
				  <td><?php echo $listItemRow['qty'];?></td>
				  <td><?php echo $listItemRow['unit'];?></td>
				  <td><?php if($listItemRow['mrp']){ echo number_format($listItemRow['mrp'],2, '.', ',');}?></td>
				  <td><?php echo number_format($listItemRow['price'],2, '.', ',');?></td>
				  <td><?php if($listItemRow['gst']){echo $listItemRow['gst']."%";}?></td>
				  <td><?php
		if($listItemRow['gst']){$gstV =$listItemRow['gst']; }else{$gstV =0;}
		$igstamount = ($listItemRow['qty']*$listItemRow['price'])/100*$gstV;
		if($igstamount > 0){
		echo number_format($igstamount,2, '.', ',');
		}
					  ?></td>
				  <td><?php  $subtotal = ($listItemRow['qty']*$listItemRow['price'])+$igstamount;
		$subtotal2+=$subtotal;
					  echo number_format($subtotal,2, '.', ',');?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="flex-table">
            <div class="flex-column"></div>
            <div class="flex-column">
<!--
              <table class="table-subtotal">
                <tbody>
                  <tr>
                    <td>Grand Total</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>PPN 10%</td>
                    <td>Rp.5.000</td>
                  </tr>
                  <tr>
                    <td>Credit</td>
                    <td>Rp.0</td>
                  </tr>
                </tbody>
              </table>
-->
            </div>
          </div>
          <!-- invoice total  -->
          <div class="invoice-total-amount">
			  
            <p>Total : <?php echo number_format($subtotal2,2, '.', ',');?></p>
          </div>
        </div>
        <!-- invoice footer -->
        <div class="invoice-footer">
			
          <p><strong><?php echo $ntw->numToWord( $subtotal2 )." Only";?></strong></p>
        </div>
		  <div style="margin: auto; width: 100%; border: 1px solid #333;padding: 10px; text-align: center; margin-top: 20px;">
			  <h5 style="margin: 0; padding: 0;">Other Payment Mode</h5>
			  <p style="margin: 0; padding: 0;"><strong>UPI ID -</strong> 8097798771@ybi</p>
		  </div>
		  <div style="margin: auto; width: 100%; border: 1px solid #333;padding: 10px; text-align: center; border-top: none">
			  
			  <p style="margin: 0; padding: 0;"><strong>Bank Details :</strong>Benificy:EMR MARKETING LLP, CA NO. 001212100040740, IFSC - BCBM0000013 BHARAT CO-OPERATIVE BANK(MUMBAI) </p>
		  </div>
		  <div style="margin: auto; width: 100%; border: 1px solid #333;padding: 10px; text-align: center; border-top: none">
			  <div style=" text-align: left; width: 48%; float: left;">
			  <h5 style="margin: 0; padding: 0;">Terms & Conditions</h5>
<p style="margin: 0; padding: 0;"><strong>E.& O.E.</strong> <br>
1. Goods once sold will not be taken back. <br>
2. Interest @ 18% p.a. will be charged if the payment<br>
is not made with in the stipulated time. <br>
3. Subject to 'Mumbai' Jurisdiction only.</p>
			  </div>
			<div style=" text-align: left; width: 50%; float: left; border-left: 1px solid #333;">
				<div style=" padding:0 0 5px 5px; border-bottom: 1px solid #333;"><strong>Receiver's Signature</strong> :</div>
				
				<div style=" padding: 10px; text-align: right;">
					<p style="margin-bottom: 30px;"><strong>For EMR MARKETING LLP</strong></p>
					<p style="margin: 0; padding: 0;"><strong>Authorised Signatory</strong></p>
				</div>
				
				
				</div>
			  
			  <div style="clear: both"></div>
		  </div>
		  
      </div>
    </section>
    <div class="copyright">
      
    </div>
  </body>
</html>
