function searchMovie() {
  $('#movie-list').html('');
  $.ajax({
    url: 'https://www.omdbapi.com',
    type: 'get',
    dataType: 'json',
    data: {
      'apikey': '52ac2799',
      's': $('#search-input').val()
    },
    success: function (result) {
      if (result.Response == "True") {
        let movies = result.Search;
        
        $.each(movies, function (i, data) {
          $('#movie-list').append(`
            <div class="col-md-4">
              <div class="card mb-3">
                <img src="${data.Poster !== "N/A" ? data.Poster : 'https://via.placeholder.com/400x600?text=No+Image'}" class="card-img-top" alt="${data.Title}">
                <div class="card-body">
                  <h5 class="card-title">${data.Title}</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">${data.Year}</h6>
                  <a href="#" class="card-link btn-detail" data-id="${data.imdbID}" data-bs-toggle="modal" data-bs-target="#exampleModal">See Detail</a>
                </div>
              </div>
            </div>
          `);
        });
        
        $('#search-input').val('');
      } else {
        $('#movie-list').html(`
          <div class="col">
            <h1 class="text-center">${result.Error}</h1>
          </div>
        `);
      }
    }
  });
}

// Event listener untuk tombol See Detail
$('#movie-list').on('click', '.btn-detail', function(e) {
  e.preventDefault(); // cegah reload halaman

  const imdbID = $(this).data('id');

  $.ajax({
    url: 'https://www.omdbapi.com',
    type: 'get',
    dataType: 'json',
    data: {
      'apikey': '52ac2799',
      'i': imdbID
    },
    success: function(movie) {
      // Tampilkan detail di modal (misal, isi modal body)
      $('#exampleModal .modal-body').html(`
        <h4>${movie.Title}</h4>
        <p><strong>Released:</strong> ${movie.Released}</p>
        <p><strong>Genre:</strong> ${movie.Genre}</p>
        <p><strong>Director:</strong> ${movie.Director}</p>
        <p><strong>Plot:</strong> ${movie.Plot}</p>
        <img src="${movie.Poster !== "N/A" ? movie.Poster : 'https://via.placeholder.com/400x600?text=No+Image'}" class="img-fluid" alt="${movie.Title}">
      `);
    }
  });
});

$('#search-button').on('click', function() {
  searchMovie();
});

$('#search-input').on('keyup', function (e) {
  if (e.keyCode === 13) {
    searchMovie();
  }
});
