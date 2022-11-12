document.getElementById("kecamatan").addEventListener("change", getKec);
function getKec() {
    var idKec = document.getElementById("kecamatan").value;
    $.ajax({
        url: "/home/load_kelurahan",
        type: "POST",
        dataType: "json",
        data: {
            idKec: idKec
        },
        success: function(response) {
            $('.kelurahan').html(response.data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });

}
// Jika inline tapi ga bisa kalo ada CSP
// function getKec(sel) {
//     var idKec = sel.value;
//     $.ajax({
//         url: "<?= site_url('home/load_kelurahan'); ?>",
//         type: "POST",
//         dataType: "json",
//         data: {
//             idKec: idKec
//         },
//         success: function(response) {
//             $('.kelurahan').html(response.data);
//         },
//         error: function(xhr, ajaxOptions, thrownError) {
//             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
//         }
//     });

// }