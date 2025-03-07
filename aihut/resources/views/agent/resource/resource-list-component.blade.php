<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4">
                <div class="settings-widget account-settings">
                    <div class="settings-menu">
                        @foreach ($categories as $category)
                            <h3>{{ $category->cate_name }}</h3>
                            <ul>
                                @foreach ($category->pages as $page)
                                    <li class="nav-item">
                                        <a wire:click="viewContent({{ $page->id }})"
                                            class="nav-link {{ $page_id == $page->id ? 'active' : '' }}"
                                            style="cursor: pointer;"> <i
                                                class="feather-home"></i>{{ $page->page_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-6">
                                        <h5>{!! $pageContent->page_title !!}</h5>
                                        <p>{!! $pageContent->page_contain !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
