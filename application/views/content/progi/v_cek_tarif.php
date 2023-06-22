<h1 class="mt-4">Cek Tarif</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="form-content">
                        <form method="POST" class="form-horizontal" id="formCekTarif">
                            <!-- <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Company</label>
                                <div class="col-lg-8 px-1">
                                    <select name="idCompany" id="idCompany" class="form-control select2"
                                    data-placeholder="Pilih Company" required onchange="showAsalTujuan(this.value)">
                                    <option value=""></option>
                                    <?php foreach ($company as $c) { ?>
                                    <option value="<?= $c->id; ?>"><?= $c->namaPerusahaan; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="baseUrl" id="baseUrl">
                                <input type="hidden" name="keyApi" id="keyApi">
                                </div>
                            </div>
                            <div id="lytAsalTujuan" hidden>
                                <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Origin</label>
                                <div class="col-lg-8 px-1">
                                    <input type="text" id="hint" name="asal" class="form-control ui-autocomplete-input"
                                        placeholder="Kota Asal">
                                    <input type="hidden" id="asal" name="dari" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Destination</label>
                                <div class="col-lg-8 px-1">
                                    <input type="text" id="hint2" name="ke" class="form-control ui-autocomplete-input"
                                        placeholder=" Kota Tujuan">
                                    <input type="hidden" id="tujuan" name="tujuan" class="form-control" />
                                </div>
                            </div>
                            </div> -->

                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Origin</label>
                                <div class="col-lg-8 px-1">
                                    <input type="text" id="hint" name="asal" class="form-control ui-autocomplete-input"
                                        placeholder="Kota Asal">
                                    <input type="hidden" id="asal" name="dari" class="form-control">
                                    <input type="hidden" id="kabAsal" name="kabAsal" class="form-control">
                                    <input type="hidden" id="branchNameAsal" name="branchNameAsal" class="form-control">
                                    <input type="hidden" id="kecNameAsal" name="kecNameAsal" class="form-control">
                                    <input type="hidden" id="kabupatenNameAsal" name="kabupatenNameAsal"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Destination</label>
                                <div class="col-lg-8 px-1">
                                    <input type="text" id="hint2" name="ke" class="form-control ui-autocomplete-input"
                                        placeholder=" Kota Tujuan">
                                    <input type="hidden" id="tujuan" name="tujuan" class="form-control" />
                                    <input type="hidden" id="kabTujuan" name="kabTujuan" class="form-control">
                                    <input type="hidden" id="branchNameTujuan" name="branchNameTujuan"
                                        class="form-control">
                                    <input type="hidden" id="kecNameTujuan" name="kecNameTujuan" class="form-control">
                                    <input type="hidden" id="kabupatenNameTujuan" name="kabupatenNameTujuan"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">&nbsp;</label>
                                <div class="col-lg-8 px-1">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Cek Tarif">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <div id="lytTarif"></div>
        </div>
    </div>

</div>


<script type="text/javascript">
//     function showAsalTujuan(id) {
//         if (id!='') {
//             $("#lytAsalTujuan").prop("hidden",false);
//             $("#hint").val("");
//             $("#asal").val("");
//             $("#hint2").val("");
//             $("#tujuan").val("");
//             $.ajax({
//                 type:"POST",
//                 dataType:"JSON",
//                 data:{"id":id},
//                 url:"<?=base_url()?>cektarifprogi/getComp",
//                 success:function(data) {
//                     showAsalTujuanAuto(data.baseUrl,data.keyApi);
//             $("#baseUrl").val(data.baseUrl);
//             $("#keyApi").val(data.keyApi);
//                 }
//             });
//         }else{
//             $("#lytAsalTujuan").prop("hidden",true);
//             $("#hint").val("");
//             $("#asal").val("");
//             $("#hint2").val("");
//             $("#tujuan").val("");
//             $("#baseUrl").val("");
//             $("#keyApi").val("");
//         }
//     }


//     function showAsalTujuanAuto(baseUrl,keyApi) {
// $(document).ready(function() {
//         $("#hint").autocomplete({
//         source:  function (request, response) {
//             $.ajax({
//                 url:"<?=base_url()?>cektarifprogi/search",
//                 dataType:"JSON",
//                 data:{
//                     term:request.term,
//                     baseUrl:baseUrl,
//                     keyApi:keyApi
//                 },
//                 success:function (data) {
//                     response(data);
//                 }
//             })
            
//         },
//         select: function(event, ui) {
//             event.preventDefault();
//             $("#hint").val(ui.item.label); // display the selected text
//             $("#asal").val(ui.item.value); // save selected id to hidden input
//         },
//         focus: function(event, ui) {
//             event.preventDefault();
//             $("#hint").val(ui.item.label);
//         },

//         minLength: 3
//     });


//     $("#hint2").autocomplete({
//         source:  function (request, response) {
//             $.ajax({
//                 url:"<?=base_url()?>cektarifprogi/search2",
//                 dataType:"JSON",
//                 data:{
//                     term:request.term,
//                     baseUrl:baseUrl,
//                     keyApi:keyApi
//                 },
//                 success:function (data) {
//                     response(data);
//                 }
//             })
            
//         },
//         select: function(event, ui) {
//             event.preventDefault();
//             $("#hint2").val(ui.item.label); // display the selected text
//             $("#tujuan").val(ui.item.value); // save selected id to hidden input
//         },
//         focus: function(event, ui) {
//             event.preventDefault();
//             $("#hint2").val(ui.item.label);
//         },

//         minLength: 3
//     });
// });
//     }

//     $("form#formCekTarif").submit(function(e) {
//         var data=$("#formCekTarif").serialize();
//         $.ajax({
//             type:"POST",
//             data:data,
//             url:"<?=base_url()?>cektarifprogi/cekTarif",
//             beforeSuccess:function () {
//                 $("#lytTarif").html("Loading...");
//             },
//             success:function(html) {
//                 $("#lytTarif").html(html);
//             }
//         });
//        e.preventDefault(); 
//     });

$(document).ready(function() {
   base_url = '<?= base_url(); ?>';
    $("#hint").autocomplete({
        source: base_url + "autocomplete/search/" + $("#hint").val(),
        select: function(event, ui) {
            event.preventDefault();
            $("#hint").val(ui.item.label); // display the selected text
            $("#asal").val(ui.item.value); // save selected id to hidden input
            $("#kabAsal").val(ui.item.kabAsal); // save selected id to hidden input
            $("#branchNameAsal").val(ui.item.branchNameAsal); // save selected id to hidden input
            $("#kecNameAsal").val(ui.item.kecNameAsal); // save selected id to hidden input
            $("#kabupatenNameAsal").val(ui.item
                .kabupatenNameAsal); // save selected id to hidden input
        },
        focus: function(event, ui) {
            event.preventDefault();
            $("#hint").val(ui.item.label);
        },

        minLength: 3
    });


    $("#hint2").autocomplete({
        source: base_url + "autocomplete/search2/" + $("#hint").val(),
        select: function(event, ui) {
            event.preventDefault();
            $("#hint2").val(ui.item.label); // display the selected text
            $("#tujuan").val(ui.item.value); // save selected id to hidden input
            $("#kabTujuan").val(ui.item.kabTujuan); // save selected id to hidden input
            $("#branchNameTujuan").val(ui.item
                .branchNameTujuan); // save selected id to hidden input
            $("#kecNameTujuan").val(ui.item.kecNameTujuan); // save selected id to hidden input
            $("#kabupatenNameTujuan").val(ui.item
                .kabupatenNameTujuan); // save selected id to hidden input
        },
        focus: function(event, ui) {
            event.preventDefault();
            $("#hint2").val(ui.item.label);
        },

        minLength: 3
    }); 
});

$("form#formCekTarif").submit(function(e) {
        var data=$("#formCekTarif").serialize();
        $.ajax({
            type:"POST",
            data:data,
            url:"<?=base_url()?>cektarifprogi/cekTarifAll",
            beforeSend:function () {
                $("#lytTarif").html("Loading...");
            },
            success:function(html) {
                $("#lytTarif").html(html);
            }
        });
       e.preventDefault(); 
    });
</script>