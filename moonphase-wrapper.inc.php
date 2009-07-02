<?php
require( 'moonphase.inc.php' );
 function do_phase ( $epoch )  {
	$moondata = phase($epoch);

	$MoonPhase	= $moondata[0];
	$MoonIllum	= $moondata[1];
	$MoonAge	= $moondata[2];
	$MoonDist	= $moondata[3];
	$MoonAng	= $moondata[4];
	$SunDist	= $moondata[5];
	$SunAng		= $moondata[6];

	$strWax = 'Waxing';
	$strWan = 'Waning';
	$strFull = 'Full';
	$strNew = 'New';
	$phase = '+'; // Waxing
	if ( $MoonAge > SYNMONTH/2 )  {
		$phase = '-'; // Waning
	}

	// Convert $MoonIllum to percent and round to whole percent.
	$MoonIllum = round( $MoonIllum, 2 );
	$MoonIllum *= 100;
	if ( $MoonIllum == 0 )  {
		$phase = "New";
	} else if ( $MoonIllum == 100 )  {
		$phase = "Full";
	} else if($MoonIllum == 50) {
		$phase = sprintf("%s Quarter", ($phase == '+') ? 'First' : 'Last');
	} else if($MoonIllum < 50) {
		$phase = sprintf('%s Crescent', ($phase == '+') ? $strWax : $strWan);
	} else if($MoonIllum > 50) {
		$phase = sprintf('%s Gibbous', ($phase == '+') ? $strWax : $strWan);
	}

	#print "Moon Phase: $phase\n";
	#print "Percent Illuminated: $MoonIllum%\n";
	return sprintf('The Moon is %s (%2d%% of Full)', $phase, $MoonIllum);
 }

 ?>
