<?php
class UserMenu extends CWidget
{
    public function run(){
    	
    	 $manage_user=ManageUser::get();
 
    	 $menus=$manage_user->get_user_menus();

       $this->render('user_menu',array('menus'=>$menus));
    }
  
}
