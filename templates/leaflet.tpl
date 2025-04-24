{include file='header'}

{include file='leafletElement' leafletElementID=$object->getObjectID() googleMapsLat=$object->getLat() googleMapsLng=$object->getLng()}

<script data-relocate="true">
	require(["xXSchrandXx/Core/Component/Leaflet/Marker"], function(M) {
		M.addMarkerById(
			"{$object->getObjectID()|encodeJS}",
			{$object->getLat()|encodeJS},
			{$object->getLng()|encodeJS},
			"{$object->getTitle()|encodeJS}"
		);
	});
</script>

{include file='footer'}
