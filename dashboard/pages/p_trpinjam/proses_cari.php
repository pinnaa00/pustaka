<!-- live search using ajax -->
<script>
function showName(str) {
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
        xmlhttp.open("GET", "pages/p_trpinjam/cari.php?q=" + str, true);
        xmlhttp.send();
    }
}

function showBook(str, bookNumber) {
    let titleField = 'judul' + bookNumber; // ID of the title field
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
        xmlhttp.open("GET", "pages/p_trpinjam/cari.php?b=" + str, true);
        xmlhttp.send();
    }
}
</script>