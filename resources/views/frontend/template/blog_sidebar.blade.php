<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
    <div class="blog-left-section">
        @php
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                $url = 'https://';
            } else {
                $url = 'http://';
            }
            $url .= $_SERVER['HTTP_HOST'];
            $url .= $_SERVER['REQUEST_URI'];
            $endpoint = substr(strrchr($url, '/'), 1);
        @endphp
        @if ($endpoint == 'blog')
            <a href="{{ url('bloghindi') }}">
                <div class="blog-left-search blog-common-wide text-center"
                    style="background-color: white; margin-bottom: 20px; padding: 20px; font-size: 18px; color: black; border-radius: 100px; box-shadow: 0 4px 8px 0 rgb(0 0 0 / 5%), 0 6px 20px 0 rgb(0 0 0 / 4%);">
                    Read in Hindi
                </div>
            </a>
        @endif
        @if ($endpoint == 'bloghindi')
            <a href="{{ url('blog') }}">
                <div class="blog-left-search blog-common-wide text-center"
                    style="background-color: white; margin-bottom: 20px; padding: 20px; font-size: 18px; color: black; border-radius: 100px; box-shadow: 0 4px 8px 0 rgb(0 0 0 / 5%), 0 6px 20px 0 rgb(0 0 0 / 4%);">
                    Read in English
                </div>
            </a>
        @endif

        <div class="blog-left-search blog-common-wide">
            <form action="{{ url('blog') }}" method="GET">
                <input type="text" name="title" placeholder="Search">
                <input type="submit" value="&#xf002;">
            </form>
        </div>
        <div class="mob_bottom">
            <div class="blog-left-categories blog-common-wide">
                <h5>Categories</h5>
                <ul class="list">
                    @foreach ($blogcategories as $c)
                        <li><a href="{{ url('blog', $c->slug) }}">{{ $c->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="blog-recent-post blog-common-wide">
                <h5>Recent Posts</h5>
                @foreach ($recentBlogs as $rb)
                    <div class="recent-blog-list">
                        @if (!empty($rb->media))
                            <p>
                                <a href="{{ url('blog/info', $rb->slug) }}"><img
                                        src="{{ url('storage/media/' . $rb->media->media) }}" alt=""></a>
                            </p>
                        @endif
                        <p><small>{{ $rb->updated_at->format('F d, Y') }}</small></p>
                        <h6>{{ $rb->title }}</h6>
                    </div>
                @endforeach
            </div>
            <div class="popular-tag blog-common-wide">
                <h5>Popular Tags</h5>
                @foreach ($tags as $t)
                    <a href="{{ url('blog', ['tags' => $t->slug]) }}">{{ $t->name }}</a>
                @endforeach
            </div>
            <div class="blog-left-deal blog-common-wide">
                <h5>Best Deals</h5>
                @foreach ($best_deals as $m)
                    <div class="best-deal-blog">
                        <div class="best-deal-left">
                            <a href="{{ route('menuinfo', $m->slug) }}"><img
                                    src="{{ url('storage/media/' . $m->media->media) }}" alt=""></a>
                        </div>
                        <div class="best-deal-right">
                            <p>{{ $m->name }}</p>
                            <p><strong>₹ {{ $m->sale_price }}</strong></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
