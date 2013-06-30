<?php
class ApiController extends Controller
{

  public function filters() {
		
	}

 public function actions(){
 	  $controller_path="application.controllers.api.";
		return array(
		  'clearflush'=>$controller_path."ClearflushAction",
		  'crop'=>$controller_path.'CropAction',
		  'searchuser'=>$controller_path.'SearchuserAction',
		  'vot'=>$controller_path.'VotAction',
		  'downloads'=>$controller_path.'DownloadsAction',
		  'gettravel'=>$controller_path.'GettravelAction',
		  'gethotels'=>$controller_path.'GethotelsAction',
		  'traveldate'=>$controller_path.'TraveldateAction',
		  'searchscenic'=>$controller_path.'SearchscenicAction',
		  'searchregion'=>$controller_path.'SearchregionAction',
		  'mixregion'=>$controller_path.'MixregionAction',
		  'scheduler'=>$controller_path.'SchedulerAction',
		  'region'=>$controller_path.'RegionAction',
		  'linetype'=>$controller_path.'LinetypeAction',
		  'travelfavorite'=>$controller_path.'TravelfavoriteAction',
		  'hotelsfavorite'=>$controller_path.'HotelsfavoriteAction',
		  'groupfavorite'=>$controller_path.'GroupfavoriteAction',
		  'cellphone'=>$controller_path.'CellphoneAction',
		  'regionandscenic'=>$controller_path.'RegionandscenicAction',
		  'gethotelsbeds'=>$controller_path.'GethotelsbedsAction',
		);
	}
}
