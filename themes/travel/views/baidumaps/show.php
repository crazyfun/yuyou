<div id="map_container" style="width:800px; height:430px"></div>
<script type="text/javascript">
 function GShowMap() {
	  var lng="<?= $lng ?>";
	  var lat="<?= $lat ?>";
	  var is_edit="<?= $is_edit ?>";
		var map = new BMap.Map("map_container");
		map.enableScrollWheelZoom();
		var opts = {type: BMAP_NAVIGATION_CONTROL_SMALL}  
		map.addControl(new BMap.NavigationControl(opts)); 
		var point = new BMap.Point(lng, lat);
		map.centerAndZoom(point, 12);
		var marker = new BMap.Marker(point); 
		map.addOverlay(marker); 
	
		if(is_edit=="true"){
			marker.enableDragging();
			marker.addEventListener("dragend",function(e){
				setaddress(e.point.lng,e.point.lat);
			});	
			map.addEventListener("click",function(e){
				var point = new BMap.Point(e.point.lng,e.point.lat);
				marker.setPosition(point); 
				setaddress(e.point.lng,e.point.lat);
			});
		}
		
}
function setaddress(lng,lat){
		var coordinate=String(lng)+","+String(lat);
		self.parent.document.getElementById("coordinate").value=coordinate;
  
}


</script>

            