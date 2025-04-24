{include file='header'}

{include file='leafletElement' leafletElementID="leafletlist" accessUserLocation=true}
<script data-relocate="true">
	require(["xXSchrandXx/Core/Component/Leaflet/MarkerLoader"], function(ML) {
		ML.setup(document.getElementById("leafletlist"), "wcf\\data\\location\\LocationAction");
	});
</script>

{hascontent}
	<div class="section tabularBox">
		<table class="table" data-object-action-class-name="wcf\data\location\LocationAction">
			<thead>
				<tr>
					<th></th>
					<th class="columnID">
						{lang}wcf.global.objectID{/lang}
					</th>
					<th class="columnTitle">
						{lang}wcf.global.title{/lang}
					</th>
					<th class="columnFloat">
						lat
					</th>
					<th class="columnFloat">
						lng
					</th>

					{event name='columnHeads'}
				</tr>
			</thead>
			<tbody class="jsReloadPageWhenEmpty">
				{content}
					{foreach from=$objects item=object}
						<tr 
							data-object-id="{$object->getObjectID()}" 
						>
							<td class="columnIcon">
								<a href="{link controller='LeafletEdit' id=$object->getObjectID()}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip">
									{icon size=16 name='pencil' type='solid'}
								</a>
								{objectAction action="delete" objectTitle=$object->getTitle()}
							</td>
							<td class="columnID">{#$object->getObjectID()}</td>
							<td class="columnTitle">
								{$object->getTitle()}
							</td>
							<td class="columnFloat">{@$object->getLat()|floatval}</td>
							<td class="columnFloat">{@$object->getLng()|floatval}</td>
							{event name='columns'}
						</tr>
					{/foreach}
				{/content}
			</tbody>
		</table>
	</div>
{hascontentelse}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/hascontent}

{include file='footer'}
