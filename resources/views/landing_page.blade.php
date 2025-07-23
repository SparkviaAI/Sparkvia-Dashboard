<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getSettingByKey(App\Utils\Settings::SITE_TITLE)  }} | {{ getSettingByKey(App\Utils\Settings::BRAND_SLOGAN) }}</title>
    <link rel="shortcut icon" href="{{ asset('f_admin/'.(getSettingByKey(App\Utils\Settings::BRAND_FAVICON))) }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('landing-css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('landing-css/dasboard.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-5/5.39.0/css/tempusdominus-bootstrap-5.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
</head>
<style>
    /* Loader CSS */
    .loader-overlay {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: none; /* Initially hide the loader */
        justify-content: center;
        align-items: center;
    }

    .spinner {
        border: 16px solid #f3f3f3;
        border-top: 16px solid #3498db;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<body>
    <div class="loader-overlay">
        <div class="spinner"></div>
    </div>

    <div class="black-bk">
        <section class="custom-header-new">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand" href="#"><img src="{{ asset('f_admin/'.$logoSetting?->value ?? 'landing-images/logo-landing.png') }}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#solutions">Solutions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#features">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#faq">FAQ</a>
                            </li>
                        </ul>
                        <button class="btn btn-outline-success">
                            <a href="{{ route('handleLoggin') }}">
                                <img src="{{ asset('landing-images/bt.png') }}" alt="">
                            </a>
                        </button>
                    </div>
                </div>
            </nav>
        </section>



        <section class="banner-sec-new">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-sec-new-content">
                            <p class="Autopilot-p1">Content on <br> Autopilot with <br> <span>CardanoGPT AI <br> Writing
                                    Tools</span></p>
                            <p class="Autopilot-p2">Create blogs, ad copies, emails, social media posts, images, and
                                more in seconds! Register for beta and get a free 1000 test tokens</p>
                                <!-- <button class="StartwritingNow">Start writing Now!</button>                             -->
                                <a class="StartwritingNow" href="{{ route('handleLoggin') }}" style="text-transform: none !important; color:black;">Start writing Now!</a>
                            <img src="{{ asset('landing-images/circle-1.png') }}" class="circle-1-img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="say-goodbye" id="solutions">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="say-good-bye-content">
                            <button class="solution-bt">Our solution</button>
                            <p class="say-good-bye-p">Say Goodbye to <br> Writer’s Block. Create <br> AI Content in
                                Seconds.</p>
                            <p class="say-good-bye-p-1">That's why we built CardanoGPT writing platform- an AI powered
                                content generating tools that creates customized, optimized content for any business
                                with just a few clicks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="discover">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="discover-div">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="under-discover">
                                        <div class="width-400">
                                            <button class="solution-bt">what it can do</button>
                                            <p class="simplify-p1">Discover The Magic of <br> CardanoGPT Write.</p>
                                            <p class="simplify-p2">Your go-to for everything from writing help to marketing insights and
                                                business solutions. Take a closer look at how we simplify your writing
                                                tasks!</p>
                                        </div>
                                        <ul class="solutions-ul">
                                            <li><a style="min-width: 200px;" href="" class="active">Marketing Plan</a></li>
                                            <li><a style="min-width: 172px;" href="" class="">Sales Email</a></li>
                                            <li><a style="min-width: 235px" href="" class="">Curate An AD Copy</a></li>
                                            <li><P class="LINE"></P></li>
                                        </ul>
                                        <div class="rel-34">
                                            <img src="{{ asset('landing-images/card-909.png') }}" class="card-909" alt="">
                                            <img src="{{ asset('landing-images/pause.png') }}" class="card-9091" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="say-goodbye new-wordclass" style="position: relative;" id="features">
            <img src="{{ asset('landing-images/mni.png') }}" class="ot2qq" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="say-good-bye-content">
                            <button class="solution-bt">Our features</button>
                            <p class="say-good-bye-p">Our worldclass <br> Features</p>
                            <p class="say-good-bye-p-1">We built the best for the best. below are some of our amazing features that makes us worldclass</p>
                            <img src="{{ asset('landing-images/tag.png') }}" class="tag" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="say-goodbye new-CardanoGPT">
            <img src="{{ asset('landing-images/Ellipse-new.png') }}" class="Ellipse-new" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="say-good-bye-content">
                            <button class="solution-bt">why choose us</button>
                            <p class="say-good-bye-p">Why Choose CardanoGPT  <br> Write Over ChatGPT</p>
                            <p class="say-good-bye-p-1">CardanoGPT Write is the fastest & easiest way to get content for your business</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="img-good">
                            <div class="row its-row">
                                <div class="col-lg-6 its-col">
                                    <div class="left-card-good">
                                        <img src="{{ asset('landing-images/logo-landing.png') }}" class="logo-landing" alt="">
                                        <ul class="left-card-good-ul">
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>No need of prompts. You get the best possible output from our AI.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>High quality & structured output received every time.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>Web3.0 & blockchain integration.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>Comprehensive ad creation tools like ad copy, ad hooks, targeting helper</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>Dedicated tools for blogs, ads, email, e-commerce, SEO, social media, websites, music.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>Uses models like AIDA, BAB, PASTOR for structured copywriting.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 its-col">
                                    <div class="left-card-good right-card-good">
                                        <img src="{{ asset('landing-images/chatgpt.png') }}" class="logo-landing" alt="">
                                        <ul class="left-card-good-ul">
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>Need Prompts.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>Low quality of output if you don’t give the right prompt.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>No blockchain integration.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>No specific ad creation tools.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>Generates responses based on user prompts.</p>
                                            </li>
                                            <li>
                                                <span class="sqr-12"></span>
                                                <p>Only   generates content using user-provided structure.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="tool-section">
            <div class="container">
                <div class="row" style="align-items: flex-end;">
                    <div class="col-lg-8">
                        <div class="tool-section-left">
                            <button class="solution-bt">Who can use it</button>
                            <p class="say-good-bye-p">A Tool For All <br> Everyone</p>
                            <p class="say-good-bye-p-1">The go-to tool for marketers, entrepreneurs, <br> and teams who want to write better, faster.</p>
                            <ul class="say-ul-12">
                                <li>
                                    <img src="{{ asset('landing-images/edit-1.png') }}" class="edit-img" alt="">
                                    <div class="say-ul-div">
                                        <p class="say-ul-div-p">Writers</p>
                                        <p class="say-ul-div-p1">Step up your writing game with plagiarism-free and captivating content. Keep your readers hooked</p>
                                    </div>
                                </li>
                                <li>
                                    <img src="{{ asset('landing-images/edit-2.png') }}" class="edit-img" alt="">
                                    <div class="say-ul-div">
                                        <p class="say-ul-div-p">Marketing Teams</p>
                                        <p class="say-ul-div-p1">Dominate your industry with content that converts and drives revenue. See 10x profits with our AI tools</p>
                                    </div>
                                </li>
                                <li>
                                    <img src="{{ asset('landing-images/edit-3.png') }}" class="edit-img" alt="">
                                    <div class="say-ul-div">
                                        <p class="say-ul-div-p">Business Owners</p>
                                        <p class="say-ul-div-p1">Capture customers attention with product descriptions that are informative, engaging, and SEO-friendly.</p>
                                    </div>
                                </li>
                                <li>
                                    <img src="{{ asset('landing-images/edit-4.png') }}" class="edit-img" alt="">
                                    <div class="say-ul-div">
                                        <p class="say-ul-div-p">E-commerce Stores</p>
                                        <p class="say-ul-div-p1">Use AI technology for efficient sales copy and save time. Take your business to new heights today!</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="tool-section-right">
                            <img src="{{ asset('landing-images/Rectangle-3963.png') }}" class="Rectangle-3963" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="everything-section" id="faq">
            <img src="{{ asset('landing-images/ot-1.png') }}" class="ot1" alt="">
            <img src="{{ asset('landing-images/ot-2.png') }}" class="ot2" alt="">
            <div class="container bord">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-everything">
                            <button class="solution-bt">frequently asked questions</button>
                            <p class="say-good-bye-p">Everything You Need  <br> To Know</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="common-wht">
                        <p class="say-ul-div-p">What Type of Content can the Tool Generate?</p>
                        <p class="say-ul-div-p1">Our AI writing tool can generate various content formats, including blog posts, articles, emails, ad copy, social media postings, product descriptions, etc. Our tool is meant to be flexible and adaptable, allowing you to generate content for any platform or audience.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common-wht">
                        <p class="say-ul-div-p">Is a Trial Version Available Before Purchasing?</p>
                        <p class="say-ul-div-p1">Yes. Our beta tester gets 1000 free tokens to use our writing platform which transcend until the public launch of the writing platform, and a 5000 free In-App token upon the launch of the writing platform. Take advantage of the beta test phase opportunity to evaluate our AI writing tool and discover whether it can fulfill your needs.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common-wht">
                        <p class="say-ul-div-p">What is the Pricing Structure, and What Plans are Offered?</p>
                        <p class="say-ul-div-p1">We provide both free 1000 tokens for beta testers and 5000 token upon the platform launch for Beta testers as well . Public launch users gets a free 500 In-app tokens and can make purchase of the In-App tokens using $CGI after their free tokens has depleted.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common-wht">
                        <p class="say-ul-div-p">What Kind of Customer Support is Available?</p>
                        <p class="say-ul-div-p1">We offer a ticket support system on our discord server. If you have any queries or issues, you can head to our discord server and create a support ticket.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common-wht">
                        <p class="say-ul-div-p">What kind of Security Measures are in Place to Protect my Data and Content?</p>
                        <p class="say-ul-div-p1">We prioritize data and content security and privacy. Our tool secures all data and content with powerful encryption and access control algorithms. To secure user data, we undertake regular security assessments and follow best practices.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common-wht">
                        <p class="say-ul-div-p">What other currencies can I use to purchase In-App tokens?</p>
                        <p class="say-ul-div-p1">Our payment gateway is compatible with only our ecosystem token CGI.</p>
                        </div>
                    </div>
                </div>
                <div class="row mt60">
                    <div class="col-lg-5">
                        <div class="foot-lft">
                            <p class="Support-p11">Support & <br> Contact</p>
                            <p class="Support-22">Got Queries? Explore our Documentation. For bespoke? AI tools development, kindly reach us at</p>
                            <button class="Support-p33">{{ $emailSetting->value ?? 'Contact@cardanogpt.ai' }}</button>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="foot-rgt">
                           <ul class="foot-rgt-ul">
                                <li><a href="">About Us</a></li>
                                <li><a href="">Contact us</a></li>
                                <li><a href="">Documentation</a></li>
                                <li><a href="">Product Demos</a></li>
                                <li><a href="">Blog</a></li>
                                <li><a href="">Get started</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="">Terms & Conditions</a></li>
                           </ul>
                           <div class="flex-foot">
                                <p class="cpyright">2024 CardanoGPT. All Right Reserved </p>
                                <ul class="foot-rgt-ul1">
                                    <li><a href=""><img src="{{ asset('landing-images/s1.png') }}" alt=""></a></li>
                                    <li><a href=""><img src="{{ asset('landing-images/s2.png') }}" alt=""></a></li>
                                    <li><a href=""><img src="{{ asset('landing-images/s3.png') }}" alt=""></a></li>
                                    <li><a href=""><img src="{{ asset('landing-images/s4.png') }}" alt=""></a></li>
                                </ul>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
      $('.loader-overlay').css('display', 'flex');
      $(window).on('load', function() {
          $('.loader-overlay').fadeOut('slow', function() {
              $(this).css('display', 'none');
          });
      });

      $(document).ajaxStart(function() {
          $('.loader-overlay').css('display', 'flex');
      }).ajaxStop(function() {
          $('.loader-overlay').fadeOut('slow', function() {
              $(this).css('display', 'none');
          });
      });
      $(window).on('load', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: '{{ route('getThemeDataLanding') }}',
                type: 'json',
                method: 'post',
                success: function(data) {
                    console.log(data.message);
                   if(data.message == 'dark'){
                    // APPEND DARK CLASS TO BODY
                    $('body').addClass('dark');
                   }
                   if(data.message == 'light'){
                    // APPEND DARK CLASS TO BODY
                    $('body').addClass('light');
                   }
                },
                error: function(error) {
                    console.log(error.responseText);
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-5/5.39.0/js/tempusdominus-bootstrap-5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".tog-bt").click(function () {
                $("body").toggleClass("open-class");
            });
        });
        $(document).ready(function () {
            $(".abs-bk").click(function () {
                $("body").removeClass("open-class");
            });
        });

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
</body>

</html>