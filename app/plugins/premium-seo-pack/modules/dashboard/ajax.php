<?php
/*
* Define class pspDashboardAjax
* Make sure you skip down to the end of this file, as there are a few
* lines of code that are very important.
*/
!defined('ABSPATH') and exit;
if (class_exists('pspDashboardAjax') != true) {
    class pspDashboardAjax extends pspDashboard
    {
    	public $the_plugin = null;
		private $module_folder = null;
		
		/*
        * Required __construct() function that initalizes the AA-Team Framework
        */
        public function __construct( $the_plugin=array() )
        {
        	$this->the_plugin = $the_plugin;
			$this->module_folder = $this->the_plugin->cfg['paths']['plugin_dir_url'] . 'modules/dashboard/';
			
			// ajax  helper
			add_action('wp_ajax_pspDashboardRequest', array( &$this, 'ajax_request' ));
		}
		
		/*
		* ajax_request, method
		* --------------------
		*
		* this will create requests to 404 table
		*/
		public function ajax_request()
		{
			$return = array();
			
			$actions = isset($_REQUEST['sub_actions']) ? explode(",", $_REQUEST['sub_actions']) : '';
			//$website_url = 'http://mashable.com'; //!! temp
			$website_url = home_url();
			
			if( in_array( 'social_impact', $actions) ){
				
				$social_data = $this->getSocialsData( $website_url );
				  
				$html = array();
				$html[] = '<ul class="psp-lists-status">';
				
				$html[] = 	'<li style="color: #00102c">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/alexa-icon.png" class="psp-lists-icon">';
				$html[] = 		'<label>' . ( __("in the World", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = 		'<span>' . ( isset($social_data['alexa']) ?  $social_data['alexa'] . '<sup>th</sup>' : '&ndash;' ) . '</span>';
				$html[] = 	'</li>';
				
				$html[] = '<li style="color: #3c5b9b">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/facebook-icon.png" class="psp-lists-icon">';
				$html[] = 	'<span>' . ( isset($social_data['facebook']['share_count']) ? number_format($social_data['facebook']['share_count'], 0) : '&ndash;' ) . '</span>';
				$html[] = 	'<label>' . ( __("shares", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = '</li>';
				
				$html[] = '<li style="color: #3c5b9b">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/facebook-like-icon.png" class="psp-lists-icon">';
				$html[] = 	'<span>' . ( isset($social_data['facebook']['like_count']) ? number_format($social_data['facebook']['like_count'], 0) : '&ndash;' ) . '</span>';
				$html[] = 	'<label>' . ( __("likes", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = '</li>';
				
				$html[] = '<li style="color: #3c5b9b">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/facebook-comments-icon.png" class="psp-lists-icon">';
				$html[] = 	'<span>' . ( isset($social_data['facebook']['comment_count']) ? number_format($social_data['facebook']['comment_count'], 0) : '&ndash;' ) . '</span>';
				$html[] = 	'<label>' . ( __("comments", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = '</li>'; 
				
				$html[] = '<li style="color: #3c5b9b">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/facebook-icon.png" class="psp-lists-icon">';
				$html[] = 	'<span>' . ( isset($social_data['facebook']['click_count']) ? number_format($social_data['facebook']['click_count'], 0) : '&ndash;' ) . '</span>';
				$html[] = 	'<label>' . ( __("clicks", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = '</li>'; 
				
				$html[] = '<li style="color: #d23e2b">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/google-icon.png" class="psp-lists-icon">';
				$html[] = 	'<span>' . ( isset($social_data['google']) ? number_format($social_data['google'], 0) : '&ndash;' ) . '</span>';
				$html[] = 	'<label>' . ( __("shares", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = '</li>';
				
				$html[] = '<li style="color: #00aced">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/twitter-icon.png" class="psp-lists-icon">';
				$html[] = 	'<label>' . ( __("retweets", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = 	'<span>' . ( isset($social_data['twitter']) ? number_format($social_data['twitter'], 0) : '&ndash;' ) . '</span>';
				$html[] = '</li>'; 
				
				$html[] = '<li style="color: #007ab9">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/linkedin-icon.png" class="psp-lists-icon">';
				$html[] = 	'<label>' . ( __("backlinks", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = 	'<span>' . ( isset($social_data['linkedin']) ? number_format($social_data['linkedin'], 0) : '&ndash;' ) . '</span>';
				$html[] = '</li>'; 
				
				$html[] = '<li style="color: #ca4638">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/pinterest-icon.png" class="psp-lists-icon">';
				$html[] = 	'<label>' . ( __("pins", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = 	'<span>' . ( isset($social_data['pinterest']) ? number_format($social_data['pinterest'], 0) : '&ndash;' ) . '</span>';
				$html[] = '</li>'; 
				
				$html[] = '<li style="color: #3fbd46">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/stumbleupon-icon.png" class="psp-lists-icon">';
				$html[] = 	'<label>' . ( __("views", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = 	'<span>' . ( isset($social_data['stumbleupon']) ? number_format($social_data['stumbleupon'], 0) : '&ndash;' ) . '</span>';
				$html[] = '</li>'; 
				
				$html[] = '<li style="color: #2c2c2c">';
				$html[] = 	'<img src="' . ( $this->module_folder ) . 'assets/stats/delicious-icon.png" class="psp-lists-icon">';
				$html[] = 	'<label>' . ( __("posts", $this->the_plugin->localizationName) ) . '</label>';
				$html[] = 	'<span>' . ( isset($social_data['delicious']) ? number_format($social_data['delicious'], 0) : '&ndash;' ) . '</span>';
				$html[] = '</li>';
				
				$html[] = '</ul>';
				
				$html[] = '<span class="psp-cache-info">Generated on <strong>' . ( date("F j, Y, g:i a", $social_data['_cache_date']) ) . '</strong></span>';
				 
				$return['social_impact'] = array(
					'status' => 'valid',
					'html' => implode("\n", $html)
				);
			}
			
			if( in_array( 'charset', $actions) ){
				$html = array();
				$html[] = '<ul class="psp-lists-status">';
				
				$charset = get_bloginfo('charset');
				$html[] = 	'<li>';
				$html[] = 		'<label>' . ( __("Charset", $this->the_plugin->localizationName) ) . ':</label>';
				$html[] = 		'<span>' . ( isset($charset) ? $charset : '&ndash;' ) . '</span>';
				$html[] = 	'</li>'; 
				
				$html[] = '</ul>'; 
				 
				$return['charset'] = array(
					'status' => 'valid',
					'html' => implode("\n", $html)
				);
			}
			
			if( in_array( 'technologies', $actions) ){
				
				$html = array();
				$html[] = '<ul class="psp-lists-status">';
				
				$html[] = 	'<li>';
				$html[] = 		'<label>' . ( __("Server Software", $this->the_plugin->localizationName) ) . ':</label>';
				$html[] = 		'<span>' . ( isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '&ndash;' ) . '</span>';
				$html[] = 	'</li>'; 
				
				$html[] = 	'<li>';
				$html[] = 		'<label>' . ( __("Server Admin", $this->the_plugin->localizationName) ) . ':</label>';
				$html[] = 		'<span>' . ( isset($_SERVER['SERVER_ADMIN']) ? $_SERVER['SERVER_ADMIN'] : '&ndash;' ) . '</span>';
				$html[] = 	'</li>'; 
				
				$html[] = 	'<li>';
				$html[] = 		'<label>' . ( __("Server Signature", $this->the_plugin->localizationName) ) . ':</label>';
				$html[] = 		'<span>' . ( isset($_SERVER['SERVER_SIGNATURE']) ? $_SERVER['SERVER_SIGNATURE'] : '&ndash;' ) . '</span>';
				$html[] = 	'</li>';
				
				$html[] = '</ul>'; 
				 
				$return['technologies'] = array(
					'status' => 'valid',
					'html' => implode("\n", $html)
				);
			}
			
			if( in_array( 'server_ip', $actions) ){
				$server_ip_info = $this->getRemote( 'http://api.hostip.info/get_json.php?ip=' . $_SERVER["SERVER_ADDR"] );
				
				$html = array();
				$html[] = '<ul class="psp-lists-status">';
				
				$html[] = 	'<li>';
				$html[] = 		'<label>' . ( __("Server IP", $this->the_plugin->localizationName) ) . ':</label>';
				$html[] = 		'<span>' . ( isset($server_ip_info['ip']) ? $server_ip_info['ip'] : '&ndash;' ) . '</span>';
				$html[] = 	'</li>';
				
				$html[] = 	'<li>';
				$html[] = 		'<label>' . ( __("Country Name", $this->the_plugin->localizationName) ) . ':</label>';
				$html[] = 		'<span>' . ( isset($server_ip_info['country_name']) ? $server_ip_info['country_name'] : '&ndash;' ) . '</span>';
				$html[] = 	'</li>';
				
				$html[] = 	'<li>';
				$html[] = 		'<label>' . ( __("Country Code", $this->the_plugin->localizationName) ) . ':</label>';
				$html[] = 		'<span>' . ( isset($server_ip_info['country_code']) ? $server_ip_info['country_code'] : '&ndash;' ) . '</span>';
				$html[] = 	'</li>';
				
				$html[] = 	'<li>';
				$html[] = 		'<label>' . ( __("Country City", $this->the_plugin->localizationName) ) . ':</label>';
				$html[] = 		'<span>' . ( isset($server_ip_info['city']) ? $server_ip_info['city'] : '&ndash;' ) . '</span>';
				$html[] = 	'</li>';
				
				$html[] = '</ul>'; 
				 
				$return['server_ip'] = array(
					'status' => 'valid',
					'html' => implode("\n", $html)
				);
			}

			die(json_encode($return));
		}

		private function getSocialsData( $website_url='', $force_refresh_cache=false )
		{
			$cache_life_time = 60 * 10; // in seconds
			$the_db_cache = $this->the_plugin->get_theoption( "psp_dashboard_social_statistics" );
			
			// check if cache NOT expires 
			if( isset($the_db_cache['_cache_date']) && ( time() <= ( $the_db_cache['_cache_date'] + $cache_life_time ) ) && $force_refresh_cache == false ) {
				return $the_db_cache;
			}
			
			$db_cache = array();
			$db_cache['_cache_date'] = time();
			
			// Alexa rank
			$apiQuery = 'http://data.alexa.com/data?cli=10&dat=snbamz&url='. $website_url;
			$alexa_data = $this->getRemote( $apiQuery, false );
			$xml = simplexml_load_string($alexa_data);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE); 
			
			// Facebook
			$fql  = "SELECT url, normalized_url, share_count, like_count, comment_count, ";
			$fql .= "total_count, commentsbox_count, comments_fbid, click_count FROM ";
			$fql .= "link_stat WHERE url = '{$website_url}'";
			$apiQuery = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql);
			$fb_data = $this->getRemote( $apiQuery );
			$fb_data = $fb_data[0];
			
			// Twitter
			$apiQuery = "http://urls.api.twitter.com/1/urls/count.json?url=" . $website_url;
			$tw_data = $this->getRemote( $apiQuery );
			
			// LinkedIn
			$apiQuery = "http://www.linkedin.com/countserv/count/share?format=json&url=" . $website_url;
			$ln_data = $this->getRemote( $apiQuery );
			
			// Pinterest
			$apiQuery = "http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=" . $website_url;
			$pn_data = $this->getRemote( $apiQuery );
			
			// StumbledUpon
			$apiQuery = "http://www.stumbleupon.com/services/1.01/badge.getinfo?url=" . $website_url;
			$st_data = $this->getRemote( $apiQuery );
			
			// Delicious
			$apiQuery = "http://feeds.delicious.com/v2/json/urlinfo/data?url=" . $website_url;
			$de_data = $this->getRemote( $apiQuery ); 
			$de_data = $de_data[0];
			
			// Google Plus
			$apiQuery = "https://plusone.google.com/_/+1/fastbutton?bsv&size=tall&hl=it&url=" . $website_url;			
			$go_data = $this->getRemote( $apiQuery, false ); 
			
			require_once( $this->the_plugin->cfg['paths']['scripts_dir_path'] . '/php-query/php-query.php' );
			$html = pspphpQuery::newDocumentHTML( $go_data );
			$go_data = $html->find("#aggregateCount")->text();
				
			// store for feature cache
			$db_cache['alexa'] = $array['SD'][1]['POPULARITY']["@attributes"]['TEXT'];
			
			$db_cache['facebook'] = array(
				'share_count' => $fb_data['share_count'],
				'like_count' => $fb_data['like_count'],
				'comment_count' => $fb_data['comment_count'],
				'click_count' => $fb_data['click_count']
			);
			
			$db_cache['google'] = $go_data;
			$db_cache['twitter'] = $tw_data['count'];
			$db_cache['linkedin'] = $ln_data['count'];
			$db_cache['pinterest'] = $pn_data['count'];
			$db_cache['stumbleupon'] = $st_data['result']['views'];
			$db_cache['delicious'] = $de_data['total_posts'];
			
			// create a DB cache of this
			$this->the_plugin->save_theoption( 'psp_dashboard_social_statistics', $db_cache );
			
			return $db_cache; 
		}

		private function getRemote( $the_url, $parse_as_json=true )
		{ 
			$response = wp_remote_get( $the_url, array('user-agent' => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0", 'timeout' => 10) ); 
			// If there's error
            if ( is_wp_error( $response ) ){
            	return array(
					'status' => 'invalid'
				);
            }
        	$body = wp_remote_retrieve_body( $response );
			
			if( $parse_as_json == true ){
				// trick for pinterest
				if( preg_match('/receiveCount/i', $body)){
					$body = str_replace("receiveCount(", "", $body);
					$body = str_replace(")", "", $body);
				}
				
	        	return json_decode( $body, true );
			}
			
			return $body;
		}
    }
}