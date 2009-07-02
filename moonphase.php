<?php

 //
 // File: moonphase.php
 //     Sample code for using moonphase.inc.php
 //	http://www.sentry.net/~obsid/moonphase
 //

 require( 'moonphase.inc.php' );

// // phasehunt() Example
// print "Example: phasehunt()\n";
// do_phasehunt();
// print "\n\n";
//
//
// // phaselist() Example
// print "Example: phaselist()\n";
// $start = strtotime( "2008-10-01 00:00:00 PST" );
// $stop = strtotime( "2008-10-31 00:00:00 PST" );
// do_phaselist( $start, $stop );
// print "\n\n";
//
//
// // phase() Example
// $date = "2008-10-31";
// $time = "00:00:00";
// $tzone = "PST";
// print "Example: phase() ($date $time $tzone)\n";
// do_phase( $date, $time, $tzone );
// print "\n\n";

// $date = "2008-10-31";
$time = "00:00:00";
$tzone = "PST";
// print "Example: phase() ($date $time $tzone)\n";
// do_phase( $date, $time, $tzone );
// print "\n\n";
$dates = array( '2009-06-01', '2009-06-02', '2009-06-03', '2009-06-04', '2009-06-05', '2009-06-06', '2009-06-07', '2009-06-08', '2009-06-09', '2009-06-10', '2009-06-11', '2009-06-12', '2009-06-13', '2009-06-14', '2009-06-15', '2009-06-16', '2009-06-17', '2009-06-18', '2009-06-19', '2009-06-20', '2009-06-21', '2009-06-22', '2009-06-23', '2009-06-24', '2009-06-25', '2009-06-26', '2009-06-27', '2009-06-28', '2009-06-29', '2009-06-30', '2009-07-01', '2009-07-02', '2009-07-03', '2009-07-04', '2009-07-05', '2009-07-06', '2009-07-07', '2009-07-08', '2009-07-09', '2009-07-10', '2009-07-11', '2009-07-12', '2009-07-13', '2009-07-14', '2009-07-15', '2009-07-16', '2009-07-17', '2009-07-18', '2009-07-19', '2009-07-20', '2009-07-21', '2009-07-22', '2009-07-23', '2009-07-24', '2009-07-25', '2009-07-26', '2009-07-27', '2009-07-28', '2009-07-29', '2009-07-30');
foreach($dates as $date) {
print "phase() ($date $time $tzone)";
do_phase( $date, $time, $tzone );
print "\n";
}


 // phasehunt() Example
 function do_phasehunt()  {
	$phases = array();
	$phases = phasehunt();
	print date("D M j G:i:s T Y", $phases[0]) . "\n";
	print date("D M j G:i:s T Y", $phases[1]) . "\n";
	print date("D M j G:i:s T Y", $phases[2]) . "\n";
	print date("D M j G:i:s T Y", $phases[3]) . "\n";
	print date("D M j G:i:s T Y", $phases[4]) . "\n";
 }



 // phaselist() Example
 function do_phaselist( $start, $stop )  {
	$name = array ( "New Moon", "First quarter", "Full moon", "Last quarter" );
	$times = phaselist( $start, $stop );

	foreach ( $times as $time )  {

		// First element is the starting phase (see $name).
		if ( $time == $times[0] )  {
			print $name["$times[0]"] . "\n";
		}
		else  {
			print date("D M j G:i:s T Y", $time) . "\n";
		}
	}
 }



 // phase() Example
 function do_phase ( $date, $time, $tzone )  {
	$moondata = phase(strtotime($date . ' ' . $time . ' ' . $tzone));

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
	return "The Moon is $phase ($MoonIllum% of Full)";
 }



?>
