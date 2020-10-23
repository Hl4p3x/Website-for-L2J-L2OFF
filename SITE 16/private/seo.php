<?php

# Titles & descriptions

switch ($p) {
	
	case "404":
		$SEO['title'] = "404 | ".$server_name;
		$SEO['description'] = "The page you are trying to access is unavailable or doesn't exist!";
	break;
		
	case "boss":
		$SEO['title'] = "Boss Status | ".$server_name;
		$SEO['description'] = "Check out the bosses that are dead or alive. Show your strength and defeat as you can!";
	break;
		
	case "changepass":
		$SEO['title'] = $LANG[12022]." | ".$server_name;
		$SEO['description'] = "Login is required! Enter login and current password of the your account you want to change the password.";
	break;
		
	case "donations":
		$SEO['title'] = $LANG[12039]." | ".$server_name;
		$SEO['description'] = "Collaborate with the server and earn rewards! By donating you are helping to keep the server online, with quality and always updated.";
	break;
		
	case "download":
		$SEO['title'] = "Downloads | ".$server_name;
		$SEO['description'] = "You don't have the necessary files to play? Download and install the Lineage 2 client, apply our patch and enjoy!";
	break;
		
	case "forgot":
		$SEO['title'] = $LANG[12040]." | ".$server_name;
		$SEO['description'] = "Forgot your password? Type the e-mail you used to register the account. Send you instructions on how to recover.";
	break;
		
	case "forgot_confirm":
		$SEO['title'] = $LANG[12040]." | ".$server_name;
	break;
		
	case "gallery":
		$SEO['title'] = $LANG[12026]." | ".$server_name;
		$SEO['description'] = "Check out the images and videos available in our gallery!";
	break;
		
	case "info":
		$SEO['title'] = $LANG[12996]." | ".$server_name;
		$SEO['description'] = "Check out the information and important details about our server!";
	break;
		
	case "news":
		$SEO['title'] = $LANG[13001]." | ".$server_name;
		$SEO['description'] = "Check out the latest updates, announcements and everything that's new on our server!";
	break;
		
	case "oly_allheroes":
		$SEO['title'] = "Grand Olympiad | ".$LANG[12025]." | ".$server_name;
		$SEO['description'] = "All players who are or already been heroes.";
	break;
		
	case "oly_heroes":
		$SEO['title'] = "Grand Olympiad | ".$LANG[12999]." | ".$server_name;
		$SEO['description'] = "All players who are or already been heroes.";
	break;
		
	case "oly_rank":
		$SEO['title'] = "Grand Olympiad | Ranking | ".$server_name;
		$SEO['description'] = "All players who are or already been heroes.";
	break;
		
	case "register":
		$SEO['title'] = $LANG[12032]." | ".$server_name;
		$SEO['description'] = "Register now on our server and enjoy the best that we can offer you!";
	break;
		
	case "rules":
		$SEO['title'] = $LANG[12108]." | ".$server_name;
		$SEO['description'] = "Check and follow the rules so that it is not punished.";
	break;
		
	case "siege":
		$SEO['title'] = "Castle & Siege | ".$server_name;
		$SEO['description'] = "Check out upcoming sieges and important information about the dominance of the castles!";
	break;
		
	case "support":
		$SEO['title'] = $LANG[13005]." | ".$server_name;
		$SEO['description'] = "You need to get in contact with our team? Check the means available!";
	break;
		
	case "topclan":
		$SEO['title'] = "Top Clan | ".$server_name;
		$SEO['description'] = "The ranking of most prestigious clans in the server!";
	break;
		
	case "toponline":
		$SEO['title'] = "Top Online | ".$server_name;
		$SEO['description'] = "The ranking of players with more time online!";
	break;
		
	case "toppk":
		$SEO['title'] = "Top Pk | ".$server_name;
		$SEO['description'] = "The ranking of players with more Pk Points!";
	break;
		
	case "toppvp":
		$SEO['title'] = "Top PvP | ".$server_name;
		$SEO['description'] = "The ranking of players with more PvP Points";
	break;
		
	case "ucp_changepass":
		$SEO['title'] = $LANG[12022]." | ".$server_name;
	break;
		
	case "ucp_unstuck":
		$SEO['title'] = "Unstuck | ".$server_name;
	break;
		
	default:
		$SEO['title'] = $server_name." - ".$server_chronicle;
		$SEO['description'] = $server_name.", the best server of Lineage 2 ".$server_chronicle.". Join us for free and play!";
	break;
	
}