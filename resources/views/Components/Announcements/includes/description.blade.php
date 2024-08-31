@if (str_word_count($announcement_description) > 200)
    <div class="m-0 text-justify announcement-description text-ellipsis">{!! Markdown::parse($announcement_description) !!}</div>
    <a href="#" class="d-inline-block mb-4 links read-more-text" title="Click me to expand announcement text">Read more</a>
@else
    <div class="text-justify announcement-description">{{ Markdown::parse($announcement_description) }}</div>
@endif
