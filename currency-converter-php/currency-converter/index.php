<?php require('templatefile/header.php');
  // Initialize the session
  session_start();
   
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }
?>
<title>Currency Convertor</title>
<!--custom javascript-->
<script src="script.js"></script>
<style>
.classWithPad { 
  margin:2px; padding:4px; 
}
#converted_amount_id{
  color:green;
}
input{
  height: 12px;
}
</style>
<?php require('templatefile/container.php');?>
<div class="content">
  <div class="container-fluid">
    <h2>Currency Converter</h2>   
    <br><br>  
    <div class="row">
      <form class="form-inline" >
        <div class="form-group classWithPad">
          <label for="Name2">От валута: &nbsp;&nbsp;</label>
          <select class="form-control" id="from_currency_id" required name="from_currency" style="width:170px;">
            <?php include('db-connection.php');?>
            <?php  
              $sql_query = "SELECT currency_id,currency_name FROM currency_list";
             
              if ($result=mysqli_query($con,$sql_query))
              {
                 
                while ($currency_list = mysqli_fetch_assoc($result))
                { 
            ?>
              <option value="<?php echo $currency_list['currency_id'];?>" <?php if($currency_list['currency_id'] == "USD"){echo 'selected';}?> ><?php echo $currency_list['currency_name']; ?></option>
            <?php    } } ?>
          </select>
        </div>

        <div class="form-group classWithPad">
          <label for="Email2">Стойност: &nbsp;&nbsp;</label>
          <input style="width:90px;" type="text" class="form-control" name="amount" id="amount_id" required>
        </div>

        <div class="form-group classWithPad">
          <label for="Email2">Във валута: &nbsp;&nbsp;</label>
          <select class="form-control" id="to_currency_id" name="to_currency" required style="width:170px;">
           <?php  
              $sql_query  = "SELECT currency_id,currency_name FROM currency_list";
              if ($result = mysqli_query($con,$sql_query))
              {
                 
                while ($currency_list = mysqli_fetch_assoc($result))
                { 
            ?>
              <option value="<?php echo $currency_list['currency_id'];?>" <?php if($currency_list['currency_id'] == "INR"){echo 'selected';}?>><?php echo $currency_list['currency_name']; ?></option>
            <?php    } } ?>
          </select>
        </div>

         <div class="form-group classWithPad">
          <label for="Email2">Конвертирана стойност: &nbsp;</label>
          <input style="width:90px;" type="text" class="form-control" id="converted_amount_id" readonly="">
        </div>

        <div class="form-group classWithPad">
          <button type="button"  onclick="convertCurrency();" class="btn btn-danger">Конвертирай</button>
        </div>
      </form>
    </div>
  </div>  
</div>  
<?php require('templatefile/footer.php');?>