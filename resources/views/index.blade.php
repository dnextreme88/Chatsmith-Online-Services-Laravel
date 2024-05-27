@extends('layouts.app')

@section('title')
Chatsmith Online Services
@endsection

@push('styles')
    <link href="{{ asset('css/Components/HrWithText/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Components/OurWidgets/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Components/Testimonials/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Components/OurServices/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Components/SpecificTasksAgentsDo/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Utils/intersection_observer.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/index.js') }}"></script>
@endpush

@section('content')
<div>
    <!-- COS Image -->
    <header>
        <img id="cos_header" class="img-responsive mx-auto d-block" src="{{ asset('images/cos_header2.png') }}" alt="COS hero image" title="COS hero image" />
    </header>

	<!-- Show announcements -->
	@foreach ($announcements as $announcement)
		<div class="mb-2">
			<h1>{{ $announcement->title }}</h1>
			<p class="text-muted">Posted by <a href="/announcements/user/{{ $announcement->user->username }}">{{ $announcement->user->username }}</a> on <small>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y h:i:s A') }}</small></p>
			<hr>
			<p>{{ $announcement->description}}</p>
		</div>
	@endforeach
</div>

<section class="container our-widgets-section">
    <div class="row">
        <!-- TODO: TO BE REFACTORED AS A COMPONENT FOR LIVEWIRE -->
        <div class="py-4 hr-with-text">
            <hr class="hr-bg" />

            <span class="text-center text-uppercase hr-text">WHY CHOOSE US</span>
        </div>

        <div class="d-grid our-widgets">
            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget1.png') }}" class="img-responsive" width="100%" alt="24/7 Services image" title="24/7 Services image" />
                </div>

                <h2 class="text-uppercase widgets-title">24/7 Services</h2>
                <p>Providing chat service to your customers or clients during office hours ONLY may actually run against the principle of putting up a website.</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget2.png') }}" class="img-responsive" width="100%" alt="Multiple Websites image" title="Multiple Websites image" />
                </div>

                <h2 class="text-uppercase widgets-title">Multiple Websites</h2>
                <p>The look and feel should be great across pages of the website. Take into account the different products and accounts the sites offer.</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget3.png') }}" class="img-responsive" width="100%" alt="Marketing ROI image" title="Marketing ROI image" />
                </div>

                <h3 class="text-uppercase widgets-title">Marketing ROI</h3>
                <p>Achieve your marketing target by working hand-in-hand with you to increase the number of your customers and convert them into a lifelong clients. We employ advertising strategies to your website (like SEO, PPC, Site Retargeting, Search Retargeting etc.)</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget4.png') }}" class="img-responsive" width="100%" alt="Proactive Chat Invite image" title="Proactive Chat Invite image" />
                </div>

                <h3 class="text-uppercase widgets-title">Proactive Chat Invite</h3>
                <p>With exceptional customer service experience, our agents greet every site visitor 24/7 and provide them with answers to their questions or concerns.</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget5.png') }}" class="img-responsive" width="100%" alt="Maximize Business Potential image" title="Maximize Business Potential image" />
                </div>

                <h3 class="text-uppercase widgets-title">Maximize Business Potential</h3>
                <p>Customer satisfaction is the perfect ingredient in building a great company image.</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget6.png') }}" class="img-responsive" width="100%" alt="Spawn Client Loyalty image" title="Spawn Client Loyalty image" />
                </div>

                <h3 class="text-uppercase widgets-title">Spawn Client Loyalty</h3>
                <p>By providing great customer service experience, your site visitors will be transformed into loyal clients - and spread the good word about your service and your company.</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget7.png') }}" class="img-responsive" width="100%" alt="Keep Impatience Away image" title="Keep Impatience Away image" />
                </div>

                <h3 class="text-uppercase widgets-title">Keep Impatience Away</h3>
                <p>Our proactive chat invites will send a signal that help is just few clicks away. Because of this, impatient site visitors will be "less edgy", knowing that someone can help them browse over your website and find answers to their concerns.</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget8.png') }}" class="img-responsive" width="100%" alt="Add a Human Touch image" title="Add a Human Touch image" />
                </div>

                <h3 class="text-uppercase widgets-title">Add a "Human Touch" to your Website</h3>
                <p>Our agents provide the much needed human touch to your website. Humans mostly likely prefer buying from a human. At the same time, most shoppers wants an assurance that what they're buying is the "right" one.</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget9.png') }}" class="img-responsive" width="100%" alt="Recomment or Up-Sell image" title="Recomment or Up-Sell image" />
                </div>

                <h3 class="text-uppercase widgets-title">Recomment or Up-Sell Your Products or Services</h3>
                <p>Through our agent's soft skills to bring up your visitor's current and future concerns, they can set the tone for your visitor's buying decision - including your products or services that they'll likely need in the days ahead.</p>
            </div>

            <div class="d-grid widgets">
                <div class="icon">
                    <img src="{{ asset('images/cos_widget10.png') }}" class="img-responsive" width="100%" alt="Quick Replies image" title="Quick Replies image" />
                </div>

                <h3 class="text-uppercase widgets-title">Quick Replies to your Site Visitors Pressing Questions</h3>
                <p>When your site visitor's queries are answered quickly and accurately, you quickly gain their trust and confidence.</p>
            </div>
        </div>
    </div>
