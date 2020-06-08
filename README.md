# Interactive Park Planner
Interactive Park Planner is a TYPO3 extension with whom you can place markers with its description on an image.

This extension uses leaflet library for frontend image and markers rendering and imgNotes and summernote libraries for backend marker placement. Marker images can be customiseable from backend and icons inside also can be placed with icon font. Zoom level of the image and popup content of the marker also can be added from the TYPO3 backend.
# How to make it work?
1. Install this extension via composer  
 `composer require onm/int-park`  
 if you have non-composer installation then just install it.
2. Include typoscript in template
3. Under any folder, create a db record 'Park', add image in it.
4. Using a backend module, you can place markers on the image.
5. place Park Planner element on the page.

That's it.

Note: `jQuery is needed in the project`
# Support
- TYPO3 8 till 10 LTS
- PHP 7.x

If you find any issue please report at https://github.com/opennewmedia/int_park/issues

# Features only in pro version
- Marker images can be customizeable.
- Font icon can be set for each marker indvidually, along with color and distance.
- Tooltip can be shown on markers without click on them.
- Background color of map can be configured.

## For pro version contact

Open New Media GmbH Agentur für digitale Kommunikation

Simrockstraße 5 56075 Koblenz

Tel.: +49 261 30380-80 Fax: +49 261 30380-88

E-Mail: info@onm.de

Web: https://www.onm.de