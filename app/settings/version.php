<?php

/*
 * Figure out what the current version is
 * Uses the current GitHub branch to identify
 * Relies on branch syntax of release/x.xx
*/

// describe our current tag
$tag = exec('git describe --abbrev=0 --exact-match --tags');

// get the commit hash (short version)
$commit = exec('git rev-parse --short HEAD');

// fatal response, meaning we're not on a tag (we've deviated, or 'Detached')
if( $tag ){
	$version = $tag;
	$versionCode = $tag;
}else{
	$version = 'dev';
	$versionCode = 'DEV-'.$commit;
}

echo json_encode(array( 'version' => $version, 'commit' => $commit, 'versionCode' => $versionCode ));
return;