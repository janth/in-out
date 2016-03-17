function updateDisplayedStatus(id) {
  "use strict";

  var
    employee = document.getElementById('employee_' + id),
    xhr = new XMLHttpRequest();

  employee.style.opacity = 0.2;

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
//      employee.style.backgroundColor = xhr.responseText;
switch (xhr.responseText) {
case '66cc66' : // "In" value
                employee.style.background = 'linear-gradient(to bottom, rgba(248,191,0,1) 0%,rgba(248,191,0,1) 14.99%,rgba(116,188,9,1) 15%,rgba(116,188,9,1) 100%)';
                break;

       default : employee.style.background = 'url(bg_employee.png) top left repeat-x';
                 employee.style.backgroundColor = xhr.responseText;
}


      employee.style.opacity = 1;
    }
  };

  xhr.open("GET", "ajax.php?action=toggle&id=" + id, true);
  xhr.send();

}
