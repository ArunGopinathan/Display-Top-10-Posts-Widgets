<?php
/**
 * @package Top 10 Posts
 * @version 0.1
 */
/*
Plugin Name:Display Top 10 Posts Widget
Plugin URI: http://notavailable/
Description: This is a plugin that displays the Top 10 posts in  7 day(s) , 1 month(s) , and 1 year(s)
Author: Arun G
Version: 0.1
Author URI: http://aruncyberspace.blogspot.in/
*/
/*imports*/
require 'gapi.class.php';

class Display_Top10_Posts_Widget extends WP_Widget {
         public function __construct() {
               // widget actual processes
               /* Widget control settings. */
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Display_Top10_Posts_Widget', 'description' => 'Displays Top 10 Posts' );

		/* Widget control settings. */
		//$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'Display-Top-10-Posts-Widget' );

		/* Create the widget. */
		$this->WP_Widget( 'Display-Top-10-Posts-Widget', 'Display Top 10 Posts Widget', $widget_ops, $control_ops );
         	
              // parent::WP_Widget(false,'Display Top 10 Posts Widget','description=Description Widget');
        }

        public function form( $instance ) {
               // outputs the options form on admin
            //   echo 'include html coding in here';	
        
        //for Google Analytics Email	
        if ( isset( $instance[ 'google_analytics_email' ] ) ) 
        {
			$gaEmail = $instance[ 'google_analytics_email' ];
		}
		else 
		{
			$gaEmail ='';
		}
		 //for Google Analytics Email Password
        if ( isset( $instance[ 'google_analytics_email_password' ] ) ) 
        {
			$gaPassword = $instance[ 'google_analytics_email_password' ];
		}
		else 
		{
			$gaPassword ='';
		}
		
		//for Google Analytics Profile Id
		 if ( isset( $instance[ 'google_analytics_ProfileId' ] ) ) 
        {
			$gaProfileId = $instance[ 'google_analytics_ProfileId' ];
		}
		else 
		{
			$gaProfileId ='';
		}
		
        //for Google Analytics Max Results
		 if ( isset( $instance[ 'google_analytics_Max_Results' ] ) ) 
        {
			$gaMaxResults = $instance[ 'google_analytics_Max_Results' ];
		}
		else 
		{
			$gaMaxResults ='';
		}
		
        //for Google Analytics Time Duration
		 if ( isset( $instance[ 'google_analytics_Time_Duration' ] ) ) 
        {
			$gaTimeDuration = $instance[ 'google_analytics_Time_Duration' ];
		}
		else 
		{
			$gaTimeDuration ='';
		}
		
		$day_select="";
		$month_select="";
		$year_select="";
		
		switch ($gaTimeDuration) {
			
			case "7 DAY":
			$day_select=" Selected ";
			break;
			
			case "1 MONTH":
			$month_select=" Selected ";
			break;
			
			case "1 YEAR":
			$year_select=" Selected ";
			break;
		}
		
		
		 //for Google Analytics Email	
        echo '<p>';
		echo '<label for="'.$this->get_field_name( 'title' ) .'">' ._e( 'Google Analytics Email:' ).' </label> ';
		echo '<input id="'. $this->get_field_id( 'google_analytics_email' ).'" name="'. $this->get_field_name( 'google_analytics_email' ).'" type="text" value="'. esc_attr( $gaEmail ). '" />';
		echo '</p>';
		 //for Google Analytics Email Password
		echo '<p>';
		echo '<label for="'.$this->get_field_name( 'title' ) .'">' ._e( 'Google Analytics Password:' ).' </label> ';
		echo '<input id="'. $this->get_field_id( 'google_analytics_email_password' ).'" name="'. $this->get_field_name( 'google_analytics_email_password' ).'" type="password" value="'. esc_attr( $gaPassword ). '" />';
		echo '</p>';
		//for Google Analytics Profile Id
		echo '<p>';
		echo '<label for="'.$this->get_field_name( 'title' ) .'">' ._e( 'Google Analytics ProfileId:' ).' </label> ';
		echo '<input id="'. $this->get_field_id( 'google_analytics_ProfileId' ).'" name="'. $this->get_field_name( 'google_analytics_ProfileId' ).'" type="text" value="'. esc_attr( $gaProfileId ). '" />';
		echo '</p>';
		//for Google Analytics Max Results
		echo '<p>';
		echo '<label for="'.$this->get_field_name( 'title' ) .'">' ._e( 'Google Analytics Max Results:' ).' </label> ';
		echo '<input id="'. $this->get_field_id( 'google_analytics_Max_Results' ).'" name="'. $this->get_field_name( 'google_analytics_Max_Results' ).'" type="text" value="'. esc_attr( $gaMaxResults ). '" />';
		echo '</p>';
		
		//for Google Analytics Time Duration
		echo '<p>';
		echo '<label>'._e( 'Google Analytics Time Duration:' ).'</label>';
		echo '<select id="'. $this->get_field_id( 'google_analytics_Time_Duration' ).'" name="'. $this->get_field_name( 'google_analytics_Time_Duration' ).'">
		<option value="7 DAY" '.$day_select.'>7 Days</option>
		<option value="1 MONTH" '.$month_select.'>1 Month</option>
		<option value="1 YEAR" '.$year_select.'>1 Year</option>
		</select>';
		echo '</p>';
		
        }

