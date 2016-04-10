$(function(){
	$("#bar-code-scan").load("bar-code-scan.html");
	 $("#scan-btn").click(function(){
		   alert("izi");
			cordova.plugins.barcodeScanner.scan(
		  function (result) {
		    if(!result.cancelled)
		    {
		      alert("Barcode type is: " + result.format);
		      alert("Decoded text is: " + result.text);
		    }
		    else
		    {
		      alert("You have cancelled scan");
		    }
		  },
		  function (error) {
		      alert("Scanning failed: " + error);
		  }
		);   
	});
});
