function displayMakes(sel) {
  var value = sel.options[sel.selectedIndex].text;
  var sel2 = document.getElementById("vehicle_make_select");
  if (value == "Car") {
    while (sel2.hasChildNodes()) {
      sel2.removeChild(sel2.lastChild);
    }
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Please select an option"));
    opt.value = "unselected";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Alfa Romeo Giulia"));
    opt.value = "Alfa Romeo Giulia";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Audi TT"));
    opt.value = "Audi TT";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("BMW 5 Series"));
    opt.value = "BMW 5 Series";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Citroën C3"));
    opt.value = "Citroën C3";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Citroën C4"));
    opt.value = "Citroën C4";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Fiat 5000X"));
    opt.value = "Fiat 5000X";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Ford Fiesta"));
    opt.value = "Ford Fiesta";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Ford Fusion"));
    opt.value = "Ford Fusion";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Honda Civic"));
    opt.value = "Honda Civic";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Honda Fit"));
    opt.value = "Honda Fit";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Hyundai I20"));
    opt.value = "Hyundai I20";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Hyundai Tucscon"));
    opt.value = "Hyundai Tucson";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Jaguar F-Pace"));
    opt.value = "Jaguar F-Pace";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Jeep Renegade"));
    opt.value = "Jeep Renegade";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Kia Motors Sportage"));
    opt.value = "Kia Motors Sportage";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Land Rover Discovery"));
    opt.value = "Land Rover Discovery";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Mazda Mazda6"));
    opt.value = "Mazda Mazda6";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Mercedes-Benz E Class"));
    opt.value = "Mercedes-Benz E Class";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Nissan Leaf"));
    opt.value = "Nissan Leaf";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Nissan Qashqai"));
    opt.value = "Nissan Qashqai";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Peugeot 5008"));
    opt.value = "Peugeot 5008";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Skoda Kodiaq"));
    opt.value = "Skoda Kodiaq";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Skoda Octavia"));
    opt.value = "Skoda Octavia";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Volvo XC60"));
    opt.value = "Volvo XC60";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Other"));
    opt.value = "Other";
    sel2.appendChild(opt);
  }
  if (value == "Motorbike") {
    while (sel2.hasChildNodes()) {
      sel2.removeChild(sel2.lastChild);
    }
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Please select an option"));
    opt.value = "unselected";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Honda CBR 250"));
    opt.value = "Honda CBR 250";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("BMW R1150RT"));
    opt.value = "BMW R1150RT";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("BMW R1200"));
    opt.value = "BMW R1200";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Honda VTX 1300"));
    opt.value = "Honda VTX 1300";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Kawasaki KLE 500"));
    opt.value = "Kawasaki KLE 500";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Yamaha MT07"));
    opt.value = "Yamaha MT07";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Yamaha FZ Fazer 1000"));
    opt.value = "Yamaha FZ Fazer 1000";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Yamaha X-MAX"));
    opt.value = "Yamaha X-MAX";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Other"));
    opt.value = "Other";
    sel2.appendChild(opt);
  }
  if (value == "Van") {
    while (sel2.hasChildNodes()) {
      sel2.removeChild(sel2.lastChild);
    }
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Please select an option"));
    opt.value = "unselected";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Peugeot Partner"));
    opt.value = "Peugeot Partner";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Vauxhall Combo 2000"));
    opt.value = "Vauxhall Combo 2000";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Renault Master III"));
    opt.value = "Renault Master III";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Renault Kangoo 1.5"));
    opt.value = "Renault Kangoo 1.5";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Vauxhall Combo 2900"));
    opt.value = "Vauxhall Combo 2900";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Ford Transit Courier"));
    opt.value = "Ford Transit Courier";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Volkswagen Caddy C20"));
    opt.value = "Volkswagen Caddy C20";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Other"));
    opt.value = "Other";
    sel2.appendChild(opt);
  }
  if (value == "Minibus") {
    while (sel2.hasChildNodes()) {
      sel2.removeChild(sel2.lastChild);
    }
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Please select an option"));
    opt.value = "unselected";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Mercedes 513CDi Sprinter"));
    opt.value = "Mercedes 513CDi Sprinter";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("LDV V80"));
    opt.value = "LDV V80";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Ford Tourneo"));
    opt.value = "Ford Tourneo";
    sel2.appendChild(opt);
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode("Other"));
    opt.value = "Other";
    sel2.appendChild(opt);
  }
}

function toggleDetails(e) {
  if (e.lastElementChild.hasAttribute("hidden")) {
    e.lastElementChild.removeAttribute("hidden");
  } else {
    e.lastElementChild.setAttribute("hidden", true);
  }
}

function toggleDateFields() {
  var week = document.getElementById("weeklyRadio");
  var date = document.getElementById("dailyRadio");
  var weekInput = document.getElementById("weekInput");
  var dateInput = document.getElementById("dateInput");
  if (week.checked) {
    weekInput.removeAttribute("disabled");
    dateInput.setAttribute("disabled", true);
  }
  if (date.checked) {
    dateInput.removeAttribute("disabled");
    weekInput.setAttribute("disabled", true);
  }
}

$(".nav .nav-link").on("click", function() {
  $(".nav")
    .find(".active")
    .removeClass("active");
  $(this).addClass("active");
});

function rosterTable() {
  var table = document.getElementById("roster");

  for (var i = 1; i < 5; i++) {
    for (var j = 1; j < table.rows[0].cells.length; j++) {
      var cell = table.rows[i].cells[j];
      if (cell.innerHTML != "") {
        var form = cell.childNodes[0];
        if (form.classList.contains("majorRepair")) {
          table.rows[i + 1].cells[j].innerHTML = "";
        } else {
          //alert(form.innerHTML);
        }
      }
    }
  }
}

window.rosterTable();
