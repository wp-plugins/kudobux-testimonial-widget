<script type="text/javascript">
	
	if(window.location.href.indexOf("#test-bu") == -1) {
       window.location.href=window.location.href+"#test-bu";
    }
    
	var $buoop = {} 
	$buoop.ol = window.onload; 
	window.onload=function(){ 
	 if ($buoop.ol) $buoop.ol(); 
	 var e = document.createElement("script"); 
	 e.setAttribute("type", "text/javascript"); 
	 e.setAttribute("src", "http://browser-update.org/update.js"); 
	 document.body.appendChild(e); 
	} 
</script>