<script src="dist/js/html5-qrcode.js"></script>
<script src="dist/js/html5-qrcode-scanner.js"></script>
<script src="dist/js/sweetalert.min.js"></script>
<div class="col-md-12" align="center">
	<div id="qr-reader" style="width:calc(60%)"></div>
    <div id="qr-reader-results"></div>
</div>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(qrCodeMessage) {
            if (qrCodeMessage !== lastResult) {
                ++countResults;
                lastResult = qrCodeMessage;
                // resultContainer.innerHTML
                    // += `<div>[${countResults}] - ${qrCodeMessage}</div>`;
                $.ajax({
                	url:'classes/Main.php?f=track',
                	method:'POST',
                	data:{pcode:qrCodeMessage,ecode:'<?php echo $_settings->userdata('code') ?>'},
                	error:err=>{
                		console.log(err)
                		alert_toast('An Error Occured.');
                	},
                	success:function(resp){
                		if(resp == 1){
                			 swal({
							    title: 'Welcome',
							    text: 'Enjoy your visit...',
							    icon: 'success',
							    timer: 2000,
							    buttons: false,
							})
                		}else if(resp ==3){
                			swal({
							    title: 'Code is not Valid',
							    text: 'Scan a register QR Code',
							    icon: 'error',
							    timer: 2000,
							    buttons: false,
							})
                		}else{
                		alert_toast('An Error Occured.');

                		}

                	}
                })
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
   

</script>