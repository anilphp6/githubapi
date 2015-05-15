<?php
/**
 * class for manage exception handling
 */
class customException extends Exception {
  public function errorMessage() {
    #error message
    $errorMsg = 'You can not access on browser Or may you forget to pass credentails, can be run only command line by below mentioned details: </br>';
	$errorMsg .= 'username</br> password <br> repository_url <br> contributor';	
				
    return $errorMsg;
  }
  
}
class ClassFactory {

    private $_serviceInstance = null;
	public function StoreInstance($options = array()) {
		// Determine which class to instantiate based on repository url
        $serviceType = $this->_extractServiceType($options);

        if ($serviceType == 'github.com') {
            $this->_setGithubInstance($options);
        } else if ($serviceType == 'bitbucket.org') {
            $this->_setBitbucketInstance($options);
        } else {
            throw new \Exception(ErrorMessage::SERVICE_NOT_FOUND);
        }
    }

    /**
     * Get service instance
     * 
     * @return  object
     */
    public function service_instance() {
        return $this->_serviceInstance;
    }

    /**
     * Instantiate github class and set setvice instance
     * 
     * @return  void
     */
    protected function _setGithubInstance($options) {
        $this->_serviceInstance = new github_store($options);
    }

    /**
     * Instantiate bitbucket class and set setvice instance
     * @return  void
     */
    protected function _setBitbucketInstance($options) {
        $this->_serviceInstance = new bitb_store($options);
    }

    /**
     * Parse repository url and update $option
     * 
     * @return  string
     */
    private function _extractServiceType(& $options) {

        $hostName = '';
        $repositoryUrl = $options['url'];

        $temp = parse_url($repositoryUrl);

        $options = $options + $temp;

        if (isset($options['host']) && !empty($options['host'])) {
            $hostName = $options['host'];
        }
		//echo $hostName;exit;
        return $hostName;
    }

}