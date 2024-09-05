@extends('user.layout.app')

@section('content')
<section id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="3000">
            <img src="Image/Carousel1.png" class="d-block w-100" alt="..." />
            <div class="carousel-1 carousel-caption d-md-block text-start">
                <h6>STAR EXPRESS CARGO</h6>
                <h5>SEAMLESS DELIVERY, WORLDWIDE CONNECTION</h5>
                <p>
                    We are expanding our operations internationally, with new branches
                    in Dubai, Australia, and Singapore, ensuring your cargo can be
                    delivered across borders with ease.
                </p>
                <button>VIEW MORE</button>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <img src="Image/Carousel2.png" class="d-block w-100" alt="..." />
            <div class="carousel-2 carousel-caption d-md-block">
                <h5>TEST PART 2 ULIT</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-3 carousel-item" data-bs-interval="3000">
            <img src="Image/Carousel3.png" class="d-block w-100" alt="..." />
            <div class="carousel-caption d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</section>


<section class="home-service">
    <h1 class="title text-center">OUR SERVICES</h1>

    <div class="home-service-box">
        <div class="box">
            <div class="text-center">
                <img class="box-img" src="Image/MediumStarBox.png" alt="" />
            </div>
            <h2 class="name">
                Medium Star Package<img class="yellow-mark" src="image/mark.png" alt="" />
            </h2>
            <h3 class="name2">Package description</h3>
            <p class="description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <h4 class="price">
                <span><img class="price-tag" src="Image/Tag.png" alt="" /></span> ¥
                123.00 - 456.00
            </h4>
            <button>View Package</button>
        </div>

        <div class="box">
            <div class="text-center">
                <img class="box-img" src="Image/SuperStarBox.png" alt="" />
            </div>
            <h2 class="name">
                Super Star Package<img class="yellow-mark" src="image/mark.png" alt="" />
            </h2>
            <h3 class="name2">Package description</h3>
            <p class="description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <h4 class="price">
                <span><img class="price-tag" src="Image/Tag.png" alt="" /></span> ¥
                123.00 - 456.00
            </h4>
            <button>View Package</button>
        </div>

        <div class="box">
            <div class="text-center">
                <img class="box-img" src="Image/Kingbox.png" alt="" />
            </div>
            <h2 class="name">
                King Star Package<img class="yellow-mark" src="image/mark.png" alt="" />
            </h2>
            <h3 class="name2">Package description</h3>
            <p class="description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <h4 class="price">
                <span><img class="price-tag" src="Image/Tag.png" alt="" /></span> ¥
                123.00 - 456.00
            </h4>
            <button>View Package</button>
        </div>
    </div>
    <div class="viewmore text-center">
        <button>View more deals</button>
    </div>
</section>

<section class="home-news">
    <h1 class="title">NEWS AND EVENTS</h1>
    <div class="news-box">
        <div class="box">
            <div class="text-center">
                <img class="event-img" src="Image/event.png" alt="" />
            </div>
            <h6 class="date">
                <i class="fa-solid fa-calendar-days"></i>October 20 2024
            </h6>
            <h1>STAR EXPRESS CARGO NEWS AND EVENT TITLE</h1>
            <p class="desc">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates
                ratione dicta, eligendi iusto quibusdam atque ipsum commodi
                molestias tempora ipsa eaque illo impedit voluptas eum corporis
                tempore quia error esse.
            </p>
            <a>View More</a>
        </div>
        <div class="box">
            <div class="text-center">
                <img class="event-img" src="Image/event.png" alt="" />
            </div>
            <h6 class="date">
                <i class="fa-solid fa-calendar-days"></i>October 20 2024
            </h6>
            <h1>STAR EXPRESS CARGO NEWS AND EVENT TITLE</h1>
            <p class="desc">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates
                ratione dicta, eligendi iusto quibusdam atque ipsum commodi
                molestias tempora ipsa eaque illo impedit voluptas eum corporis
                tempore quia error esse.
            </p>
            <a>View More</a>
        </div>
        <div class="box">
            <div class="text-center">
                <img class="event-img" src="Image/event.png" alt="" />
            </div>
            <h6 class="date">
                <i class="fa-solid fa-calendar-days"></i>October 20 2024
            </h6>
            <h1>STAR EXPRESS CARGO NEWS AND EVENT TITLE</h1>
            <p class="desc">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates
                ratione dicta, eligendi iusto quibusdam atque ipsum commodi
                molestias tempora ipsa eaque illo impedit voluptas eum corporis
                tempore quia error esse.
            </p>
            <a>View More</a>
        </div>
    </div>
</section>

