<?php
function get_CURL($url)
{
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
$return = json_decode($result, true);
return $return;
}

$result =  get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCkXmLjEr95LVtGuIm3l2dPg&key=AIzaSyCa3Ee6IxCyg6cFZPThm1vY9hKqTRjtLGE');
$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['subscriberCount'];


//latest video
$urllatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyBpo-RsOjYaFpPvZKaUAggbdpZXLZI5U7U&channelId=UCkXmLjEr95LVtGuIm3l2dPg&maxResults=1&order=date&part=snippet';
$result = get_CURL($urllatestVideo);
$latesVideoId =$result['items']['0']['id']['videoId'];


//instagram API

$clientID = "17841407994486586";
$accessToken = "IGAARbwNAKULpBZAE80c3N4MkdqUkZAxZATNubnBtd19OWTF1eGRVVEcwT1hoZAEFoM0hNUHZALWnRiQjFfUTl2LU5wdkNQM05TVXJSa3FEa3hqTEY2clNBOEVSYU5oS1JpSXlzcUlQY0IzcVlhc0RaZADdRdjNpTWtrVXlOUmxMaEM0RQZDZD";

// Informasi akun IG
$result2 = get_Curl("https://graph.instagram.com/v22.0/me?fields=username,profile_picture_url,followers_count&access_token=$accessToken");

$usernameIG = $result2['username'];
$profilePictureIG = $result2['profile_picture_url'];
$followersIG = $result2['followers_count'];

// Media IG
$media = get_CURL("https://graph.instagram.com/me/media?fields=id,media_url,caption&access_token=$accessToken");

$gambar1 = "";
if (isset($media['data']) && count($media['data']) >= 1) {
    $gambar1 = $media['data'][0]['media_url'];
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>My Portfolio</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#home">Rindu Arifa Rahill</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#portfolio">Portfolio</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
          <img src="img/profile1.jpeg" class="rounded-circle img-thumbnail">
          <h1 class="display-4">Rindu Arifa Rahill</h1>
          <h3 class="lead">Mahasiswa | Programmer | Youtuber</h3>
        </div>
      </div>
    </div>


    <!-- About -->
    <section class="about" id="about">
      <div class="container">
        <div class="row mb-4">
          <div class="col text-center">
            <h2>About</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <p>Sebagai mahasiswa, aku terus belajar dan beradaptasi dengan perkembangan teknologi supaya bisa menghadapi tantangan masa depan. Aku percaya bahwa proses belajar adalah perjalanan tanpa akhir yang membuka peluang untuk berinovasi dan memberi kontribusi nyata..</p>
          </div>
          <div class="col-md-5">
            <p>Menjadi mahasiswa bukan hanya tentang kuliah, tapi juga tentang membangun keterampilan dan wawasan yang bermanfaat. Aku selalu bersemangat untuk mengeksplorasi hal baru dan memperbaiki diri demi mencapai tujuan yang lebih besar.</p>
          </div>
        </div>
      </div>
    </section>

    <!--Youtube dan instagram-->
<section class="sosial bg-light" id="social">
  <div class="container">
    <div class="row pt-4 mb-4">
      <div class="col text-center">
        <h2>Sosial Media</h2>
      </div>
    </div>

    <div class="row justify-content-center">
      <!-- Kolom Youtube -->
      <div class="col-md-6 mb-4">
        <div class="row mb-2">
          <div class="col-md-4 text-center">
            <img src="<?= $youtubeProfilePic;?>" width="100%" class="rounded-circle img-thumnail">
          </div>
          <div class="col-md-8 d-flex flex-column justify-content-center">
            <h5><?= $channelName; ?></h5>
            <p><?= $subscriber; ?>   subscribers</p>
            <div class="g-ytsubscribe" data-channelid="UCkXmLjEr95LVtGuIm3l2dPg" data-layout="default" data-theme="dark" data-count="default"></div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $latesVideoId;?>?rel=0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>

      <!-- Kolom Instagram -->
      <div class="col-md-6 mb-4">
        <div class="row mb-2">
          <div class="col-md-4 text-center">
            <img src="<?= $profilePictureIG; ?>" width="100%" class="rounded-circle img-thumbnail">
          </div>
          <div class="col-md-8 d-flex flex-column justify-content-center">
            <h5>@<?= $usernameIG; ?></h5>
            <p><?= number_format($followersIG); ?> followers</p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <img src="<?= $gambar1; ?>" class="img-fluid rounded mb-2">
  

          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- Portfolio Section -->
<section id="portfolio" class="container my-5">
  <h2 class="text-center mb-4">Portfolio</h2>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="img/thumbs/1.png" class="card-img-top" alt="Tentang Saya 1">
        <div class="card-body">
          <p class="card-text">Rindu Arifa Rahill 12 April 2004</p>
          <p class="card-text">Mahasiswa Sistem Informasi angkatan 2022, Fakultas Sains dan Teknologi, UIN Imam Bonjol PADANG.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="img/thumbs/6.png" class="card-img-top" alt="Tentang Saya 2">
        <div class="card-body">
          <p class="card-text">Memiliki minat dan hobi dalam rancang bangun web</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="img/thumbs/3.png" class="card-img-top" alt="Tentang Saya 3">
        <div class="card-body">
          <p class="card-text">Berasal Dari Solok, Sumatra Barat</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- My Project Section -->
<section id="projects" class="container my-5">
  <h2 class="text-center mb-4">My Projects</h2>
  <div class="row justify-content-center">
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="img/thumbs/2.png" class="card-img-top" alt="Rest API Project">
        <div class="card-body">
          <p class="card-text">
            REST API meliputi autentikasi pengguna, manajemen data user, operasi CRUD untuk berbagai data, dan dokumentasi interaktif untuk memudahkan integrasi.
            
          </p>
          <p>
            <a href="https://github.com/rindoe12/rest-api" target="_blank" class="btn btn-primary btn-sm">Lihat Project</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>




    <!-- Contact -->
    <section class="contact bg-light" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">Contact me for more information or project collaboration!</p>
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>Location</h3></li>
              <li class="list-group-item">My Office</li>
              <li class="list-group-item">Jl. Ekora, Padang</li>
              <li class="list-group-item">West Sumatera, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">
            
            <form>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Rindoe  &copy; 2025</p>
          </div>
        </div>
      </div>
    </footer>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
  </body>
</html>