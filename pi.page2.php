<?php

$plugin_info = array(
  'pi_name' => 'Page2',
  'pi_version' =>'1.0.0',
  'pi_author' =>'Mark Croxton',
  'pi_author_url' => 'http://www.hallmark-design.co.uk/',
  'pi_description' => 'Get an entry id from a page / structure uri, or vice-versa',
  'pi_usage' => Page2::usage()
  );

class Page2 {
	
	public $return_data = '';
	protected $site_id;
	protected $site_pages;	
	
	/** 
	 * Constructor
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() 
	{
		$this->EE =& get_instance();
		$this->site_id = $this->_get_site_id();
		
		// get the site page array
		$this->site_pages = $this->EE->config->item('site_pages');
		$this->site_pages = $this->site_pages[$this->site_id];
	}
	
	/** 
	 * Tag: {exp:page2:id uri="/{segment_1}/{segment_2}/"}
	 *
	 * @access public
	 * @return integer
	 */
	public function id() 
	{
		// the variable we want to find
		$uri = $this->EE->TMPL->fetch_param('uri', NULL);
		
		if ( ! is_null($uri))
		{
			// make sure we have leading and trailing slashes
			$uri = '/' . trim($uri, '/') . '/';
			
			// lookup the entry id
			if ($entry_id = array_search($uri, $this->site_pages['uris']))
			{
				return $entry_id;
			}
		}
	}
	

	/** 
	 * Tag: {exp:page2:uri entry_id="143"}
	 *
	 * @access public
	 * @return string
	 */
	public function uri() 
	{
		// the variable we want to find
		$entry_id = $this->EE->TMPL->fetch_param('entry_id', NULL);
		
		if ( ! is_null($entry_id))
		{
			// lookup the uri
			if ( isset($this->site_pages['uris'][$entry_id]) )
			{
				return $this->site_pages['uris'][$entry_id];
			}
		}
	}	
	
	private function _get_site_id()
	{
		$site_id = is_numeric($this->EE->config->item('site_id')) ? $this->EE->config->item('site_id') : 1;
		return $site_id;
	}	

	// usage instructions
	public function usage() 
	{
  		ob_start();
?>
-------------------
HOW TO USE
-------------------

	{exp:page2:id uri="/{segment_1}/{segment_2}/"}
	{exp:page2:uri entry_id="/{segment_1}/{segment_2}/"}

	<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}	
}