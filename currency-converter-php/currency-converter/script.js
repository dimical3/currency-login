function convertCurrency()
{
  var from_currency =   $('#from_currency_id').val(); 
  var to_currency   =   $('#to_currency_id').val();     
  var amount        =   $('#amount_id').val();
  $.post("currency-converter.php",
    {
      from_currency: from_currency,
      to_currency: to_currency,
      amount:amount
    },
    function(data, status)
    {
     
      if(status == 'success')
      { 
        var data = JSON.parse(data);
        console.log(data.error);
        if(data.error == 0 && data.message == 'ok')
        {
          var converted_amount = data.converted_result.replace(/^"(.*)"$/, '$1');  
          $('#converted_amount_id').val(converted_amount);
        }
        else
        {
          alert(data.message);
          return;
        }
      }
      else
      {
        alert('Please try again!');
      }
    }
  ); 
}