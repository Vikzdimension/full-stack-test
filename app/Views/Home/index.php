<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>WPoets Full Stack Test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand">WPoets Test</a>
            <a href="/sliders" class="btn btn-outline-primary">Manage Sliders</a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-3 d-none d-md-block">
                <ul class="nav nav-pills flex-column" id="sliderTabs">
                    <?php foreach($sliders as $i => $s): ?>
                    <li class="nav-item mb-2">
                        <button class="nav-link<?= $i === 0 ? ' active' : '' ?>" data-index="<?= $i ?>" type="button">
                            <?= htmlspecialchars($s['title']) ?>
                        </button>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-12 d-md-none">
                <div class="accordion" id="mobileAccordion">
                    <?php foreach($sliders as $i => $s): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?= $i ?>">
                            <button class="accordion-button<?= $i !== 0 ? ' collapsed' : '' ?>" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>"
                                aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $i ?>">
                                <?= htmlspecialchars($s['title']) ?>
                                <img src="files/images/plus-01.svg" class="toggle-icon"
                                    data-plus="files/images/plus-01.svg" data-minus="files/images/minus-01.svg"
                                    width="20" height="20" alt="">
                            </button>
                        </h2>
                        <div id="collapse<?= $i ?>" class="accordion-collapse collapse<?= $i === 0 ? ' show' : '' ?>"
                            data-bs-parent="#mobileAccordion">
                            <div class="accordion-body">
                                <?= htmlspecialchars($s['description']) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="slider-container mb-3">
                    <?php foreach($sliders as $i => $s): ?>
                    <div class="slider-item<?= $i === 0 ? ' active' : '' ?>" data-index="<?= $i ?>">
                        <img src="files/images/<?= htmlspecialchars($s['image']) ?>"
                            alt="<?= htmlspecialchars($s['title']) ?>">
                    </div>
                    <?php endforeach; ?>
                </div>

                <ul class="slider-dots"></ul>

                <div class="d-flex justify-content-center align-items-center mt-2">
                    <button class="btn btn-link slider-prev" aria-label="Previous">
                        <img src="files/images/arrow-right.svg" class="flip-icon" width="24">
                    </button>
                    <button class="btn btn-link slider-next" aria-label="Next">
                        <img src="files/images/arrow-right.svg" width="24">
                    </button>
                </div>
            </div>

            <div class="col-md-3 d-none d-md-block" id="displayImage">
                <img src="files/images/<?= htmlspecialchars($sliders[0]['image']) ?>" alt="Current slide">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
    $(function() {
        let current = 0;
        const total = $('.slider-item').length;
        let interval;

        for (let i = 0; i < total; i++) {
            $('.slider-dots').append(`<li data-index="${i}"${i === 0 ? ' class="active"' : ''}></li>`);
        }

        function showSlide(index) {
            $('.slider-item.active').fadeOut(600).removeClass('active');
            const $next = $('.slider-item').eq(index);
            $next.fadeIn(600).addClass('active');

            $('.slider-dots li').removeClass('active').eq(index).addClass('active');

            $('#sliderTabs button').removeClass('active').eq(index).addClass('active');

            $('#displayImage img').attr('src', $next.find('img').attr('src'));

            current = index;
        }

        function nextSlide() {
            current = (current + 1) % total;
            showSlide(current);
        }

        function prevSlide() {
            current = (current - 1 + total) % total;
            showSlide(current);
        }

        interval = setInterval(nextSlide, 4000);

        $('.slider-dots').on('click', 'li', function() {
            clearInterval(interval);
            showSlide($(this).data('index'));
        });

        $('.slider-next').click(() => {
            clearInterval(interval);
            nextSlide();
        });

        $('.slider-prev').click(() => {
            clearInterval(interval);
            prevSlide();
        });

        $('#sliderTabs button').on('click', function() {
            clearInterval(interval);
            showSlide($(this).data('index'));
        });

        $('.accordion-button').on('click', function() {
            const $this = $(this);
            const $icon = $this.find('.toggle-icon');
            const isExpanded = $this.attr('aria-expanded') === 'true';

            setTimeout(() => {
                $icon.attr('src', isExpanded ? $icon.data('minus') : $icon.data('plus'));
            }, 350);

            const index = $this.closest('.accordion-item').index();
            showSlide(index);
            clearInterval(interval);
        });
    });
    </script>
</body>

</html>