</section>

<section class="container our-services-section">
    <div class="row">
        <!-- TODO: TO BE REFACTORED AS A COMPONENT FOR LIVEWIRE -->
        <div class="py-4 hr-with-text">
            <hr class="hr-bg" />

            <span class="text-center text-uppercase hr-text">OUR SERVICES</span>
        </div>

        <div class="d-grid our-services">
            <div class="d-grid hidden-fade-on-show services">
                <div class="d-grid justify-content-center round-container">
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>

                <h2 class="text-center text-uppercase services-title">Customer Service</h2>
                <p class="text-justify">Through our proactive chat invites, every site visitor is greeted and gently asked how we can help them. Above all, our agents will exert extra effort to provide excellent customer support in order to convert your site visitor into a paying client. Our agents are trained to identify and work accordingly with different "buying or shopping personalities" of your website visitors. In simple terms, they can efficiently chat with your site visitors and let them experience convenience. And the natural result? More sales or paying clients - and a constant flow of revenues down the road.</p>
            </div>

            <div class="d-grid hidden-fade-on-show services">
                <div class="d-grid justify-content-center round-container">
                    <div class="icon">
                        <i class="fa fa-signal"></i>
                    </div>
                </div>

                <h2 class="text-center text-uppercase services-title">Developing Strategies</h2>
                <p class="text-justify">Chatsmith Online help you achieve your marketing targets through tailor-fit solutions of your goals. Our approach is to come up with a regular and "specifically made for you" program and customer support. We train our agents to be well adept to the model and mood of your website including the demographics of your website visitors. On top of this, we will work hand in hand with you to increase the number of your customers and convert them into a lifelong client. Through these efforts, it would be a lot easier to achieve your marketing goals.</p>
            </div>

            <div class="d-grid hidden-fade-on-show services">
                <div class="d-grid justify-content-center round-container">
                    <div class="icon">
                        <i class="fa fa-comment"></i>
                    </div>
                </div>

                <h2 class="text-center text-uppercase services-title">Chat Support</h2>
                <p class="text-justify">Help your site visitors stay longer on your web pages and assist them to browse over your website - and let them know more about your products or services. Earn your site visitors' trust and confidence by providing excellent customer service. This includes filling out of form/s, generating leads (pre-sales and sales), appointment setting and above all provide your website with a human touch.</p>
            </div>

            <div class="d-grid hidden-fade-on-show services">
                <div class="d-grid justify-content-center round-container">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                </div>

                <h2 class="text-center text-uppercase services-title">Lead Generation</h2>
                <p class="text-justify">We believe that the quality of our chats should never fall off nor should remain constant forever. In fact, it is our mission to provide you with consistent high quality chats. To achieve this, we regularly put our agents into training to further boost their efficiency and competency - not only just on the way they handle their job but also on a personal perspective.</p>
            </div>

            <div class="d-grid hidden-fade-on-show services">
                <div class="d-grid justify-content-center round-container">
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                </div>

                <h2 class="text-center text-uppercase services-title">Sales Acquisition</h2>
                <p class="text-justify">Generating sales by understanding what your site visitors have mind - and aligning it with your products or services. Help convert your site visitors into paying customers.</p>
            </div>

            <div class="d-grid hidden-fade-on-show services">
                <div class="d-grid justify-content-center round-container">
                    <div class="icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                </div>

                <h2 class="text-center text-uppercase services-title">Cost-Efficient Tasks</h2>
                <p class="text-justify">Create effective marketing schemes through automation of sales processes - including multi-tasking and chatting simultaneously with more than one site.</p>
            </div>
        </div>
    </div>
