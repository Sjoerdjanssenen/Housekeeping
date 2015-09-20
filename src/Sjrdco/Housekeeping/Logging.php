<?php
namespace Sjrdco\Housekeeping;

class Logging
{
	/**
     * Logs an action to a .log file
     *
     * @param string $action
     * => The action that was executed and needs to be logged
     *
     * @param string $entity
     * => The model on which the action was executed (i.e. user, test, report)
     *
     * @return nil
     */
	public function logAction($message, $entity) {
		$fileName = '../app/logs/'.date("Y-m-d").'/'.$entity.'-'.date("Y-m-d").'.log';
		
		$file;

		if (!file_exists($fileName)) {
			if (!file_exists('../app/logs/'.date("Y-m-d"))) {
				mkdir('../app/logs/'.date("Y-m-d"), 0777, true);
			}
			
			$file = fopen($fileName, "w+");
		}	
		
		fwrite($file, $message.' - '.date("G:i:s")." on ".date("Y-m-d"));
	}
}