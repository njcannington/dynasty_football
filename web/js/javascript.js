// USED FOR TABLE SORTING
function sortTable(table, col, reverse) {
    var tb = table.tBodies[0], 
        tr = Array.prototype.slice.call(tb.rows, 0),
        i;
    reverse = -((+reverse) || -1);
    tr = tr.sort(function (a, b) {
        if(!isNaN(a.cells[col].textContent) && !isNaN(b.cells[col].textContent))
        return reverse * ((+a.cells[col].textContent) - (+b.cells[col].textContent))
       return reverse
            * (a.cells[col].textContent.trim()
                .localeCompare(b.cells[col].textContent.trim())
               );
    });
    for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]);
}
function makeSortable(table) {
    var th = table.tHead, i;
    th && (th = th.rows[0]) && (th = th.cells);
    if (th) i = th.length;
    else return;
    while (--i >= 0) (function (i) {
        var dir = 1;
        th[i].addEventListener('click', function () {sortTable(table, i, (dir = 1 - dir))});
    }(i));
}
function makeAllSortable(parent) {
    parent = parent || document.body;
    var t = parent.getElementsByTagName('table'), i = t.length;
    while (--i >= 0) makeSortable(t[i]);
}
window.onload = function () {makeAllSortable();};


function filterThis() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("filterInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("filterTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}




