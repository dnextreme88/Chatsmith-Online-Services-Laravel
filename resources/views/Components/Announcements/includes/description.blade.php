@if (str_word_count($announcement_description) > 200)
    <p class="m-0 text-justify announcement-description text-ellipsis">{!! Markdown::parse($announcement_description) !!}</p>
    <a href="#" class="d-inline-block mb-4 links read-more-text" title="Click me to expand announcement text">Read more</a>
@else
    <p class="text-justify announcement-description">{!! Markdown::parse($announcement_description) !!}</p>
@endif
