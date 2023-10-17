<tbody {{ $attributes->merge([ 'class' => 'divide-y divide-zinc-200' ]) }}>
    {{ $slot }}

    @if(isset($tfootSlot))
        <tfoot>
            {{ $tfootSlot }}
        </tfoot>
    @endif
</tbody>
