<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';

$remote_uri = 'https://services3.arcgis.com/vgpNvkwrqKit2cbA/arcgis/rest/services/NationalPlanningApplications_Points' . 
              '/FeatureServer/0/query?f=json&where=((PlanningAuthority%20%3D%20%27Cork%20City%20Council%27)' .
              '%20AND%20(ReceivedDate%20BETWEEN%20CURRENT_TIMESTAMP%20-%2030%20AND%20CURRENT_TIMESTAMP))%20AND%20(1%3D1)' .
              '&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=OBJECTID%20ASC&' .
              'outSR=4326&resultOffset=0&resultRecordCount=500';

$applications = json_decode(scraperwiki::scrape($remote_uri));

foreach ($applications->features as $application) {
  echo $application->attributes->PlanningAuthority . ": " . $application->attributes->ApplicationNumber ."\n";
}
#print_r($applications);

//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
