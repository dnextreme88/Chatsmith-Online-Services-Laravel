@extends('layouts.app')

@section('title')
Chatsmith Online Services
@endsection

@push('styles')
    <link href="{{ asset('css/Components/HrWithText/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Components/OurWidgets/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Components/OurServices/index.css') }}" rel="stylesheet">
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
                <p>Greets and tries to engage your site visitor to bring up any question or concern about what you offer - product or service. By providing great customer service experience, your site visitors will be transformed into loyal clients - and spread the good word about your service and your company.</p>
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
@endsection
