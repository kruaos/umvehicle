<div class="container" style="margin-top:30px" >
  <div class="row">
    <div class="col-xs-1"></div>
    <div class="col-sm-12 col-md-12 col-xs-12" style="font-family: 'Sarabun', sans-serif; font-Size:12pt">

  <?php
$showinc=0;$de1=0;$showout=0;$wi1=0;$totalshow=0;$wi3=0;
        $cusid=$this->uri->segment(3);
        $sql41 = "select * from tb_customer where cusid=$cusid"; // ดึงข้อมูลจากตาราง product
        foreach ($this->db->query($sql41)->result() as $row41) {
          $cusfullname1 = $row41->fullname;
        }

       

        ?>
    <h4  class='text-center'>รายการเบิกพัสดุ ของ <?php echo $cusfullname1;?></h4>
    <table width='100%' class="table table-hover table-sm table-bordered" boder='1'>
    
    <tr class='text-center '>
          <th width='10%'class='text-center 'rowspan="2">วันที่ </th>
          <th width='20%'rowspan="2">รายการ</th>
          <th width='20%'rowspan="2">รายการ</th>
          <th width='40%'colspan="4">จ่าย</th>
          <th width='10%'colspan="2">รวม</th>

    </tr>
    <tr class='text-center '>          
          <th width='5%' ><p class="small">ใบสั่งที่</th>
          <th width='5%' ><p class="small">จำนวน</th>
          <th width='7%' ><p class="small">ราคาต่อหน่วย<p></th>
          <th width='5%' ><p class="small">เงิน</th>
          <th width='5%'><p class="small">เงิน</th>


        </tr>

    <?php
        $amushow=0;

         $sql = "select * from tb_orderfile where statusOrder='ou'and statusfile=0 and cusid=$cusid order by createdate ASC;"; // ดึงข้อมูลจากตาราง product
        foreach ($this->db->query($sql)->result() as $row) {

    ?>
    <tr>
      <td class='text-center'><?php       
      $showmont=array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
      $showdate=number_format(substr($row->createdate,8,2))." ".$showmont[number_format(substr($row->createdate,5,2))-1]." ".(substr($row->createdate,2,2)+43);
      echo $showdate;
      ?></td>
      <td><?php 
            $productID=$row->productID;
            $sql1 = "select * from tb_product where id=$productID"; // ดึงข้อมูลจากตาราง product
        foreach ($this->db->query($sql1)->result() as $row1) {

              $productName = $row1->productName;
              $productprice= $row1->price;
            }
            $cusid=$row->cusid;
            $sql4 = "select * from tb_customer where cusid=$cusid"; // ดึงข้อมูลจากตาราง product
        foreach ($this->db->query($sql4)->result() as $row4) {
 
              $cusfullname = $row4->fullname;
            }
            $sellerID=$row->sellerID;
            $sql5 = "select * from tb_seller where sellerID=$sellerID"; // ดึงข้อมูลจากตาราง product
        foreach ($this->db->query($sql5)->result() as $row5) {

              $sellerName = $row5->sellerName;
            }
            $categoryID=$row->categoryID;
            $sql6 = "select * from tb_category where categoryID=$categoryID"; // ดึงข้อมูลจากตาราง product
        foreach ($this->db->query($sql6)->result() as $row6) {

              $categoryName = $row6->categoryName;
            }
            
            echo $productName;
 ?></td>
  <td><?php echo $categoryName;?>    </td>
<?php 
          $amountcheck=$row->statusOrder;
          $wi1=abs($row->amount); 
          $wi3=$wi1*$productprice;
        ?>
      <td style="text-align:right;" >
      
      </td>
      <td style="text-align:right;" ><?php echo  $wi1; ?></td>
      <td style="text-align:right;" ><?php echo  $productprice; ?></td>
      <td style="text-align:right;" ><?php echo  $wi3; ?></td>
      <td style="text-align:right;" ><?php echo   $totalshow=$totalshow+$wi3; ?></td>

    </tr> 
    <?php 
        $showinc=$showinc+$de1;
        $showout=$showout+$wi1;
      ?>
<?php    } ?>
      <tr class="table-active">
      <td></td>
      <td style="text-align:right;" ></td>
      <td style="text-align:right;" ></td>
      <td style="text-align:right;" ></td>
      <td style="text-align:right;" ></td>
      <td style="text-align:right;" ></td>
      <td style="text-align:right;" >รวม</td>
      <td style="text-align:right;" ><?php echo  number_format($totalshow); ?></td>
      </tr>
        </table>

        <div class="row">
      <a href="<?php echo site_url('report/ReportCustomer'); ?>" id="non-printable" class="btn btn-danger   btn-sm col">ย้อนกลับ</a>
      <button id="non-printable" name="print" type="submit" id="print" value="Print" onClick="window.print()" class="btn btn-info   btn-sm col">พิมพ์</button>
</div>

    </div>
    <div class="col-sx-1"></div>
  </div>
  
</div>
</html>
