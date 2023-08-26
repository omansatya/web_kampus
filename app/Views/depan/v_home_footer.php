
    <!-- footer start -->
    <footer>
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-sm-6">
                  <div class="single-box">
                      <img src="<?php echo base_url('depan') ?>/asset/Image/img/logo sepnop.png" alt=""><br>
                  <br><h3>Pencetak Generasi Teladan dan Berprestasi</h3>
                  </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                  <div class="single-box">
                      <h2>Program Study</h2>
                  <ul>
                      <li><a href="#">Teknik Informatika</a></li>
                      <li><a href="#">Sistem Informasi</a></li>
                      <li><a href="#">Hukum</a></li>
                      <li><a href="#">Manajemen</a></li>
                      <li><a href="#">Teknologi Pangan Dan Hasil Pertanian</a></li>
                  </ul>
                  </div>                    
              </div>
              <div class="col-lg-3 col-sm-6">
                  <div class="single-box">
                      <h2>Layanan</h2>
                  <ul>
                      <li><a href="#">Perpustakaan</a></li>
                      <li><a href="#">SPMI</a></li>
                      <li><a href="#">LPPM</a></li>
                      <li><a href="#">Laboratorium</a></li>
                      <li><a href="#">Keuangan</a></li>
                      <li><a href="#">Edufecta</a></li>
                  </ul>
                  </div>                    
              </div>
              <div class="col-lg-3 col-sm-6">
                  <div class="single-box">
                      <h2>Kontak Kami</h2>
                      <p>Jl. Raya Ardipura II No. 22 Polimak, Ardipura, Jayapura, Papua</p>
                      
                      <h2>Follow us on</h2>
                      <p class="socials">
                          <i class="fa fa-facebook"></i>
                          <i class="fa fa-dribbble"></i>
                          <i class="fa fa-pinterest"></i>
                          <i class="fa fa-twitter"></i>
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </footer>
    <!-- footer end -->





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#myCarousel').owlCarousel({
          items: 3, // Number of cards shown in each slide
          loop: true, // Continuously loop the carousel
          margin: 20, // Space between cards
          nav: true, // Show navigation buttons
          navText: [
            "<i class='fas fa-chevron-left'></i>",
            "<i class='fas fa-chevron-right'></i>",
          ], // Custom navigation icons
          responsive: {
            0: {
              items: 1, // Number of cards shown in the carousel for smaller screens
            },
            768: {
              items: 2, // Number of cards shown in the carousel for medium screens
            },
            992: {
              items: 3, // Number of cards shown in the carousel for large screens
            },
          },
        });
      });
    </script>
  </body>
</html>