			 <?php
			    Yii::app()->clientScript->registerScriptFile('http://api.map.baidu.com/api?v=1.3');
			 ?>
			 <div class="sch_new_guide" style="margin-bottom:5px;">
              <div id="map_container" style="width:950px; height:410px"></div>
		  	</div>
<script type="text/javascript">
	jQuery(function(){
		GShowMap();
	});
 function GShowMap() {
	  var lng="<?= $lng ?>";
	  var lat="<?= $lat ?>";
	  var address="<?= $address ?>";
	  var region_name="<?= $region_name ?>";
	  
	  if(lng&&lat){
			var map = new BMap.Map("map_container");
			map.enableScrollWheelZoom();
			var opts = {type: BMAP_NAVIGATION_CONTROL_SMALL}  
			map.addControl(new BMap.NavigationControl(opts)); 
			var point = new BMap.Point(lng, lat);
			map.centerAndZoom(point, 12);
			var marker = new BMap.Marker(point); 
			map.addOverlay(marker); 
		}else{
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
 		 }else{
 			  myGeo.getPoint(region_name, function(point){ 
 			  	map.centerAndZoom(point, 12);
   				marker=new BMap.Marker(point); 
   				map.addOverlay(marker); 
 			  },region_name);  
 		 }  
		},region_name);  
	}
}

</script>