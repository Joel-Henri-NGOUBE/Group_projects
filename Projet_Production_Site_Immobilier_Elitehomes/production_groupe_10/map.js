var map = L.map('map').setView([48.8566, 2.3522], 12);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 16,
    minZoom: 10,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  var arrondissementsParis = [
    { id: 1, name: '1er Arrondissement', latlng: [48.8626, 2.3366] },
    { id: 2, name: '2e Arrondissement', latlng: [48.8678, 2.3441] },
    { id: 3, name: '3e Arrondissement', latlng: [48.8637, 2.3615] },
    { id: 4, name: '4e Arrondissement', latlng: [48.8543, 2.3574] },
    { id: 5, name: '5e Arrondissement', latlng: [48.8448, 2.3471] },
    { id: 6, name: '6e Arrondissement', latlng: [48.8493, 2.3323] },
    { id: 7, name: '7e Arrondissement', latlng: [48.8561, 2.3127] },
    { id: 8, name: '8e Arrondissement', latlng: [48.8726, 2.3086] },
    { id: 9, name: '9e Arrondissement', latlng: [48.8763, 2.3376] },
    { id: 10, name: '10e Arrondissement', latlng: [48.8761, 2.3615] },
    { id: 11, name: '11e Arrondissement', latlng: [48.8590, 2.3786] },
    { id: 12, name: '12e Arrondissement', latlng: [48.8390, 2.3955] },
    { id: 13, name: '13e Arrondissement', latlng: [48.8284, 2.3621] },
    { id: 14, name: '14e Arrondissement', latlng: [48.8298, 2.3271] },
    { id: 15, name: '15e Arrondissement', latlng: [48.8413, 2.2975] },
    { id: 16, name: '16e Arrondissement', latlng: [48.8637, 2.2769] },
    { id: 17, name: '17e Arrondissement', latlng: [48.8837, 2.3075] },
    { id: 18, name: '18e Arrondissement', latlng: [48.8925, 2.3444] },
    { id: 19, name: '19e Arrondissement', latlng: [48.8823, 2.3827] },
    { id: 20, name: '20e Arrondissement', latlng: [48.8632, 2.4000] }
  ];

  var markersLayer = L.layerGroup().addTo(map);

  for (var i = 0; i < arrondissementsParis.length; i++) {
    var arrondissement = arrondissementsParis[i];
    L.marker(arrondissement.latlng)
      .bindPopup('<b>' + arrondissement.name + '</b><br><a href="#" onclick="loadApartments(' + arrondissement.id + ')">Voir les appartements</a>')
      .addTo(markersLayer);
  }

  function loadApartments(districtId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var apartments = JSON.parse(xhr.responseText);
          displayApartments(apartments);
        } else {
          console.log('Une erreur s\'est produite lors de la récupération des données des appartements.');
        }
      }
    };
    xhr.open('GET', 'map.php?district=' + districtId, true);
    xhr.send();
  }

  function displayApartments(apartments) {
    var apartmentsInfo = document.getElementById('apartments-info');
    apartmentsInfo.innerHTML = '';

    for (var i = 0; i < apartments.length; i++) {
      var apartment = apartments[i];
      var apartmentInfo = document.createElement('div');
      apartmentInfo.innerHTML = '<h3>' + apartment.name + '</h3><p>' + apartment.price + ' €</p><p>' + apartment.surface + ' m²</p>';
    
      var button = document.createElement('button');
      button.innerHTML = 'En savoir plus';
      button.onclick = function(apartment) {
        return function() {
          showApartmentDetails(apartment);
        };
      }(apartment);
    
      var infoContainer = document.createElement('div');
      infoContainer.appendChild(apartmentInfo);
      infoContainer.appendChild(button);
    
      apartmentsInfo.appendChild(infoContainer);
    }
  }

  function showApartmentDetails(apartment) {
    window.location.href = 'suite_map.php?id=' + apartment.id;
  }    