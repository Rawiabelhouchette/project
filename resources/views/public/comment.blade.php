@props(['commentaires'])

<div>
    <div class="detail-wrapper">
        <div class="detail-wrapper-header">
            <h4>{{ $commentaires->count() }} Commentaires</h4>
        </div>
        <div class="detail-wrapper-body">
            <ul class="review-list">
                @foreach ($commentaires as $commentaire)
                    <li>
                        <div class="reviews-box">
                            <div class="review-body">
                                <div class="review-avatar">
                                    <img alt="" src="http://via.placeholder.com/80x80" class="avatar avatar-140 photo">
                                </div>
                                <div class="review-content">
                                    <div class="review-info">
                                        <div class="review-comment">
                                            <div class="review-author">
                                                {{ $commentaire->name }}
                                            </div>
                                            <div class="review-comment-stars">
                                                @for ($i = 0; $i < $commentaire->note; $i++)
                                                    <i class="fa fa-star filled"></i>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $commentaire->note; $i++)
                                                    <i class="fa fa-star empty"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="review-comment-date">
                                            <div class="review-date">
                                                <span>{{ $commentaire->created_at->diffForHumans() }}</span>
                                            </div> 
                                        </div>
                                    </div>
                                    <p>{{ $commentaire->contenu }}</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    
                @endforeach
                {{-- <li>
                    <div class="reviews-box">
                        <div class="review-body">
                            <div class="review-avatar">
                                <img alt="" src="http://via.placeholder.com/80x80" class="avatar avatar-140 photo">
                            </div>
                            <div class="review-content">
                                <div class="review-info">
                                    <div class="review-comment">
                                        <div class="review-author">
                                            Cole Harris
                                        </div>
                                        <div class="review-comment-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star empty"></i>
                                        </div>
                                    </div>
                                    <div class="review-comment-date">
                                        <div class="review-date">
                                            <span>4 weeks ago</span>
                                        </div>
                                    </div>
                                </div>
                                <p>At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis Praesentium Voluptatum Deleniti Atque Corrupti Quos Dolores Et Quas Molestias Excepturi Sint Occaecati Cupiditate Non Provident.</p>
                            </div>
                        </div>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>

    <div class="detail-wrapper" id="write-review">
        <div class="detail-wrapper-header">
            <h4>Rate & Write Reviews</h4>
        </div>
        <div class="detail-wrapper-body">

            <div class="row mrg-bot-10">
                <div class="col-md-12">
                    <div class="rating-opt">
                        <div class="jr-ratenode jr-nomal"></div>
                        <div class="jr-ratenode jr-nomal "></div>
                        <div class="jr-ratenode jr-nomal "></div>
                        <div class="jr-ratenode jr-nomal "></div>
                        <div class="jr-ratenode jr-nomal "></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Your Name*">
                </div>
                <div class="col-sm-6">
                    <input type="email" class="form-control" placeholder="Email Address*">
                </div>
                <div class="col-sm-12">
                    <textarea class="form-control height-110" placeholder="Tell us your experience..."></textarea>
                </div>
                <div class="col-sm-12">
                    <button type="button" class="btn theme-btn">Submit your review</button>
                </div>
            </div>
        </div>
    </div>
</div>
