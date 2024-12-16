
function do_phase($epoch) {
	//let $moondata = [0, .1234, 16, 0, 0, 0, 0]
	let $moondata = phase($epoch);

	// let $MoonPhase	= $moondata[0];
	let $MoonIllum = $moondata[1];
	let $MoonAge = $moondata[2];
	// let $MoonDist	= $moondata[3];
	// let $MoonAng	= $moondata[4];
	// let $SunDist	= $moondata[5];
	// let $SunAng		= $moondata[6];

	let $strWax = 'Waxing';
	let $strWan = 'Waning';
	let $strFull = 'Full';
	let $strNew = 'New';
	let $phase = '+'; // Waxing
	if ($MoonAge > SYNMONTH / 2) {
		$phase = '-'; // Waning
	}

	// Convert $MoonIllum to percent and round to whole percent.
	$MoonIllum = round($MoonIllum, 2);
	$MoonIllum *= 100;
	if ($MoonIllum == 0) {
		$phase = $strNew;
	} else if ($MoonIllum == 100) {
		$phase = $strFull;
	} else if ($MoonIllum == 50) {
		$phase = `${($phase == '+') ? 'First' : 'Last'} Quarter`;
	} else if ($MoonIllum < 50) {
		$phase = `${($phase == '+') ? $strWax : $strWan} Crescent`;
	} else if ($MoonIllum > 50) {
		$phase = `${($phase == '+') ? $strWax : $strWan} Gibbous`;
	}

	//print "Moon Phase: $phase\n";
	//print "Percent Illuminated: $MoonIllum%\n";
	return `The Moon is ${$phase} (${$MoonIllum.toFixed(0)}% of ${$strFull})`;
}
