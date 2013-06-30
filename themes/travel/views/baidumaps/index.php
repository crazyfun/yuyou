<div id="map_container" style="width:800px; height:430px"></div>
<script type="text/javascript">
 function GShowMap() {
	  var address="<?= $address ?>";
	  var region_name="<?= $region_name ?>";
		var map = new BMap.Map("map_container");
		map.enableScrollWheelZoom();
		var opts = {type: BMAP_NAVIGATION_CONTROL_SMALL}  
		map.addControl(new BMap.NavigationControl(opts)); 
		var marker="";
		var myGeo = new BMap.Geocoder();    
		myGeo.getPoint(address, function(point){  
 		 if (point) {  
   		map.centerAndZoom(point, 12);
   		marker=new BMap.Marker(point); 
   		map.addOverlay(marker); 
   		marker.enableDragging();
			marker.addEventListener("dragend",function(e){
				setaddress(e.point.lng,e.point.lat);
			});	
 		 }else{
 			  myGeo.getPoint(region_name, function(point){ 
 			  	map.centerAndZoom(point, 12);
   				marker=new BMap.Marker(point); 
   				map.addOverlay(marker); 
   				marker.enableDragging();
					marker.addEventListener("dragend",function(e){
							setaddress(e.point.lng,e.point.lat);
					});	
 			  },region_name);  
 		 }  
		},region_name);  
		map.addEventListener("click",function(e){
			  var point = new BMap.Point(e.point.lng,e.point.lat);
				marker.setPosition(point); 
				setaddress(e.point.lng,e.point.lat);
		});
		
}
function setaddress(lng,lat){
	
		var coordinate=String(lng)+","+String(lat);
		self.parent.document.getElementById("coordinate").value=coordinate;
  
}
 function baidu_maps(){
        	var address=document.getElementById("TravelRestaurant_restaurant_address").value;
        	set_bmap(address);
        	
  }

</script>

            