<section class="home-about">
    <div class="about-flex">
        <div class="left">
            <img class="year-img" src="Image/years.png" alt="" />
            <p class="desc">
                For over 12 years, the company has grown significantly. From 2012 to
                2021, it partnered with another cargo shipment company, Ex-Speed,
                and together they established 12 branches. During this period,
                D-Speed became the most used cargo shipment service in Macau between
                2019 and 2021. In 2021, the company parted ways with Ex-Speed and
                established its own warehouse in Tarlac, Philippines, marking the
                beginning of its independent delivery courier service.
            </p>
        </div>
        <div class="right">
            <div class="d-flex">
                <img src="Image/choose1.png" alt="" />
                <h6>Proven Expertise</h6>
            </div>
            <div class="d-flex">
                <img src="Image/choose2.png" alt="" />
                <h6>GLOBAL REACH</h6>
            </div>
            <div class="d-flex">
                <img src="Image/choose3.png" alt="" />
                <h6>REAL - TIME TRACKING</h6>
            </div>
            <div class="d-flex">
                <img src="Image/choose4.png" alt="" />
                <h6>SAFETY FIRST</h6>
            </div>
        </div>
    </div>
</section>

<section class="home-choose">
    <h1>WHY CHOOSE US</h1>
    <div class="d-flex">
        <img src="Image/choosew1.png" alt="" />
        <p>
            Star Express Cargo has a deep understanding of the logistics and
            challenges involved in delivering goods safely and efficiently.
        </p>
    </div>
    <div class="d-flex">
        <img src="Image/choosew2.png" alt="" />
        <p>
            We are expanding our operations internationally, with new branches in
            Dubai, Australia, and Singapore, ensuring your cargo can be delivered
            across borders with ease.
        </p>
    </div>
    <div class="d-flex">
        <img src="Image/choosew3.png" alt="" />
        <p>
            Our commitment to on-time delivery means you can trust us to get your
            cargo where it needs to be, when it needs to be there.
        </p>
    </div>
    <div class="d-flex">
        <img src="Image/choosew4.png" alt="" />
        <p>
            We prioritize the safety of your cargo with stringent handling
            procedures and secure facilities, ensuring your shipments arrive in
            perfect condition.
        </p>
    </div>
</section>

<section class="home-contact">
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <form action="">
                <label for="loc"><i class="fa-solid fa-globe"></i></label>
                <select name="loc" class="form-control" id="loc">
                    <option value="">LOCATION</option>
                    <option value="">LOCATION</option>
                    <option value="">LOCATION</option>
                    <option value="">LOCATION</option>
                    <option value="">LOCATION</option>
                </select>
                <label for="name"><i class="fa-solid fa-user"></i></label>
                <input type="text" class="form-control" name="" id="name" placeholder="NAME" />
                <label for="email"><i class="fa-solid fa-envelope"></i></label>
                <input type="text" class="form-control" name="" id="email" placeholder="EMAIL ADDRESS" />
                <label for="contact"><i class="fa-solid fa-phone"></i></label>
                <input type="text" class="form-control" name="" id="contact" placeholder="CONTACT NUMBER" />
                <label for="msg"><i class="fa-solid fa-message"></i></label>
                <textarea class="form-control" name="msg" id="" rows="4" placeholder="MESSAGE"></textarea>
                <button>SUBMIT</button>
            </form>
        </div>
        <div class="col-lg-4 col-sm-12">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3691.1660874944423!2d114.18826471186054!3d22.309557579595143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x340400df7005179b%3A0x1a70383fd11b3c7b!2sHarbour%20Centre%20Tower%201!5e0!3m2!1sen!2sph!4v1725291016817!5m2!1sen!2sph"
                width="100%" height="100%" style="border: 0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="d-flex socialmedia medias">
                <i class="maps fa-solid fa-location-dot"></i>
                <p class="address">
                    Unit 1011A 10/F Harbour Centre Tower 1, 1 Hok Cheung St., Hung
                    Hom, Hong Kong
                </p>
            </div>
            <div class="d-flex medias">
                <i class="fb fa-brands fa-facebook"></i>
                <p class="social">Star Express Cargo HK</p>
            </div>
            <div class="d-flex medias">
                <i class="whatsup fa-brands fa-square-whatsapp"></i>
                <p class="social">6697-3868</p>
            </div>
            <div class="d-flex medias">
                <i class="email fa-solid fa-envelope"></i>
                <p class="social">starexpresscargohk@gmail.com</p>
            </div>
        </div>
    </div>
</section>
<footer class="text-center">
    <div class="content">
        <div class="d-flex">
            <a href="">TERMS AND CONDITIONS</a><span class="line"> | </span>
            <a href="">PRIVACY POLICY</a>
            <h1 class="reserve">STAR EXPRESS CARGO © 2024 ALL RIGHTS RESERVED</h1>
        </div>
    </div>
</footer>

{{-- <div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    {{ __('You are logged in!') }}
</div> --}}
@endsection