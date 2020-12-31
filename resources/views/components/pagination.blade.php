@php
    $parameters = "&";
    foreach($filters as $key => $value){
        if($key !== "page"){
            $parameters = $parameters . $key . "=" . $value . "&";
        }
    }
    $parameters = rtrim($parameters,"&");
@endphp
<div>
    {{ $records->links('vendor.pagination.custom', ['parameters' => $parameters]) }}    
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#rpp').change(function () {
            filter.search();
        });        
    });
</script>