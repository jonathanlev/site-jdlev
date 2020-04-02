<?php include "top.php"; ?>
    <div class="content">
      <section id="home"><?php include "home.php";?></section>
      <section id="about"><?php include "aboutme.php";?></section>
      <section id="portfolio"><?php include "resume.php";?></section>
      <section id="contact"><?php include "contact.php";?></section>
    </div>

    <!-- JS -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>

  <script>
       $(document).ready(function () {
          $(document).on("scroll", onScroll);

          $('a[href^="#"]').on('click', function (e) {
            e.preventDefault();
            $(document).off("scroll");

            $('a').each(function () {
              $(this).removeClass('active');
            })
            $(this).addClass('active');

            var target = this.hash;
            $target = $(target);
            $('html, body').stop().animate({
              'scrollTop': $target.offset().top+2
            }, 500, 'swing', function () {
              window.location.hash = target;
              $(document).on("scroll", onScroll);
            });
          });
        });

        function onScroll(event){
          var scrollPosition = $(document).scrollTop();
          $('nav a').each(function () {
            var currentLink = $(this);
            var refElement = $(currentLink.attr("href"));
            if (refElement.position().top <= scrollPosition && refElement.position().top + refElement.height() > scrollPosition) {
              $('nav ul li a').removeClass("active");
              currentLink.addClass("active");
            }
            else{
              currentLink.removeClass("active");
            }
          });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php include "footer.php"; ?>
  </body>
  </html>
