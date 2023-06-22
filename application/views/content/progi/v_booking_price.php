



<script type="text/javascript">
    showPriceDetail("1");
    function showPriceDetail(id) {
        $.ajax({
            type:"POST",
            data:{"serviceID":id,"dari":"<?=$dari?>","kabAsal":"<?=$kabAsal?>","branchNameAsal":"<?=$branchNameAsal?>","kecNameAsal":"<?=$kecNameAsal?>","tujuan":"<?=$tujuan?>","kabTujuan":"<?=$kabTujuan?>","branchNameTujuan":"<?=$branchNameTujuan?>","kecNameTujuan":"<?=$kecNameTujuan?>"},
            url:"<?=base_url()?>booking/getpriceDetail",
            beforeSuccess:function() {
                $("#lytDetail").html("Loading...");
            },
            success:function(html) {
                $("#lytDetail").html(html);
            }
        })
    }
</script>