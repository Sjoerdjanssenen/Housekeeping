<?php
namespace Sjrdco\Housekeeping;

class Deployment
{
	/**
     * Autodeploys after Git calls this 
     *
     */
	public function autoDeploy()
	{
		if (isset($_GET['token']) && ($_GET['token'] == 'fhzwl8vWHJDbp9XfdSdBgfa940J4PRBz8zm79EgL9HESHp4BhbfOIzrQj12N')) {
			// The commands
			$commands = array(
				'git branch',
				'git pull origin master',
				'gulp deploy',
				'php ../composer.phar install'
			);
		
			// Run the commands for output
			$output = '';
			foreach($commands AS $command){
				// Run it
				$tmp = shell_exec($command);
				// Output
				$output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
				$output .= htmlentities(trim($tmp)) . "\n\n";
			}
			
			echo '<!DOCTYPE HTML>
			<html lang="en-US">
			<head>
				<meta charset="UTF-8">
				<title>GIT DEPLOYMENT SCRIPT</title>
			</head>
			<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
			<pre>
			 .  ____  .    ____________________________
			 |/      \|   |                            |
			[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git Deployment Script v0.1 |
			 |___==___|  /       @sjoerdjanssenen 2015 |
			              |____________________________|
			
			'.$output.'
			</pre>
			</body>
			</html>';	
		} else {
			echo '<!DOCTYPE HTML>
					<html lang="en-US">
						<head>
							<meta charset="UTF-8">
							<title>GIT DEPLOYMENT SCRIPT</title>
						</head>
						<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
							<pre>
							 .  ____  .    ____________________________
							 |/      \|   |                            |
							[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git Deployment Script v0.1 |
							 |___==___|  /       @sjoerdjanssenen 2015 |
							              |____________________________|
							
							<p>Invalid token</p>
							</pre>
						</body>
					</html>';
		}
	}
}