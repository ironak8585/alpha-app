<div class="section">
    <table class="is-meta" style="width: auto;">
        <tbody>
            <tr>
                @foreach ($fields as $label => $value)
                <td style="padding-right: 1em;">
                    <span class="has-text-grey is-label is-condensed">
                        {{ $label }}
                    </span>
                    <h4 class="is-bold">{{ $value }}</h4>
                </td>    
                @endforeach                
            </tr>
        </tbody>
    </table>
</div>
<div class="divider"></div>