</section>


<section class="container testimonials-section">
    <!-- TODO: TO BE REFACTORED AS A COMPONENT FOR LIVEWIRE -->
    <div class="py-4 hr-with-text">
        <hr class="hr-bg" />

        <span class="text-center text-uppercase hr-text">WHAT CLIENTS SAY</span>
    </div>

    <div class="carousel slide testimonials" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target=".testimonials" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target=".testimonials" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target=".testimonials" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target=".testimonials" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target=".testimonials" data-bs-slide-to="4" aria-label="Slide 5"></button>
            <button type="button" data-bs-target=".testimonials" data-bs-slide-to="5" aria-label="Slide 6"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/carousel_five_stars.webp') }}" class="my-4 d-none d-md-block w-25 mx-auto" alt="Testimonial 1" />
                <div class="carousel-caption">
                    <h5>She has this uncanny way of engaging the customers that starts with acquainting them with the products and ends with creating a need. She has developed a certain style of conversation that leads you to a dance, a sweet sensational tango of words and one is unknowingly sashayed to closing with a magnificent pose and a sale generated.</h5>
                    <p>Beverly Pig-ang B.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/carousel_five_stars.webp') }}" class="my-4 d-none d-md-block w-25 mx-auto" alt="Testimonial 2" />
                <div class="carousel-caption">
                    <h5>Mary is one of the endearing speakers that are reflected on the way she convey messages to her customers. She treats them with such levels of charm that you will inadvertently succumb to her guise. She is sincere and has aimed to deliver with perfection. She has developed a way of responding to inquiry that leaves one contented and satisfied; a very well-trained customer service provider.</h5>
                    <p>Letecia Impian G.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/carousel_five_stars.webp') }}" class="my-4 d-none d-md-block w-25 mx-auto" alt="Testimonial 3" />
                <div class="carousel-caption">
                    <h5>Mary has this meticulous way of providing a straight-forward answer. Short, concise and up to the point. She does not complicate things and she handles customer in a way one unties a rope, removing complexities and laying down a straight path easy to follow like ABC. It will be like riding a train with her fast and precise, only stopping at end points.</h5>
                    <p>Archie Tinapngan L.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/carousel_five_stars.webp') }}" class="my-4 d-none d-md-block w-25 mx-auto" alt="Testimonial 4" />
                <div class="carousel-caption">
                    <h5>A conversationalist that can get anyone to speak their mind, she is not afraid to ask questions and personally give you a dose of her wits. A total stranger you've met but whom you can easily put your heart's out.</h5>
                    <p>Love Lyn Carbonell L.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/carousel_five_stars.webp') }}" class="my-4 d-none d-md-block w-25 mx-auto" alt="Testimonial 5" />
                <div class="carousel-caption">
                    <h5>She is an epitome of a carefree soul, very opinionated and has a way of infecting customers with her amicable character. Her skill lies in her notable way of finding answers to tough questions. A proverbial researcher and site navigator, providing customers with concise and accurate answers that are up to procedures and standards.</h5>
                    <p>Paolo Brylle Orallo L.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/carousel_five_stars.webp') }}" class="my-4 d-none d-md-block w-25 mx-auto" alt="Testimonial 6" />
                <div class="carousel-caption">
                    <h5>Mary understands the complexities of things and she shares this knowledge to anyone who crosses her path. You would be humbled with the way she ardently translates such sophisticated technicalities into simple vocabulary, which are made to be comprehended by any ordinary lad. Once you finish a chat with this woman, you will have ended with an additional insight of things that you would never have expected to learn in the first place.</h5>
                    <p>Jeoffrei Kitong S.</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target=".testimonials" data-bs-slide="prev">
            <span class="fa fa-angle-left carousel-nav" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target=".testimonials" data-bs-slide="next">
            <span class="fa fa-angle-right carousel-nav" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section class="container specific-tasks-agents-do-section">
    <div class="row">
        <!-- TODO: TO BE REFACTORED AS A COMPONENT FOR LIVEWIRE -->
        <div class="py-4 hr-with-text">
            <hr class="hr-bg" />

            <span class="text-center text-uppercase hr-text">WHAT ARE THE SPECIFIC TASKS CHATSMITH ONLINE AGENTS DO?</span>
        </div>

        <div class="d-grid specific-tasks-agents-do">
            <div class="d-grid sides left-side">
                <div class="d-grid hidden-fade-on-show specific-tasks">
                    <div class="d-grid align-items-center justify-content-center round-container">
                        <div class="icon">
                            <i class="fa fa-comment"></i>
                        </div>
                    </div>

                    <span class="fw-bold text-uppercase widgets-title">Greet and initiate proactive chat invites</span>
                    <span>&nbsp;</span>
                    <p>to every site visitor 24/7 and give answers as well as solutions to their questions or concerns.</p>
                </div>

                <div class="d-grid hidden-fade-on-show specific-tasks">
                    <div class="d-grid align-items-center justify-content-center round-container">
                        <div class="icon">
                            <i class="fa fa-hand-point-down"></i>
                        </div>
                    </div>

                    <span class="fw-bold text-uppercase widgets-title">Bring down the costs of your client acquisition</span>
                    <span>&nbsp;</span>
                    <p>schemes through efficiency and automation of sales processes - including multi-tasking and chatting simultaneously with more than one site.</p>
                </div>

                <div class="d-grid hidden-fade-on-show specific-tasks">
                    <div class="d-grid align-items-center justify-content-center round-container">
                        <div class="icon">
                            <i class="fa fa-list-alt"></i>
                        </div>
                    </div>

                    <span class="fw-bold text-uppercase widgets-title">Generate more leads</span>
                    <span>&nbsp;</span>
                    <p>and help convert your site visitors into paying.</p>
                </div>
            </div>

            <div class="d-grid sides align-items-center middle-side">
                <img src="{{ asset('images/bg_specific_tasks_agents_do.gif') }}" class="img-responsive hidden-fade-on-show bg-specific-tasks-agents-do" width="100%" alt="Specific Tasks Agents Do image" title="Specific Tasks Agents Do image" />
            </div>

            <div class="d-grid sides right-side">
                <div class="d-grid hidden-fade-on-show specific-tasks">
                    <div class="d-grid align-items-center justify-content-center round-container">
                        <div class="icon">
                            <i class="fa fa-chart-column"></i>
                        </div>
                    </div>

                    <span class="fw-bold text-uppercase widgets-title">Increase your sales or client</span>
                    <span>&nbsp;</span>
                    <p>acquisitions by understanding what your site visitors have in mind - and aligning it with your products or services.</p>
                </div>

                <div class="d-grid hidden-fade-on-show specific-tasks">
                    <div class="d-grid align-items-center justify-content-center round-container">
                        <div class="icon">
                            <i class="fa fa-comments"></i>
                        </div>
                    </div>

                    <span class="fw-bold text-uppercase widgets-title">Help your site visitors stay longer</span>
                    <span>&nbsp;</span>
                    <p>on your web pages and assist them to browse over your website - and let them know more about your products or services</p>
                </div>

                <div class="d-grid hidden-fade-on-show specific-tasks">
                    <div class="d-grid align-items-center justify-content-center round-container">
                        <div class="icon">
                            <i class="fa fa-database"></i>
                        </div>
                    </div>

                    <span class="fw-bold text-uppercase widgets-title">Earn your site visitors' trust and confidence</span>
                    <span>&nbsp;</span>
                    <p>by providing excellent customer service. This includes filling out of form/s, generating leads (pre-sales and sales), appointment setting and above all provide your website with a human touch.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
