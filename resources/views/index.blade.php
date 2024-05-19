@extends('layouts.app')

@section('title')
Chatsmith Online Services
@endsection

@section('content')
<div class="container">
	<!-- COS Image -->
	<header>
		<img id="cos_header" class="img-responsive mx-auto d-block" src="{{ asset('images/cos_header2.png') }}" />
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

<section class="container">
	<div class="row">
		<!-- Widgets -->
		<div class="col-sm-12">
			<h2 class="header-static-page-title">Real Time Live Support Chat For Your Websites</h2>
		</div>
		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget1.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">24/7 Services</h3>
				<figcaption class="figure-caption">Providing chat service to your customers or clients during office hours ONLY may actually run against the principle of putting up a website.</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget2.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Multiple Websites</h3>
				<figcaption class="figure-caption">The look and feel should be great across pages of the website. Take into account the different products and accounts the sites offer.</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget3.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Marketing ROI</h3>
				<figcaption class="figure-caption">Achieve your marketing target by working hand-in-hand with you to increase the number of your customers and convert them into a lifelong clients. We employ advertising strategies to your website (like SEO, PPC, Site Retargeting, Search Retargeting etc.)</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget4.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Proactive Chat Invite</h3>
				<figcaption class="figure-caption">With exceptional customer service experience, our agents greet every site visitor 24/7 and provide them with answers to their questions or concerns.</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget5.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Maximize Business Potental</h3>
				<figcaption class="figure-caption">Customer satisfaction is the perfect ingredient in building a great company image.</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget6.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Spawn Client Loyalty</h3>
				<figcaption class="figure-caption">Greets and tries to engage your site visitor to bring up any question or concern about what you offer – product or service. By providing great customer service experience, your site visitors will be transformed into loyal clients –and spread the good word about your service and your company.</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget7.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Keep Impatience Away</h3>
				<figcaption class="figure-caption">Our proactive chat invites will send a signal that help is just few clicks away. Because of this, impatient site visitors will be "less edgy", knowing that someone can help them browse over your website and find answers to their concerns.</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget8.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Add a "Human Touch" to your Website</h3>
				<figcaption class="figure-caption">Our agents provide the much needed human touch to your website. Humans mostly likely prefer buying from a human. At the same time, most shoppers wants an assurance that what they’re buying is the "right" one.</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget9.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Recomment or Up-Sell Your Products or Services</h3>
				<figcaption class="figure-caption">Through our agent’s soft skills to bring up your visitor’s current and future concerns, they can set the tone for your visitor’s buying decision – including your products or services that they’ll likely need in the days ahead.</figcaption>
			</div>
		</figure>

		<figure class="figure col-md-6">
			<div class="float-left mr-2">
				<img src="{{ asset('images/cos_widget10.png') }}" class="figure-img img-fluid img-responsive">
			</div>
			<div class="text-left">
				<h3 class="text-uppercase">Quick Replies to your Site Visitors Pressing Questions</h3>
				<figcaption class="figure-caption">When your site visitor's queries are answered quickly and accurately, you quickly gain their trust and confidence.</figcaption>
			</div>
		</figure>
	</div>
</section>

<section class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="header-static-page-title">Our Services</h2>
		</div>
		<figure class="figure col-md-4">
			<div class="rounded-circle rounded-widgets">
				<div class="rounded-widgets-spacing"><h1 class="display-4"><i class="fa fa-users"></i></h1></div>
			</div>
			<h3 class="text-uppercase text-center">Customer Service</h3>
			<figcaption class="figure-caption">Through our proactive chat invites, every site visitor is greeted and gently asked how we can help them. Above all, our agents will exert extra effort to provide excellent customer support in order to convert your site visitor into a paying client. Our agents are trained to identify and work accordingly with different “buying or shopping personalities” of your website visitors. In simple terms, they can efficiently chat with your site visitors and let them experience convenience. And the natural result? More sales or paying clients – and a constant flow of revenues down the road.</figcaption>
		</figure>

		<figure class="figure col-md-4">
			<div class="rounded-circle rounded-widgets">
				<div class="rounded-widgets-spacing"><h1 class="display-4"><i class="fa fa-comment"></i></h1></div>
			</div>
			<h3 class="text-uppercase text-center">Chat Support</h3>
			<figcaption class="figure-caption">Help your site visitors stay longer on your web pages and assist them to browse over your website – and let them know more about your products or services. Earn your site visitors’ trust and confidence by providing excellent customer service. This includes filling out of form/s, generating leads (pre-sales and sales), appointment setting and above all provide your website with a human touch.</figcaption>
		</figure>

		<figure class="figure col-md-4">
			<div class="rounded-circle rounded-widgets">
				<div class="rounded-widgets-spacing"><h1 class="display-4"><i class="fa fa-signal"></i></h1></div>
			</div>
			<h3 class="text-uppercase text-center">Developing Strategies</h3>
			<figcaption class="figure-caption">Chatsmith Online help you achieve your marketing targets through tailor-fit solutions of your goals.  Our approach is to come up with a regular and “specifically made for you” program and customer support. We train our agents to be well adept to the model and mood of your website including the demographics of your website visitors. On top of this, we will work hand in hand with you to increase the number of your customers and convert them into a lifelong client.  Through these efforts, it would be a lot easier to achieve your marketing goals.</figcaption>
		</figure>

		<figure class="figure col-md-4">
			<div class="rounded-circle rounded-widgets">
				<div class="rounded-widgets-spacing"><h1 class="display-4"><i class="fa fa-dollar"></i></h1></div>
			</div>
			<h3 class="text-uppercase text-center">Cost-Efficient Tasks</h3>
			<figcaption class="figure-caption">Create effective marketing schemes through automation of sales processes – including multi-tasking and chatting simultaneously with more than one site.</figcaption>
		</figure>

		<figure class="figure col-md-4">
			<div class="rounded-circle rounded-widgets">
				<div class="rounded-widgets-spacing"><h1 class="display-4"><i class="fa fa-envelope"></i></h1></div>
			</div>
			<h3 class="text-uppercase text-center">Lead Generation</h3>
			<figcaption class="figure-caption">We believe that the quality of our chats should never fall off nor should remain constant forever. In fact, it is our mission to provide you with consistent high quality chats. To achieve this, we regularly put our agents into training to further boost their efficiency and competency – not only just on the way they handle their job but also on a personal perspective.</figcaption>
		</figure>

		<figure class="figure col-md-4">
			<div class="rounded-circle rounded-widgets">
				<div class="rounded-widgets-spacing"><h1 class="display-4"><i class="fa fa-briefcase"></i></h1></div>
			</div>
			<h3 class="text-uppercase text-center">Sales Acquisition</h3>
			<figcaption class="figure-caption">Generating sales by understanding what your site visitors have mind – and aligning it with your products or services. Help convert your site visitors into paying customers.</figcaption>
		</figure>
	</div>
</section>
@endsection
