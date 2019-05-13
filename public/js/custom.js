window.onload = function() {
  var rads = document.querySelectorAll('input[name="assign_application_to"]'); // get all radios with name assign_application_to

  for (var i = 0; i<rads.length; i++) {
    rads[i].onclick=function() { // assign onclick to each
      if (this.id === "assign_to_me") { // the one deciding input
        document.getElementById("adv_org_sel").selectedIndex = 0; // reset select
        document.getElementById("assign_to_me").focus();
        document.getElementById("client_new_application_submit").disabled = false;
      } else {
        if (document.getElementById("adv_org_sel").selectedIndex === 0) {
          document.getElementById("client_new_application_submit").disabled = true;
        }
      }
    }
  }

  document.getElementById("adv_org_sel").onchange = function() { // when selecting
    document.getElementById("add_to_clients_in_need").click(); // click the rad to select it
    if (document.getElementById("adv_org_sel").selectedIndex === 0) {
      document.getElementById("client_new_application_submit").disabled = true;
    } else {
      document.getElementById("client_new_application_submit").disabled = false;
    }
  };

  var rad = document.querySelector('input[name="assign_application_to"][checked]');
  if (rad == null)  {
    document.getElementById("assign_to_me").click(); // check default
  }
};
