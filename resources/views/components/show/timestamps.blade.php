<div>
    <div class="divider">Timestamps</div>
    <div class="columns">
        <div class="column is-6">
            <x-info 
                label="Created" 
                :value="$record->created_at->format('d-m-Y H:i:s')"
                icon="<i class='far fa-calendar-plus'></i>"
                classes="is-size-6 has-text-info"
                >
            </x-info>
        </div>
        <div class="column is-6">
            <x-info 
                label="Updated" 
                :value="$record->updated_at->format('d-m-Y H:i:s')"
                icon="<i class='far fa-calendar-check'></i>"
                classes="is-size-6 has-text-info"
                >
            </x-info>            
        </div>
    </div>
</div>