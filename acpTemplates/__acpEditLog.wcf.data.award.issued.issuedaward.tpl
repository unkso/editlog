<dl>
    <dt></dt>
    <dd><strong>The following award has been {if $type == 'create'}issued{elseif $type == 'delete'}deleted{else}edited{/if}:</strong></dd>
</dl>

<dl>
    <dt></dt>
    <dd>{$changes[title]}</dd>
</dl>

{if $type != 'create'}
<dl>
    <dt>Description</dt>
    <dd>
        {if $type == 'delete'}
            {$changes[description]}
        {/if}
    </dd>
</dl>

<dl>
    <dt>Date</dt>
    <dd>
        {if $type == 'delete'}
            {$changes[date]}
        {/if}
    </dd>
</dl>
{/if}