        public function update( $new_instance, $old_instance ) {
               // processes widget options to be saved
        $instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['google_analytics_email'] = strip_tags( $new_instance['google_analytics_email'] );
		$instance['google_analytics_email_password'] = strip_tags( $new_instance['google_analytics_email_password'] );
		$instance['google_analytics_ProfileId'] = $new_instance['google_analytics_ProfileId'];
		$instance['google_analytics_Max_Results'] = $new_instance['google_analytics_Max_Results'];
		$instance['google_analytics_Time_Duration'] = $new_instance['google_analytics_Time_Duration'];

		return $instance;
        }

        public function widget( $args, $instance ) {
              
        extract($args);
        				
        //for Google Analytics Email
 		if ( isset( $instance[ 'google_analytics_email' ] ) ) 
        {
			$gaEmail = $instance[ 'google_analytics_email' ];
		}
		else 
		{
			$gaEmail ='';
		}
		 //for Google Analytics Email Password
        if ( isset( $instance[ 'google_analytics_email_password' ] ) ) 
        {
			$gaPassword = $instance[ 'google_analytics_email_password' ];
		}
		else 
		{
			$gaPassword ='';
		}
		
		//for Google Analytics Profile Id
		 if ( isset( $instance[ 'google_analytics_ProfileId' ] ) ) 
        {
			$gaProfileId = $instance[ 'google_analytics_ProfileId' ];
		}
		else 
		{
			$gaProfileId ='';
		}
		
        //for Google Analytics Max Results
		 if ( isset( $instance[ 'google_analytics_Max_Results' ] ) ) 
        {
			$gaMaxResults = $instance[ 'google_analytics_Max_Results' ];
		}
		else 
		{
			$gaMaxResults ='';
		}
        //for Google Analytics Time Duration
		 if ( isset( $instance[ 'google_analytics_Time_Duration' ] ) ) 
        {
			$gaTimeDuration = $instance[ 'google_analytics_Time_Duration' ];
		}
		else 
		{
			$gaTimeDuration ='';
		}
		echo $before_widget;
		echo $before_title.'Top 10 posts in '.$gaTimeDuration.'(s)'. $after_title;

		$filter=null;
		$startDate;
 
		 switch($gaTimeDuration)
 			{
 				//calculating start date based on duration setting 
 				case "7 DAY":
 					$startDate =Date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-7,date("Y")));
 					break;
 				case "1 MONTH":
 					$startDate =Date('Y-m-d', mktime(0, 0, 0, date("m")-1, date("d"),date("Y")));
 					break;
 				case "1 YEAR":
 					$startDate =Date('Y-m-d', mktime(0, 0, 0, date("m"), date("d"),date("Y")-1));	
 					break;
 				default: //defaulting to 1 month
 					$startDate =Date('Y-m-d', mktime(0, 0, 0, date("m")-1, date("d"),date("Y")));	
 					break;	
 			}
 
 	$endDate = Date('Y-m-d',time());
 	$startIndex=1;
    $count=0;
if(!empty ($gaEmail) && !empty($gaPassword))
{
try {
 $ga = new gapi($gaEmail, $gaPassword);	
 $ga->requestReportData($gaProfileId, array('hostname', 'pagePath','pageTitle'), array('visits'), array('-visits'), $filter, $startDate, $endDate, $startIndex, $maxResults);
 
foreach ($ga->getResults() as $result) {
	$count=$count+1;
		$getHostname = $result->getHostname();
		$getPagepath = $result->getPagepath();
		$getPageTitle = $result->getPagetitle();
		$postPagepath = 'http://'.$getHostname.$getPagepath;
		$getPostID = url_to_postid($postPagepath);
		if ($getPostID <= 0) {
			$output .= '<p>';
			$output .= '<a href='.$postPagepath.'>'.$getPageTitle.'</a>'."\n";
			$output .= '</p>';
		}
  }
	//If no data was returned we will reach here. So display no posts available
  if($count==0)
  {
  $output.="No Posts Available";
  }
}
//catch exception and display default error message
 catch(Exception $ex)
 {
 	
 	$output.='<p>Could not get Report Data.</p><p> Error Ocurred. Please verify the settings are right</p>';
 }
}
//we reach here when Google Analytics Email/ Password is not configurated. Display message to user
else
{
 $output.="Please configure Google Analytics in Settings Page!";
}
 echo $output;

echo $after_widget;
   
        }

}
//registering the Widget
function DisplayTop10PostsWidgetInit() {
    register_widget('Display_Top10_Posts_Widget');
}
//adding hook for registering the Widget
add_action('widgets_init', 'DisplayTop10PostsWidgetInit');


?>
