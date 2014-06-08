
	public static function getRequests($userId){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getRequests($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}