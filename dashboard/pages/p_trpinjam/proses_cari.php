<!-- live search using ajax -->
<script>
function showName(str) { // UUNTUK CARI NAMA
    if (str.length == 0) {
        document.getElementById('nama').value = "";
        return;
    } else {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('nama').value = this.responseText;
            }
        }
        xmlhttp.open("GET", "pages/p_trpinjam/cari_nik.php?q=" + str, true);
        xmlhttp.send();
    }
}

function showBook(str,
    bookNumber) { // UNTUK CARI BUKU 
    let titleField = 'judulBuku' + bookNumber; // ID of the title field
    if (str.length == 0) {
        document.getElementById(titleField).value = "";
        return;
    } else {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(titleField).value = this.responseText;
            }
        }
        xmlhttp.open("GET", "pages/p_trpinjam/cari_nik.php?b=" + str, true);
        xmlhttp.send();
    }
}
</script>